<?php

namespace App\Http\Controllers;

use App\Models\Signal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignalController extends Controller
{
    public function index(Request $request)
    {
        $query = Signal::with('admin')->latest();

        // Direction filter
        if ($request->has('direction') && $request->direction != 'all') {
            $query->where('direction', $request->direction);
        }

        // Status filter
        if ($request->has('status') && $request->status != 'all') {
            $isActive = $request->status == 'active' ? true : false;
            $query->where('is_active', $isActive);
        }

        // Crypto symbol filter
        if ($request->has('crypto_symbol') && $request->crypto_symbol != 'all') {
            $query->where('crypto_symbol', $request->crypto_symbol);
        }

        // Date filter
        if ($request->has('date') && $request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $signals = $query->get();

        // Get unique crypto symbols for filter dropdown
        $cryptoList = Signal::distinct()->pluck('crypto_symbol')->sort();

        // Statistics
        $totalSignals = Signal::count();
        $callSignals = Signal::where('direction', 'Call')->count();
        $putSignals = Signal::where('direction', 'Put')->count();
        $activeSignals = Signal::where('is_active', true)->count();

        return view('admin.signals.index', compact(
            'signals',
            'cryptoList',
            'totalSignals',
            'callSignals',
            'putSignals',
            'activeSignals'
        ));
    }

    public function create()
    {
        return view('admin.signals.create');
    }

    // --- CREATE (Store) ---
    public function store(Request $request)
    {
        $request->validate([
            'crypto_symbol' => 'required|string|max:10',
            'direction' => 'required|in:Call,Put',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        Signal::create([
            'crypto_symbol' => $request->crypto_symbol,
            'direction' => $request->direction,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_active' => $request->has('is_active'),
            'admin_id' => Auth::id(),
        ]);

        return redirect()->route('admin.signals.index')->with('success', 'New signal created successfully.');
    }

    // --- UPDATE (Form) ---
    public function edit(Signal $signal)
    {
        return view('admin.signals.edit', compact('signal'));
    }

    // --- UPDATE (Logic) ---
    public function update(Request $request, Signal $signal)
    {
        $request->validate([
            'crypto_symbol' => 'required|string|max:10',
            'direction' => 'required|in:Call,Put',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after:start_time',
            'is_active' => 'boolean',
        ]);

        $signal->update([
            'crypto_symbol' => $request->crypto_symbol,
            'direction' => $request->direction,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_active' => $request->has('is_active'),
            // Optionally update admin_id if you want to track the last updater
        ]);

        return redirect()->route('admin.signals.index')->with('success', 'Signal updated successfully.');
    }

    // --- DELETE (Destroy) ---
    public function destroy(Signal $signal)
    {
        $signal->delete();

        return redirect()->route('admin.signals.index')->with('success', 'Signal deleted successfully.');
    }
}
