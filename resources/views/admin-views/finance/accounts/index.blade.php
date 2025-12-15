@extends('layouts.back-end.app')
@section('title', translate('finance_accounts'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('finance_accounts') }}</h2>
                <p class="text-muted mb-0">{{ translate('manage_chart_of_accounts_and_balances') }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.accounts-finance.payment-mappings.edit') }}" class="btn btn-outline-secondary">
                    <i class="tio-settings"></i> {{ translate('payment_mappings') }}
                </a>
                <a href="{{ route('admin.accounts-finance.accounts.create') }}" class="btn btn--primary">
                    <i class="tio-add"></i> {{ translate('add_account') }}
                </a>
                <a href="{{ route('admin.accounts-finance.accounts.export', request()->query()) }}" class="btn btn-outline-primary">
                    <i class="tio-download-to"></i> {{ translate('export_csv') }}
                </a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.accounts.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label text-capitalize">{{ translate('search') }}</label>
                        <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" class="form-control"
                               placeholder="{{ translate('search_by_code_or_name') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-capitalize">{{ translate('category') }}</label>
                        <select name="category" class="form-select">
                            <option value="">{{ translate('all_categories') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ ($filters['category'] ?? '') === $category ? 'selected' : '' }}>
                                    {{ translate($category) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-capitalize">{{ translate('status') }}</label>
                        <select name="status" class="form-select">
                            <option value="">{{ translate('all_status') }}</option>
                            <option value="active" {{ ($filters['status'] ?? '') === 'active' ? 'selected' : '' }}>{{ translate('active') }}</option>
                            <option value="inactive" {{ ($filters['status'] ?? '') === 'inactive' ? 'selected' : '' }}>{{ translate('inactive') }}</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn--primary w-100">{{ translate('filter') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover table-borderless align-middle mb-0">
                    <thead class="bg-light">
                    <tr>
                        <th>{{ translate('code') }}</th>
                        <th>{{ translate('name') }}</th>
                        <th>{{ translate('category') }}</th>
                        <th>{{ translate('type') }}</th>
                        <th>{{ translate('currency') }}</th>
                        <th>{{ translate('balance_type') }}</th>
                        <th class="text-end">{{ translate('balance') }}</th>
                        <th>{{ translate('status') }}</th>
                        <th class="text-center">{{ translate('actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($accounts as $account)
                        <tr>
                            <td class="fw-semibold">{{ $account->code }}</td>
                            <td>{{ $account->name }}</td>
                            <td class="text-capitalize">{{ $account->category }}</td>
                            <td class="text-capitalize">{{ $account->type }}</td>
                            <td>{{ $account->currency }}</td>
                            <td class="text-capitalize">{{ $account->balance_type }}</td>
                            <td class="text-end">{{ number_format($account->current_balance ?? ($account->opening_balance ?? 0), 2) }}</td>
                            <td>
                                <span class="badge badge-soft-{{ $account->is_active ? 'success' : 'secondary' }}">
                                    {{ $account->is_active ? translate('active') : translate('inactive') }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.accounts-finance.accounts.edit', $account) }}" class="btn btn-sm btn-outline-primary">
                                        {{ translate('edit') }}
                                    </a>
                                    <form action="{{ route('admin.accounts-finance.accounts.destroy', $account) }}" method="POST"
                                          onsubmit="return confirm('{{ translate('are_you_sure') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">{{ translate('delete') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-5">{{ translate('no_accounts_found') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $accounts->links() }}
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0 text-capitalize">{{ translate('bulk_import') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.accounts.import') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label class="form-label text-capitalize">{{ translate('upload_csv_file') }}</label>
                        <input type="file" name="accounts_csv" class="form-control" required>
                        <small class="text-muted">{{ translate('expected_columns') }}: code,name,category,type,balance_type,currency,status</small>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn--primary w-100">{{ translate('import') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
