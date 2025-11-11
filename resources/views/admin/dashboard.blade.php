@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h2 class="mb-4">Admin Dashboard Overview</h2>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6>Total Users</h6>
                <h3>124</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6>Total Trades</h6>
                <h3>842</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6>Deposits</h6>
                <h3>$14,250</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h6>Withdrawals</h6>
                <h3>$9,120</h3>
            </div>
        </div>
    </div>
</div>

<hr class="my-4">

<h5 class="mb-3">Recent Activities</h5>
<table class="table table-striped">
    <thead>
        <tr>
            <th>User</th>
            <th>Action</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>john@example.com</td>
            <td>Deposit</td>
            <td>$200</td>
            <td>2025-11-10</td>
        </tr>
        <tr>
            <td>emma@nx.com</td>
            <td>Trade Win</td>
            <td>$70</td>
            <td>2025-11-09</td>
        </tr>
    </tbody>
</table>
@endsection
