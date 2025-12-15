@extends('layouts.back-end.app')
@section('title', translate('cash_flow'))
@section('content')
    @php
        $netFor = static function ($row) {
            $balance = $row->debit_total - $row->credit_total;
            return $row->balance_type === 'credit' ? $balance * -1 : $balance;
        };
        $bucketLabels = [
            'operating' => translate('operating_activities'),
            'investing' => translate('investing_activities'),
            'financing' => translate('financing_activities'),
        ];
    @endphp
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('cash_flow_statement') }}</h2>
                <p class="text-muted mb-0">{{ translate('understand_cash_movement_across_periods') }}</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.reports.cash-flow') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('fiscal_period') }}</label>
                        <select name="fiscal_period_id" class="form-select">
                            <option value="">{{ translate('all_periods') }}</option>
                            @foreach($periods as $period)
                                <option value="{{ $period->id }}" {{ $filters['fiscal_period_id'] == $period->id ? 'selected' : '' }}>
                                    {{ $period->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ translate('date_from') }}</label>
                        <input type="date" name="date_from" value="{{ $filters['date_from'] }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ translate('date_to') }}</label>
                        <input type="date" name="date_to" value="{{ $filters['date_to'] }}" class="form-control">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn--primary w-100">{{ translate('apply_filters') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-4 mb-4">
            @foreach($summary as $bucket => $value)
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <p class="text-muted text-uppercase small mb-2">{{ $bucketLabels[$bucket] ?? ucfirst($bucket) }}</p>
                            <h3 class="mb-0">{{ number_format($value, 2) }}</h3>
                            <span class="badge badge-soft-{{ $value >= 0 ? 'success' : 'danger' }} text-uppercase mt-3">
                                {{ $value >= 0 ? translate('inflow') : translate('outflow') }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card">
            <div class="card-header border-0">
                <h5 class="mb-0">{{ translate('supporting_accounts') }}</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                    <tr>
                        <th>{{ translate('account_code') }}</th>
                        <th>{{ translate('account_name') }}</th>
                        <th>{{ translate('category') }}</th>
                        <th class="text-end">{{ translate('net_cash_effect') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($rows as $row)
                        <tr>
                            <td>{{ $row->code }}</td>
                            <td>{{ $row->name }}</td>
                            <td class="text-capitalize">{{ $row->category ?? translate('uncategorized') }}</td>
                            <td class="text-end">{{ number_format($netFor($row), 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">{{ translate('no_activity_for_selected_filters') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
