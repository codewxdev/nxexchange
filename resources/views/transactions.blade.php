@extends('Layouts.FrontLayout')

@section('content')
<div class="container py-5">
    <!-- Back link -->
    <a href="{{ route('home') }}" class="text-primary mb-4 d-inline-block">
        &larr; Back
    </a>

    {{-- <div class="text-center mb-5">
        <img src="{{ asset('assets/images/logo3.png') }}" alt="NxExchange" style="width:120px;">
        <h2 class="mt-3 text-white">Transaction Records</h2>
        <p class="text-muted">View all your past transactions here.</p>
    </div> --}}

    <!-- Empty state -->
    <div id="emptyTransactions" class="text-center py-5">
        <i class="fa-regular fa-folder-open fa-4x mb-3" style="color:#ff783a;"></i>
        <h4 class="text-white">No transactions found</h4>
        <p class="text-muted">Once you make transactions, those will appear here.</p>
    </div>

    <!-- Transactions table (hidden/commented for future use) -->
    {{-- 
    <div id="transactionTable" class="table-responsive d-none">
        <table class="table table-dark table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Transaction ID</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $txn)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $txn->transaction_id }}</td>
                    <td>{{ $txn->created_at->format('d M, Y H:i') }}</td>
                    <td>{{ $txn->type }}</td>
                    <td>{{ $txn->amount }} {{ $txn->currency }}</td>
                    <td>
                        @if($txn->status == 'completed')
                            <span class="badge bg-success">Completed</span>
                        @elseif($txn->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @else
                            <span class="badge bg-danger">Failed</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    --}}
</div>
@endsection

@push('style')
<style>
    body {
        background-color: #1c1c1e;
    }
    .fa-folder-open {
        transition: transform 0.3s ease;
    }
    .fa-folder-open:hover {
        transform: scale(1.1);
    }
    .table-dark {
        background-color: rgba(255,255,255,0.05);
        backdrop-filter: blur(10px);
        border-radius: 10px;
    }
    .table-dark th, .table-dark td {
        color: #fff;
        vertical-align: middle;
    }
</style>
@endpush

@push('scripts')
<script>
    // Example: dynamically show transaction table when data exists
    // $(document).ready(function(){
    //     let transactionsExist = false; // Replace with actual check
    //     if(transactionsExist){
    //         $('#emptyTransactions').hide();
    //         $('#transactionTable').removeClass('d-none');
    //     }
    // });
</script>
@endpush
