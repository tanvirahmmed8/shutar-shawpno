@extends('layouts.back-end.app')
@section('title', translate('balance_sheet'))
@section('content')
    @php
        $balanceFor = static function ($row) {
            $balance = $row->debit_total - $row->credit_total;
            return $row->balance_type === 'credit' ? $balance * -1 : $balance;
        };
    @endphp
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('balance_sheet') }}</h2>
                <p class="text-muted mb-0">{{ translate('snapshot_of_assets_liabilities_and_equity') }}</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.reports.balance-sheet') }}" method="GET" class="row g-3">
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

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header border-0">
                        <h5 class="mb-0">{{ translate('assets') }}</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <tbody>
                                @forelse($assets as $row)
                                    <tr>
                                        <td>{{ $row->code }} - {{ $row->name }}</td>
                                        <td class="text-end">{{ number_format($balanceFor($row), 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted py-4">{{ translate('no_assets_found') }}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr class="bg-light">
                                    <th>{{ translate('total_assets') }}</th>
                                    <th class="text-end">{{ number_format($assetsTotal, 2) }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header border-0">
                        <h5 class="mb-0">{{ translate('liabilities') }}</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <tbody>
                                @forelse($liabilities as $row)
                                    <tr>
                                        <td>{{ $row->code }} - {{ $row->name }}</td>
                                        <td class="text-end">{{ number_format($balanceFor($row), 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted py-4">{{ translate('no_liabilities_found') }}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr class="bg-light">
                                    <th>{{ translate('total_liabilities') }}</th>
                                    <th class="text-end">{{ number_format($liabilitiesTotal, 2) }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header border-0">
                        <h5 class="mb-0">{{ translate('equity') }}</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <tbody>
                                @forelse($equity as $row)
                                    <tr>
                                        <td>{{ $row->code }} - {{ $row->name }}</td>
                                        <td class="text-end">{{ number_format($balanceFor($row), 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted py-4">{{ translate('no_equity_found') }}</td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr class="bg-light">
                                    <th>{{ translate('total_equity') }}</th>
                                    <th class="text-end">{{ number_format($equityTotal, 2) }}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
