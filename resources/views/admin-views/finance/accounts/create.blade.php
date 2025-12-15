@extends('layouts.back-end.app')
@section('title', translate('add_finance_account'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('add_finance_account') }}</h2>
                <p class="text-muted mb-0">{{ translate('define_new_chart_of_account_entry') }}</p>
            </div>
            <a href="{{ route('admin.accounts-finance.accounts.index') }}" class="btn btn-outline-primary">
                <i class="tio-arrow-long-left"></i> {{ translate('back_to_accounts') }}
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.accounts.store') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('code') }}</label>
                        <input type="text" name="code" value="{{ old('code') }}" class="form-control" required>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">{{ translate('name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('category') }}</label>
                        <select name="category" class="form-select" required>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ old('category') === $category ? 'selected' : '' }}>
                                    {{ translate($category) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('type') }}</label>
                        <select name="type" class="form-select" required>
                            @foreach($types as $type)
                                <option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>
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
                                <option value="{{ $option->id }}" {{ old('parent_id') == $option->id ? 'selected' : '' }}>
                                    {{ $option->code }} - {{ $option->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('currency') }}</label>
                        <input type="text" name="currency" value="{{ old('currency', config('app.currency', 'USD')) }}" class="form-control" maxlength="3">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('balance_type') }}</label>
                        <select name="balance_type" class="form-select" required>
                            @foreach($balanceTypes as $balance)
                                <option value="{{ $balance }}" {{ old('balance_type') === $balance ? 'selected' : '' }}>
                                    {{ translate($balance) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('opening_balance') }}</label>
                        <input type="number" step="0.01" name="opening_balance" value="{{ old('opening_balance', 0) }}" class="form-control">
                    </div>
                    <div class="col-12">
                        <label class="form-label">{{ translate('description') }}</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActiveCheckbox" checked>
                            <label class="form-check-label" for="isActiveCheckbox">{{ translate('mark_as_active') }}</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn--primary">{{ translate('save_account') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
