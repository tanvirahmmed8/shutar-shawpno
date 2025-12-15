@extends('layouts.back-end.app')
@section('title', translate('new_reconciliation'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('new_reconciliation') }}</h2>
                <p class="text-muted mb-0">{{ translate('import_bank_or_gateway_statement_rows') }}</p>
            </div>
            <a href="{{ route('admin.accounts-finance.reconciliations.index') }}" class="btn btn-outline-primary">
                <i class="tio-arrow-long-left"></i> {{ translate('back_to_reconciliations') }}
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.accounts-finance.reconciliations.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('account') }}</label>
                            <select name="account_id" class="form-select" required>
                                <option value="">{{ translate('select_account') }}</option>
                                @foreach($accounts as $account)
                                    <option value="{{ $account->id }}" {{ old('account_id') == $account->id ? 'selected' : '' }}>
                                        {{ $account->code }} - {{ $account->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('statement_name') }}</label>
                            <input type="text" name="statement_name" value="{{ old('statement_name') }}" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('statement_date') }}</label>
                            <input type="date" name="statement_date" value="{{ old('statement_date', now()->toDateString()) }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('import_source') }}</label>
                            <input type="text" name="import_source" value="{{ old('import_source') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('opening_balance') }}</label>
                            <input type="number" step="0.01" name="opening_balance" value="{{ old('opening_balance', 0) }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">{{ translate('closing_balance') }}</label>
                            <input type="number" step="0.01" name="closing_balance" value="{{ old('closing_balance', 0) }}" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">{{ translate('notes') }}</label>
                            <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">{{ translate('statement_rows') }}</h4>
                        <button type="button" class="btn btn-outline-primary" id="addRow">{{ translate('add_row') }}</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm" id="reconciliationRows">
                            <thead class="bg-light">
                            <tr>
                                <th>{{ translate('date') }}</th>
                                <th>{{ translate('description') }}</th>
                                <th>{{ translate('reference') }}</th>
                                <th>{{ translate('amount') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 0; $i < max(3, old('rows') ? count(old('rows')) : 3); $i++)
                                <tr>
                                    <td><input type="date" name="rows[{{ $i }}][transaction_date]" value="{{ old("rows.$i.transaction_date") }}" class="form-control"></td>
                                    <td><input type="text" name="rows[{{ $i }}][description]" value="{{ old("rows.$i.description") }}" class="form-control"></td>
                                    <td><input type="text" name="rows[{{ $i }}][reference]" value="{{ old("rows.$i.reference") }}" class="form-control"></td>
                                    <td><input type="number" step="0.01" name="rows[{{ $i }}][amount]" value="{{ old("rows.$i.amount") }}" class="form-control" required></td>
                                    <td class="text-end"><button type="button" class="btn btn-link text-danger p-0 remove-row">{{ translate('remove') }}</button></td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn--primary">{{ translate('save_reconciliation') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
<script>
    (function () {
        const tableBody = document.querySelector('#reconciliationRows tbody');
        const addButton = document.getElementById('addRow');
        if (!tableBody || !addButton) {
            return;
        }

        addButton.addEventListener('click', () => {
            const index = tableBody.children.length;
            const template = `
                <tr>
                    <td><input type="date" name="rows[${index}][transaction_date]" class="form-control"></td>
                    <td><input type="text" name="rows[${index}][description]" class="form-control"></td>
                    <td><input type="text" name="rows[${index}][reference]" class="form-control"></td>
                    <td><input type="number" step="0.01" name="rows[${index}][amount]" class="form-control" required></td>
                    <td class="text-end"><button type="button" class="btn btn-link text-danger p-0 remove-row">{{ translate('remove') }}</button></td>
                </tr>`;
            tableBody.insertAdjacentHTML('beforeend', template);
        });

        tableBody.addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-row') && tableBody.children.length > 1) {
                event.target.closest('tr').remove();
            }
        });
    })();
</script>
@endpush
