@extends('admin.Layouts.admin')

@section('title', 'Signal Management')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Trading Signals Management</h1>
            <a href="{{ route('admin.signals.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Create New Signal
            </a>
        </div>

        {{-- Success/Error Message Display --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Active and Inactive Signals</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="signalsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Crypto</th>
                                <th>Direction</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th class="text-center">Active</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($signals as $signal)
                                <tr>
                                    <td>{{ $signal->id }}</td>
                                    <td>
                                        <strong>{{ $signal->crypto_symbol }}</strong>
                                    </td>
                                    <td>
                                        <span
                                            class="badge
                                            @if ($signal->direction == 'Call') bg-success
                                            @else bg-danger @endif">
                                            {{ $signal->direction }}
                                        </span>
                                    </td>
                                    <td>{{ $signal->start_time ? $signal->start_time->format('Y-m-d H:i') : 'N/A' }}</td>
                                    <td>{{ $signal->end_time ? $signal->end_time->format('Y-m-d H:i') : 'N/A' }}</td>
                                    <td class="text-center">
                                        {{-- Icon Based Status --}}
                                        @if ($signal->is_active)
                                            <i class="bi bi-check-circle-fill text-success" title="Active"></i>
                                        @else
                                            <i class="bi bi-x-circle-fill text-danger" title="Inactive"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{-- Edit Button --}}
                                        <a href="{{ route('admin.signals.edit', $signal) }}" class="btn btn-sm btn-info"
                                            title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        {{-- Delete Button (Form) --}}
                                        <form action="{{ route('admin.signals.destroy', $signal) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this signal?')"
                                                title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
