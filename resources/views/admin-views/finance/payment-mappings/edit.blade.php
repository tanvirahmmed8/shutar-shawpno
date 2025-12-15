@extends('layouts.back-end.app')
@section('title', translate('payment_method_account_mapping'))
@section('content')
    <div class="content container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <h2 class="h1 mb-0 text-capitalize">{{ translate('payment_method_account_mapping') }}</h2>
                <p class="text-muted mb-0">{{ translate('link_each_payment_method_with_the_finance_accounts_it_should_post_to') }}</p>
            </div>
            <a href="{{ route('admin.accounts-finance.accounts.index') }}" class="btn btn-outline-primary">
                <i class="tio-arrow-long-left"></i> {{ translate('back_to_accounts') }}
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <ul class="mb-0 ps-3">
                    <li>{{ translate('select_all_accounts_that_can_record_each_payment_method_transaction') }}</li>
                    <li>{{ translate('choose_one_default_account_per_method_to_pre_fill_on_forms') }}</li>
                    <li>{{ translate('custom_account_option_will_always_be_available_for_manual_entries') }}</li>
                </ul>
            </div>
        </div>

        <form action="{{ route('admin.accounts-finance.payment-mappings.update') }}" method="POST">
            @csrf
            <div class="row g-4">
                @php($availableAccounts = $accounts ?? [])
                @foreach($methods as $methodKey => $definition)
                    @continue($methodKey === 'default')
                    @php($selectedAccounts = collect(old("methods.$methodKey.accounts", $definition['accounts'] ?? []))->filter()->values()->all())
                    @php($currentDefault = old("methods.$methodKey.default_account", $definition['default_account'] ?? null))
                    <div class="col-xl-6">
                        <div class="card h-100" data-method="{{ $methodKey }}">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="card-title mb-0 text-capitalize">{{ translate($definition['label'] ?? $methodKey) }}</h4>
                                    <small class="text-muted">{{ translate('configure_accessible_accounts_for_this_method') }}</small>
                                </div>
                                <span class="badge badge-soft-info text-uppercase">{{ $methodKey }}</span>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush border rounded">
                                    @forelse($availableAccounts as $accountKey => $account)
                                        @php($inputId = 'map-'.$methodKey.'-'.$accountKey)
                                        <div class="list-group-item d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                                            <div class="form-check m-0">
                                                <input class="form-check-input js-account-checkbox" type="checkbox"
                                                       name="methods[{{ $methodKey }}][accounts][]"
                                                       id="{{ $inputId }}" value="{{ $accountKey }}"
                                                       {{ in_array($accountKey, $selectedAccounts, true) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="{{ $inputId }}">
                                                    <span class="fw-semibold">{{ translate($account['label'] ?? $accountKey) }}</span>
                                                    <span class="text-muted">({{ $account['code'] ?? '--' }})</span>
                                                </label>
                                            </div>
                                            <div class="form-check ms-sm-auto">
                                                <input class="form-check-input js-default-radio" type="radio"
                                                       name="methods[{{ $methodKey }}][default_account]"
                                                       value="{{ $accountKey }}"
                                                       {{ $currentDefault === $accountKey ? 'checked' : '' }}>
                                                <label class="form-check-label small text-muted">{{ translate('default') }}</label>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="list-group-item text-center text-muted py-4">
                                            {{ translate('no_accounts_available') }}
                                        </div>
                                    @endforelse
                                </div>
                                @error("methods.$methodKey.accounts")
                                    <span class="text-danger small d-block mt-2">{{ $message }}</span>
                                @enderror
                                @error("methods.$methodKey.default_account")
                                    <span class="text-danger small d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn--primary">
                    <i class="tio-save"></i> {{ translate('save_mappings') }}
                </button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        (function () {
            function getMethodWrapper(element) {
                return element.closest('[data-method]');
            }

            function selectFallbackDefault(wrapper, excludeValue) {
                if (!wrapper) return;
                const checkedCheckboxes = wrapper.querySelectorAll('.js-account-checkbox:checked');
                if (!checkedCheckboxes.length) {
                    return;
                }
                const fallback = Array.from(checkedCheckboxes).find(function (checkbox) {
                    return checkbox.value !== excludeValue;
                }) || checkedCheckboxes[0];
                const fallbackRadio = wrapper.querySelector('.js-default-radio[value="' + fallback.value + '"]');
                if (fallbackRadio) {
                    fallbackRadio.checked = true;
                }
            }

            document.querySelectorAll('.js-account-checkbox').forEach(function (checkbox) {
                checkbox.addEventListener('change', function (event) {
                    const wrapper = getMethodWrapper(event.target);
                    if (!wrapper) {
                        return;
                    }
                    const relatedRadio = wrapper.querySelector('.js-default-radio[value="' + event.target.value + '"]');
                    if (!relatedRadio) {
                        return;
                    }

                    if (event.target.checked) {
                        const hasDefault = wrapper.querySelector('.js-default-radio:checked');
                        if (!hasDefault) {
                            relatedRadio.checked = true;
                        }
                    } else if (relatedRadio.checked) {
                        selectFallbackDefault(wrapper, event.target.value);
                    }
                });
            });

            document.querySelectorAll('.js-default-radio').forEach(function (radio) {
                radio.addEventListener('change', function (event) {
                    if (!event.target.checked) {
                        return;
                    }
                    const wrapper = getMethodWrapper(event.target);
                    if (!wrapper) {
                        return;
                    }
                    const checkbox = wrapper.querySelector('.js-account-checkbox[value="' + event.target.value + '"]');
                    if (checkbox && !checkbox.checked) {
                        checkbox.checked = true;
                    }
                });
            });
        })();
    </script>
@endpush
