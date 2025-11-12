@extends('layouts.admin')

@section('title', isset($signal) ? 'Edit Signal' : 'Create New Signal')

@section('content')
<h4>Withdrawal Form</h4>
<form action="{{ route('withdrawals.store') }}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
    <div>
        <label>Amount:</label>
        <input type="number" step="0.01" name="amount" required>
    </div>
    <div>
        <label>TRC-20 Address:</label>
        <input type="text" name="address" required>
    </div>
    <button type="submit">Submit Withdrawal</button>
</form>
@endsection