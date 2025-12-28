(function (window, $) {
    'use strict';

    if (!$ || typeof $.fn.select2 !== 'function') {
        window.PurchaseProductPicker = {
            init: function () {},
            attach: function () {},
        };
        return;
    }

    var requestCache = Object.create(null);

    function formatText(item) {
        if (!item) {
            return '';
        }
        if (item.loading) {
            return item.text;
        }
        var parts = [];
        if (item.sku) {
            parts.push('[' + item.sku + ']');
        }
        if (item.name) {
            parts.push(item.name);
        } else if (item.text) {
            parts.push(item.text);
        }
        return parts.join(' ').trim();
    }

    function resolveEndpoint(select) {
        if (select.dataset.searchEndpoint) {
            return select.dataset.searchEndpoint;
        }
        var container = select.closest('[data-product-search-endpoint]');
        if (container && container.dataset.productSearchEndpoint) {
            return container.dataset.productSearchEndpoint;
        }
        return '';
    }

    function resolveVendorId(select) {
        if (!select) {
            return '';
        }
        if (select.dataset.vendorId) {
            return select.dataset.vendorId;
        }
        var host = select.closest('[data-line-items]');
        if (host) {
            if (host.dataset.vendorId) {
                return host.dataset.vendorId;
            }
            if (host.dataset.vendorField) {
                var field = document.querySelector(host.dataset.vendorField);
                if (field && field.value) {
                    return field.value;
                }
            }
        }
        return '';
    }

    function setFieldValue(input, value, triggerInputEvent) {
        if (!input) {
            return;
        }
        if (typeof value === 'undefined' || value === null || value === '') {
            return;
        }
        input.value = value;
        if (triggerInputEvent) {
            input.dispatchEvent(new Event('input', {bubbles: true}));
        }
    }

    function buildCacheKey(endpoint, params) {
        var payload = params || {};
        return [endpoint || '', payload.q || '', payload.page || 1, payload.vendor_id || ''].join('::');
    }

    function getMessageElement(select) {
        if (!select || !select.parentElement) {
            return null;
        }
        var message = select.parentElement.querySelector('[data-product-picker-message]');
        if (!message) {
            message = document.createElement('small');
            message.dataset.productPickerMessage = 'true';
            message.className = 'text-danger d-block mt-1';
            select.parentElement.appendChild(message);
        }
        return message;
    }

    function showMessage(select, text) {
        var element = getMessageElement(select);
        if (!element) {
            return;
        }
        element.textContent = text || '';
    }

    function clearMessage(select) {
        if (!select || !select.parentElement) {
            return;
        }
        var message = select.parentElement.querySelector('[data-product-picker-message]');
        if (message) {
            message.textContent = '';
        }
    }

    var plugin = {
        init: function (root) {
            var context = root instanceof Element ? root : document;
            context.querySelectorAll('[data-product-picker]').forEach(function (select) {
                plugin.attach(select);
            });
        },
        attach: function (select) {
            if (!select || select.dataset.productPickerReady === 'true') {
                return;
            }

            var endpoint = resolveEndpoint(select);
            if (!endpoint) {
                return;
            }

            var initialId = select.dataset.initialId || '';
            var initialLabel = select.dataset.initialLabel || '';
            var placeholder = select.dataset.placeholder || '';

            var config = {
                allowClear: true,
                placeholder: placeholder,
                ajax: {
                    url: endpoint,
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        var payload = {
                            q: params.term || '',
                            page: params.page || 1,
                        };
                        var vendorId = plugin.resolveVendorId(select);
                        if (vendorId) {
                            payload.vendor_id = vendorId;
                        }
                        return payload;
                    },
                    transport: function (params, success, failure) {
                        var payload = params.data || {};
                        var cacheKey = buildCacheKey(endpoint, payload);
                        if (requestCache[cacheKey]) {
                            success(requestCache[cacheKey]);
                            return;
                        }

                        var request = $.ajax(params);
                        request.done(function (data) {
                            requestCache[cacheKey] = data;
                            clearMessage(select);
                            success(data);
                        });

                        request.fail(function (jqXHR) {
                            var status = jqXHR && jqXHR.status;
                            var message = status === 404
                                ? 'The selected product is no longer available.'
                                : 'Unable to load products. Please check your connection or use manual lookup.';
                            showMessage(select, message);
                            if (typeof failure === 'function') {
                                failure(jqXHR);
                            }
                        });

                        return request;
                    },
                    processResults: function (data) {
                        return {
                            results: (data && data.results) ? data.results : [],
                            pagination: (data && data.pagination) ? data.pagination : { more: false },
                        };
                    },
                },
                minimumInputLength: 1,
                templateResult: formatText,
                templateSelection: function (item) {
                    if (!item || typeof item.id === 'undefined') {
                        return placeholder;
                    }
                    return formatText(item);
                },
                width: '100%'
            };

            if (initialId && initialLabel && select.querySelector('option[value="' + initialId + '"]') === null) {
                var option = new Option(initialLabel, initialId, true, true);
                select.appendChild(option);
            }

            $(select).select2(config);
            select.dataset.productPickerReady = 'true';

            $(select).on('select2:select', function (event) {
                plugin.updateSnapshot(select, event.params && event.params.data ? event.params.data : null);
                clearMessage(select);
            });

            $(select).on('select2:clear', function () {
                plugin.updateSnapshot(select, null);
                clearMessage(select);
            });
        },
        resolveVendorId: function (select) {
            return resolveVendorId(select);
        },
        clearCache: function () {
            requestCache = Object.create(null);
        },
        updateSnapshot: function (select, payload) {
            var row = select.closest('[data-product-row]');
            if (!row) {
                return;
            }

            var snapshot = {
                id: payload && payload.id ? payload.id : '',
                sku: payload && payload.sku ? payload.sku : (payload && payload.code ? payload.code : ''),
                name: payload && payload.name ? payload.name : '',
                uom: payload && payload.unit ? payload.unit : '',
                purchase_price: (payload && typeof payload.purchase_price !== 'undefined') ? payload.purchase_price : '',
                label: payload && payload.text ? payload.text : formatText(payload),
            };

            Object.keys(snapshot).forEach(function (key) {
                var input = row.querySelector('[data-product-snapshot="' + key + '"]');
                if (input) {
                    input.value = snapshot[key] !== undefined && snapshot[key] !== null ? snapshot[key] : '';
                }
            });

            plugin.applyDefaults(row, payload);
        },
        applyDefaults: function (row, payload) {
            if (!payload || !row) {
                return;
            }

            var descriptionInput = row.querySelector('[data-product-description]');
            var uomInput = row.querySelector('[data-product-uom]');
            var priceInput = row.querySelector('[data-product-unit-price]');

            var description = payload.name || payload.text || '';
            var uom = payload.unit || payload.uom || '';
            var price = (typeof payload.purchase_price !== 'undefined') ? payload.purchase_price : '';

            setFieldValue(descriptionInput, description, false);
            setFieldValue(uomInput, uom, false);
            setFieldValue(priceInput, price, true);
        }
    };

    window.PurchaseProductPicker = plugin;
})(window, window.jQuery);
