<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Services\NowPaymentsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with('user')->latest()->get();

        return view('admin.transaction.deposit', compact('deposits'));
    }

    public function store(Request $request, NowPaymentsService $nowPayments)
    {
        // dd($request->all());
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // 1. Create a record in your DB: e.g., user_id, amount, status = 'pending', etc
        $deposit = Auth::user()->deposits()->create([
            'amount' => $request->amount,
            'currency' => 'USDT',
            'payment_gateway' => 'nowpayments',
            'status' => 'pending',
        ]);

        // 2. Call NOWPayments API to create invoice
        $invoiceData = [
            'price_amount' => $request->amount,
            'price_currency' => 'USD',
            'pay_currency' => 'usdttrc20',          // or whatever your deposit currency
            'ipn_callback_url' => route('deposits.ipn'), // this endpoint will handle callbacks
            'order_id' => $deposit->id,
            // … other required parameters from API docs
        ];
        $response = $nowPayments->createInvoice($invoiceData);

        if (isset($response['id'])) {
            $deposit->update([
                'invoice_id' => $response['id'],
                'address' => $response['invoice_url'] ?? null,  // NEW

            ]);

            return redirect()->route('deposits.show', $deposit)->with('success', 'Invoice created. Please complete payment.');
        } else {
            return back()->with('error', 'Failed to create invoice: '.($response['message'] ?? 'Unknown error'));
        }
    }

    public function ipn(Request $request)
    {

        $receivedSignature = $request->header('x-nowpayments-signature');
        $secretKey = env('NOWPAYMENTS_IPN_SECRET'); // from dashboard

        $generatedSignature = hash_hmac('sha512', $request->getContent(), $secretKey);

        if ($receivedSignature !== $generatedSignature) {
            return response()->json(['error' => 'Invalid signature'], 401);
        }
        // Validate signature if provided by NOWPayments (check docs)
        $invoiceId = $request->invoice_id;
        $status = $request->payment_status;

        $deposit = Deposit::where('invoice_id', $invoiceId)->firstOrFail();

        if ($status === 'confirmed') {
            $deposit->update(['status' => 'completed']);
            // Add amount to user's balance
            $deposit->user->increment('balance', $deposit->amount);
        } elseif ($status === 'failed') {
            $deposit->update(['status' => 'failed']);
        }

        return response()->json(['success' => true]);
        // return redirect()->route('asset.');

    }

    public function show(Deposit $deposit)
    {
        return view('payment', compact('deposit'));
    }

    public function updateStatus(Request $request, Deposit $deposit)
    {
        $deposit->update([
            'status' => $request->status,
            'confirmation_time' => $request->status === 'approved' ? now() : null,
        ]);

        return redirect()->back()->with('success', 'Deposit status updated!');
    }
}

//  public function store(Request $request)
// {
//     $request->validate([
//         'user_id' => 'required|exists:users,id',
//         'amount' => 'required|numeric|min:1',
//         'payment_gateway' => 'required|string',
//         'transaction_id' => 'nullable|string',
//     ]);

//     $deposit = Deposit::create([
//         'user_id' => $request->user_id,
//         'amount' => $request->amount,
//         'payment_gateway' => $request->payment_gateway,
//         'transaction_id' => $request->transaction_id,
//         'status' => 'pending',
//     ]);

//     return back()->with('success', 'Deposit request created successfully!');
// }
