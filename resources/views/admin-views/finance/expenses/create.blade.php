@extends('layouts.back-end.app')
@section('title', translate('add_finance_expense'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('add_finance_expense') }}</h2>
                <p class="text-muted mb-0">{{ translate('record_spend_before_posting_to_ledger') }}</p>
            </div>
            <a href="{{ route('admin.accounts-finance.expenses.index') }}" class="btn btn-outline-primary">
                <i class="tio-arrow-long-left"></i> {{ translate('back_to_expenses') }}
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.expenses.store') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('expense_number') }}</label>
                        <input type="text" name="expense_number" value="{{ old('expense_number') }}" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('account') }}</label>
                        <select name="account_id" class="form-select">
                            <option value="">{{ translate('select_account_optional') }}</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}" {{ old('account_id') == $account->id ? 'selected' : '' }}>
                                    {{ $account->code }} - {{ $account->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('category') }}</label>
                        <input type="text" name="category" value="{{ old('category') }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('payee_type') }}</label>
                        <input type="text" name="payee_type" value="{{ old('payee_type') }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('payee_id') }}</label>
                        <input type="number" name="payee_id" value="{{ old('payee_id') }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('expense_date') }}</label>
                        <input type="date" name="expense_date" value="{{ old('expense_date') }}" class="form-control">
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
                        <label class="form-label">{{ translate('purpose') }}</label>
                        <textarea name="purpose" class="form-control" rows="3">{{ old('purpose') }}</textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn--primary">{{ translate('save_expense') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
