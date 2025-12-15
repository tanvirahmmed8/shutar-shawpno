@extends('layouts.back-end.app')
@section('title', translate('trial_balance'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('trial_balance') }}</h2>
                <p class="text-muted mb-0">{{ translate('validate_total_debits_equal_total_credits') }}</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.reports.trial-balance') }}" method="GET" class="row g-3">
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

        <div class="card">
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                    <tr>
                        <th>{{ translate('account_code') }}</th>
                        <th>{{ translate('account_name') }}</th>
                        <th class="text-end">{{ translate('debit_total') }}</th>
                        <th class="text-end">{{ translate('credit_total') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($rows as $row)
                        <tr>
                            <td>{{ $row->code }}</td>
                            <td>{{ $row->name }}</td>
                            <td class="text-end">{{ number_format($row->debit_total, 2) }}</td>
                            <td class="text-end">{{ number_format($row->credit_total, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">{{ translate('no_activity_for_selected_filters') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot class="bg-light">
                    <tr>
                        <th colspan="2">{{ translate('totals') }}</th>
                        <th class="text-end">{{ number_format($totals['debit'], 2) }}</th>
                        <th class="text-end">{{ number_format($totals['credit'], 2) }}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
