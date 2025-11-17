<?php

namespace App\Http\Controllers;

use App\Models\Signal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignalController extends Controller
{
    // --- READ (Index) ---
    public function index()
    {
        // Display list of all signals, ordered by creation date
        $signals = Signal::with('admin')->latest()->get();

        return view('admin.signals.index', compact('signals'));
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
