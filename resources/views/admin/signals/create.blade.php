@extends('admin.Layouts.admin')

@section('title', isset($signal) ? 'Edit Signal' : 'Create New Signal')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">{{ isset($signal) ? 'Edit Trading Signal' : 'Create New Trading Signal' }}</h4>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($signal) ? route('admin.signals.update', $signal) : route('admin.signals.store') }}"
                            method="POST">
                            @csrf
                            @if (isset($signal))
                                @method('PUT')
                            @endif

                            {{-- Crypto Symbol Field --}}
                            <div class="mb-3">
                                <label for="crypto_symbol" class="form-label">Crypto Symbol</label>
                                <input type="text" class="form-control @error('crypto_symbol') is-invalid @enderror"
                                    id="crypto_symbol" name="crypto_symbol"
                                    value="{{ old('crypto_symbol', $signal->crypto_symbol ?? '') }}" required
                                    placeholder="e.g., BTC, ETH">
                                @error('crypto_symbol')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Direction Field (Radio Buttons) --}}
                            <div class="mb-3">
                                <label class="form-label d-block">Direction</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="direction" id="direction_call"
                                        value="Call"
                                        {{ old('direction') == 'Call' || (isset($signal) && $signal->direction == 'Call') ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="direction_call">Call</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="direction" id="direction_put"
                                        value="Put"
                                        {{ old('direction') == 'Put' || (isset($signal) && $signal->direction == 'Put') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="direction_put">Put</label>
                                </div>
                                @error('direction')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Start Time Field --}}
                            <div class="mb-3">
                                <label for="start_time" class="form-label">Start Time (Optional)</label>
                                <input type="datetime-local" class="form-control @error('start_time') is-invalid @enderror"
                                    id="start_time" name="start_time"
                                    value="{{ old('start_time', isset($signal) && $signal->start_time ? $signal->start_time->format('Y-m-d\TH:i') : '') }}">
                                @error('start_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- End Time Field --}}
                            <div class="mb-3">
                                <label for="end_time" class="form-label">End Time (Optional)</label>
                                <input type="datetime-local" class="form-control @error('end_time') is-invalid @enderror"
                                    id="end_time" name="end_time"
                                    value="{{ old('end_time', isset($signal) && $signal->end_time ? $signal->end_time->format('Y-m-d\TH:i') : '') }}">
                                @error('end_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Is Active Checkbox --}}
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                    value="1" {{ old('is_active', $signal->is_active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Is Active</label>
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane"></i>
                                {{ isset($signal) ? 'Update Signal' : 'Create Signal' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
