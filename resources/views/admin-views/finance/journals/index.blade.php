@extends('layouts.back-end.app')
@section('title', translate('finance_journals'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('finance_journals') }}</h2>
                <p class="text-muted mb-0">{{ translate('review_manual_and_system_generated_entries') }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.accounts-finance.journals.create') }}" class="btn btn--primary">
                    <i class="tio-add"></i> {{ translate('add_journal') }}
                </a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.journals.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">{{ translate('search') }}</label>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ translate('search_by_number_or_reference') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ translate('status') }}</label>
                        <select name="status" class="form-select">
                            <option value="">{{ translate('all_status') }}</option>
                            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>{{ translate('draft') }}</option>
                            <option value="posted" {{ request('status') === 'posted' ? 'selected' : '' }}>{{ translate('posted') }}</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ translate('fiscal_period') }}</label>
                        <select name="fiscal_period_id" class="form-select">
                            <option value="">{{ translate('all_periods') }}</option>
                            @foreach($periods as $period)
                                <option value="{{ $period->id }}" {{ request('fiscal_period_id') == $period->id ? 'selected' : '' }}>
                                    {{ $period->name }}
                                </option>
                            @endforeach
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
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                    <tr>
                        <th>{{ translate('journal_number') }}</th>
                        <th>{{ translate('entry_date') }}</th>
                        <th>{{ translate('period') }}</th>
                        <th>{{ translate('lines') }}</th>
                        <th>{{ translate('status') }}</th>
                        <th class="text-center">{{ translate('actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($journals as $journal)
                        <tr>
                            <td>{{ $journal->journal_number }}</td>
                            <td>{{ $journal->entry_date->format('M d, Y') }}</td>
                            <td>{{ $journal->fiscalPeriod->name ?? translate('unassigned') }}</td>
                            <td>{{ $journal->line_count }}</td>
                            <td>
                                <span class="badge badge-soft-{{ $journal->status === 'posted' ? 'success' : 'secondary' }} text-uppercase">
                                    {{ translate($journal->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.accounts-finance.journals.show', $journal) }}" class="btn btn-sm btn-outline-secondary">{{ translate('view') }}</a>
                                    @if($journal->status !== 'posted')
                                        <a href="{{ route('admin.accounts-finance.journals.edit', $journal) }}" class="btn btn-sm btn-outline-primary">{{ translate('edit') }}</a>
                                        <form action="{{ route('admin.accounts-finance.journals.destroy', $journal) }}" method="POST" onsubmit="return confirm('{{ translate('are_you_sure') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">{{ translate('delete') }}</button>
                                        </form>
                                        <form action="{{ route('admin.accounts-finance.journals.post', $journal) }}" method="POST" onsubmit="return confirm('{{ translate('confirm_post_journal') }}');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success">{{ translate('post') }}</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">{{ translate('no_journals_found') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $journals->links() }}
            </div>
        </div>
    </div>
@endsection
