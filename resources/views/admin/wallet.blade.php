@extends('admin.Layouts.admin')

@section('title', 'Wallet Mangement')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4">Wallet Managment</h2>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold ">Wallet Information</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="activityTable">
                        <thead>
                            <tr>
                                <th>User Id</th>
                                <th>User Email</th>
                                <th>Exchange Balance</th>
                                <th>Trade Balance</th>
                                <th>Wallet Address</th>
                                <th>Net Amount</th>


                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($wallets as $wallet)
                                <tr>
                                    <td>{{ $wallet->user->id ?? 'N/A' }}</td>
                                    <td>{{ $wallet->user->email ?? 'N/A' }}</td>
                                    <td>{{ $wallet->exchange_balance }}</td>
                                    <td>{{ $wallet->trade_balance }}</td>
                                    <td>{{ auth()->user()->address }}</td>
                                    <td>{{ $wallet->exchange_balance + $wallet->trade_balance }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center">No trades found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
