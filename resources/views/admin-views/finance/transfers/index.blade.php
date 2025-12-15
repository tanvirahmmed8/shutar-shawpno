@extends('layouts.back-end.app')
@section('title', translate('account_transfers'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('account_transfers') }}</h2>
                <p class="text-muted mb-0">{{ translate('monitor_internal_movement_between_accounts') }}</p>
            </div>
            <a href="{{ route('admin.accounts-finance.transfers.create') }}" class="btn btn--primary">
                <i class="tio-add"></i> {{ translate('create_transfer') }}
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.transfers.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('status') }}</label>
                        <select name="status" class="form-select">
                            <option value="">{{ translate('all_status') }}</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ $statusFilter === $status ? 'selected' : '' }}>{{ translate($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn--primary w-100">{{ translate('filter') }}</button>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <a href="{{ route('admin.accounts-finance.transfers.index') }}" class="btn btn-outline-secondary w-100">{{ translate('reset') }}</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                    <tr>
                        <th>{{ translate('transfer_number') }}</th>
                        <th>{{ translate('source_account') }}</th>
                        <th>{{ translate('destination_account') }}</th>
                        <th class="text-end">{{ translate('amount') }}</th>
                        <th>{{ translate('status') }}</th>
                        <th class="text-center">{{ translate('actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($transfers as $transfer)
                        <tr>
                            <td>{{ $transfer->transfer_number }}</td>
                            <td>{{ $transfer->sourceAccount->code ?? translate('unassigned') }} - {{ $transfer->sourceAccount->name ?? '' }}</td>
                            <td>{{ $transfer->destinationAccount->code ?? translate('unassigned') }} - {{ $transfer->destinationAccount->name ?? '' }}</td>
                            <td class="text-end">{{ number_format($transfer->amount, 2) }} {{ $transfer->currency }}</td>
                            <td>
                                <span class="badge badge-soft-{{ $transfer->status === 'approved' ? 'success' : 'secondary' }} text-uppercase">
                                    {{ translate($transfer->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.accounts-finance.transfers.show', $transfer) }}" class="btn btn-sm btn-outline-secondary">{{ translate('view') }}</a>
                                    @if($transfer->status !== 'approved')
                                        <form action="{{ route('admin.accounts-finance.transfers.destroy', $transfer) }}" method="POST" onsubmit="return confirm('{{ translate('are_you_sure') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">{{ translate('delete') }}</button>
                                        </form>
                                        <form action="{{ route('admin.accounts-finance.transfers.approve', $transfer) }}" method="POST" onsubmit="return confirm('{{ translate('confirm_update_transfer_status') }}');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success">{{ translate('update_status') }}</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">{{ translate('no_transfers_found') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $transfers->links() }}
            </div>
        </div>
    </div>
@endsection
