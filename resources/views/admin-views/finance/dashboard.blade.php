@extends('layouts.back-end.app')
@section('title', translate('accounts_finance_dashboard'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
            <div>
                <h2 class="h1 mb-1 text-capitalize">{{ $sectionTitle }}</h2>
                <p class="text-muted mb-0">{{ $introText }}</p>
            </div>
            <a href="{{ route('admin.accounts-finance.reports.trial-balance') }}" class="btn btn--primary">
                {{ translate('view_finance_reports') }}
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-header border-0">
                <h4 class="mb-0 text-capitalize">{{ translate('finance_dashboard_filters') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.dashboard') }}" method="GET" class="row g-3">
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

        @php
            $metricCards = [
                [
                    'label' => translate('total_debit_posted'),
                    'value' => number_format($metrics['total_debit'], 2),
                    'delta' => translate('trial_balance_total_debit'),
                ],
                [
                    'label' => translate('total_credit_posted'),
                    'value' => number_format($metrics['total_credit'], 2),
                    'delta' => translate('trial_balance_total_credit'),
                ],
                [
                    'label' => translate('net_income_to_date'),
                    'value' => number_format($incomeStatement['net_income'], 2),
                    'delta' => translate('income_statement_net_income'),
                ],
                [
                    'label' => translate('posted_journals_count'),
                    'value' => number_format($metrics['posted_journals']),
                    'delta' => translate('journals_posted_help_text'),
                ],
                [
                    'label' => translate('pending_finance_transfers'),
                    'value' => number_format($metrics['pending_transfers']),
                    'delta' => translate('transfers_pending_help_text'),
                ],
            ];
        @endphp

        <div class="row g-3 mb-4">
            @foreach($metricCards as $card)
                <div class="col-sm-6 col-xl-3">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <p class="text-muted text-uppercase fs-12 mb-1">{{ $card['label'] }}</p>
                            <h3 class="mb-1">{{ $card['value'] }}</h3>
                            <p class="text-muted fs-12 mb-0">{{ $card['delta'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card">
            <div class="card-header border-0 d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h4 class="mb-1 text-capitalize">{{ translate('trial_balance_totals') }}</h4>
                    <p class="text-muted mb-0">{{ translate('trial_balance_totals_help_text') }}</p>
                </div>
                <a href="{{ route('admin.accounts-finance.reports.trial-balance', request()->query()) }}" class="btn btn-outline-primary">
                    {{ translate('open_trial_balance') }}
                </a>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="bg-soft-primary rounded p-4 h-100">
                            <p class="text-muted text-uppercase mb-1">{{ translate('total_debit_posted') }}</p>
                            <h2 class="mb-0">{{ number_format($metrics['total_debit'], 2) }}</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-soft-success rounded p-4 h-100">
                            <p class="text-muted text-uppercase mb-1">{{ translate('total_credit_posted') }}</p>
                            <h2 class="mb-0">{{ number_format($metrics['total_credit'], 2) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header border-0 d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h4 class="mb-1 text-capitalize">{{ translate('income_statement_snapshot') }}</h4>
                    <p class="text-muted mb-0">{{ translate('income_statement_snapshot_help_text') }}</p>
                </div>
                <a href="{{ route('admin.accounts-finance.reports.income-statement', request()->query()) }}" class="btn btn-outline-primary">
                    {{ translate('open_income_statement') }}
                </a>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="text-center">
                            <p class="text-muted text-uppercase mb-1">{{ translate('revenues') }}</p>
                            <h2 class="mb-0">{{ number_format($incomeStatement['revenue_total'], 2) }}</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <p class="text-muted text-uppercase mb-1">{{ translate('expenses') }}</p>
                            <h2 class="mb-0">{{ number_format($incomeStatement['expense_total'], 2) }}</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <p class="text-muted text-uppercase mb-1">{{ translate('net_income_to_date') }}</p>
                            <h2 class="mb-0">{{ number_format($incomeStatement['net_income'], 2) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
