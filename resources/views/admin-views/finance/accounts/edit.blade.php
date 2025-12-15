@extends('layouts.back-end.app')
@section('title', translate('edit_finance_account'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('edit_finance_account') }}</h2>
                <p class="text-muted mb-0">{{ translate('update_chart_of_account_details') }}</p>
            </div>
            <a href="{{ route('admin.accounts-finance.accounts.index') }}" class="btn btn-outline-primary">
                <i class="tio-arrow-long-left"></i> {{ translate('back_to_accounts') }}
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.accounts.update', $account) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('code') }}</label>
                        <input type="text" name="code" value="{{ old('code', $account->code) }}" class="form-control" required>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">{{ translate('name') }}</label>
                        <input type="text" name="name" value="{{ old('name', $account->name) }}" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('category') }}</label>
                        <select name="category" class="form-select" required>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ old('category', $account->category) === $category ? 'selected' : '' }}>
                                    {{ translate($category) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('type') }}</label>
                        <select name="type" class="form-select" required>
                            @foreach($types as $type)
                                <option value="{{ $type }}" {{ old('type', $account->type) === $type ? 'selected' : '' }}>
                                    {{ translate($type) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('parent_account') }}</label>
                        <select name="parent_id" class="form-select">
                            <option value="">{{ translate('select_parent_optional') }}</option>
                            @foreach($parentOptions as $option)
                                <option value="{{ $option->id }}" {{ (int) old('parent_id', $account->parent_id) === $option->id ? 'selected' : '' }}>
                                    {{ $option->code }} - {{ $option->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('currency') }}</label>
                        <input type="text" name="currency" value="{{ old('currency', $account->currency) }}" class="form-control" maxlength="3">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('balance_type') }}</label>
                        <select name="balance_type" class="form-select" required>
                            @foreach($balanceTypes as $balance)
                                <option value="{{ $balance }}" {{ old('balance_type', $account->balance_type) === $balance ? 'selected' : '' }}>
                                    {{ translate($balance) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('opening_balance') }}</label>
                        <input type="number" step="0.01" name="opening_balance" value="{{ old('opening_balance', $account->opening_balance) }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{ translate('description') }}</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $account->description) }}</textarea>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActiveCheckbox"
                                   {{ old('is_active', $account->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="isActiveCheckbox">{{ translate('mark_as_active') }}</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn--primary">{{ translate('update_account') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
