@extends('layouts.back-end.app')
@section('title', translate('transfer_details'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('transfer_details') }}</h2>
                <p class="text-muted mb-0">{{ translate('confirm_balances_and_audit_trail_before_posting') }}</p>
            </div>
            <a href="{{ route('admin.accounts-finance.transfers.index') }}" class="btn btn-outline-primary">
                <i class="tio-arrow-long-left"></i> {{ translate('back_to_transfers') }}
            </a>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <h6 class="text-muted text-uppercase">{{ translate('transfer_number') }}</h6>
                                <p class="h5 mb-0">{{ $transfer->transfer_number }}</p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-muted text-uppercase">{{ translate('status') }}</h6>
                                <span class="badge badge-soft-{{ $transfer->status === 'approved' ? 'success' : 'secondary' }} text-uppercase">{{ translate($transfer->status) }}</span>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-muted text-uppercase">{{ translate('initiated_at') }}</h6>
                                <p class="mb-0">{{ optional($transfer->initiated_at)->format('M d, Y H:i') ?? translate('not_set') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase">{{ translate('source_account') }}</h6>
                                <p class="mb-0">{{ $transfer->sourceAccount->code ?? translate('unassigned') }} - {{ $transfer->sourceAccount->name ?? '' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase">{{ translate('destination_account') }}</h6>
                                <p class="mb-0">{{ $transfer->destinationAccount->code ?? translate('unassigned') }} - {{ $transfer->destinationAccount->name ?? '' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase">{{ translate('amount') }}</h6>
                                <p class="mb-0 h4">{{ number_format($transfer->amount, 2) }} {{ $transfer->currency }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted text-uppercase">{{ translate('exchange_rate') }}</h6>
                                <p class="mb-0">{{ $transfer->exchange_rate ?? 1 }}</p>
                            </div>
                            <div class="col-12">
                                <h6 class="text-muted text-uppercase">{{ translate('memo') }}</h6>
                                <p class="mb-0">{{ $transfer->memo ?? translate('not_provided') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-3">{{ translate('activity') }}</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><strong>{{ translate('initiated_by') }}:</strong> {{ $transfer->initiator->name ?? translate('system') }}</li>
                            <li class="mb-2"><strong>{{ translate('approved_by') }}:</strong> {{ $transfer->approver->name ?? translate('pending') }}</li>
                            <li class="mb-2"><strong>{{ translate('approved_at') }}:</strong> {{ optional($transfer->approved_at)->format('M d, Y H:i') ?? translate('pending') }}</li>
                            <li class="mb-2"><strong>{{ translate('linked_journal') }}:</strong> {{ $transfer->journal_id ?? translate('not_set') }}</li>
                        </ul>
                    </div>
                </div>

                @if($transfer->status !== 'approved')
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">{{ translate('update_status') }}</h5>
                            @php($statusOptions = ['draft', 'pending', 'approved', 'rejected'])
                            <form action="{{ route('admin.accounts-finance.transfers.approve', $transfer) }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-12">
                                    <label class="form-label">{{ translate('status') }}</label>
                                    <select name="status" class="form-select">
                                        @foreach($statusOptions as $status)
                                            <option value="{{ $status }}" {{ $transfer->status === $status ? 'selected' : '' }}>{{ translate($status) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">{{ translate('link_journal_optional') }}</label>
                                    <input type="number" name="journal_id" value="{{ old('journal_id', $transfer->journal_id) }}" class="form-control" placeholder="{{ translate('enter_journal_id') }}">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn--primary w-100">{{ translate('save_changes') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="tio-checkmark-circle-outlined display-4 text-success mb-3"></i>
                            <p class="mb-0">{{ translate('transfer_is_posted_and_locked') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
