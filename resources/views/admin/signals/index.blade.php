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

        {{-- Filters Section --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold">Filters</h6>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.signals.index') }}" id="filterForm">
                    <div class="row">
                        {{-- Direction Filter --}}
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Direction</label>
                            <select class="form-select" name="direction" id="direction">
                                <option value="all">All Directions</option>
                                <option value="Call" {{ request('direction') == 'Call' ? 'selected' : '' }}>Call</option>
                                <option value="Put" {{ request('direction') == 'Put' ? 'selected' : '' }}>Put</option>
                            </select>
                        </div>

                        {{-- Status Filter --}}
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="all">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>

                        {{-- Crypto Symbol Filter --}}
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Crypto Symbol</label>
                            <select class="form-select" name="crypto_symbol" id="crypto_symbol">
                                <option value="all">All Cryptos</option>
                                @foreach ($cryptoList as $crypto)
                                    <option value="{{ $crypto }}"
                                        {{ request('crypto_symbol') == $crypto ? 'selected' : '' }}>
                                        {{ $crypto }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Date Filter --}}
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" id="date"
                                value="{{ request('date') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-funnel me-1"></i> Apply Filters
                            </button>
                            <a href="{{ route('admin.signals.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-clockwise me-1"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Statistics Cards --}}
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Signals</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSignals }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-graph-up-arrow fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Call Signals</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $callSignals }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-arrow-up-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Put Signals</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $putSignals }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-arrow-down-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Active Signals</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeSignals }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Signals Table --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold">Active and Inactive Signals</h6>
                <span class="text-muted">
                    Showing {{ $signals->count() }} signals
                </span>
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
                            @forelse ($signals as $signal)
                                <tr>
                                    <td>{{ $signal->id }}</td>
                                    <td>
                                        <strong>{{ $signal->crypto_symbol }}</strong>
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $signal->direction == 'Call' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $signal->direction }}
                                        </span>
                                    </td>
                                    <td>{{ $signal->start_time ? $signal->start_time->format('Y-m-d H:i') : 'N/A' }}</td>
                                    <td>{{ $signal->end_time ? $signal->end_time->format('Y-m-d H:i') : 'N/A' }}</td>
                                    <td class="text-center">
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

                                        {{-- Delete Button --}}
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
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="bi bi-inbox fa-2x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">No signals found</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Auto submit form when filters change
            $('#direction, #status, #crypto_symbol').change(function() {
                $('#filterForm').submit();
            });

            // Date filter auto-submit
            $('#date').change(function() {
                if ($(this).val()) {
                    $('#filterForm').submit();
                }
            });
        });
    </script>
@endsection
