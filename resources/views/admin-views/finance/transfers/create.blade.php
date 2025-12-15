@extends('layouts.back-end.app')
@section('title', translate('create_transfer'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('create_transfer') }}</h2>
                <p class="text-muted mb-0">{{ translate('move_balance_between_accounts_securely') }}</p>
            </div>
            <a href="{{ route('admin.accounts-finance.transfers.index') }}" class="btn btn-outline-primary">
                <i class="tio-arrow-long-left"></i> {{ translate('back_to_transfers') }}
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.transfers.store') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('transfer_number') }}</label>
                        <input type="text" name="transfer_number" value="{{ old('transfer_number') }}" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('source_account') }}</label>
                        <select name="source_account_id" class="form-select" required>
                            <option value="">{{ translate('select_source_account') }}</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}" {{ old('source_account_id') == $account->id ? 'selected' : '' }}>
                                    {{ $account->code }} - {{ $account->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('destination_account') }}</label>
                        <select name="destination_account_id" class="form-select" required>
                            <option value="">{{ translate('select_destination_account') }}</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}" {{ old('destination_account_id') == $account->id ? 'selected' : '' }}>
                                    {{ $account->code }} - {{ $account->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('amount') }}</label>
                        <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('currency') }}</label>
                        <input type="text" name="currency" value="{{ old('currency', config('app.currency', 'USD')) }}" class="form-control" maxlength="3" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('exchange_rate') }}</label>
                        <input type="number" step="0.0001" name="exchange_rate" value="{{ old('exchange_rate', 1) }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('status') }}</label>
                        <select name="status" class="form-select">
                            <option value="">{{ translate('select_status') }}</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ old('status', 'draft') === $status ? 'selected' : '' }}>{{ translate($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">{{ translate('memo') }}</label>
                        <textarea name="memo" class="form-control" rows="3">{{ old('memo') }}</textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn--primary">{{ translate('submit_transfer') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
