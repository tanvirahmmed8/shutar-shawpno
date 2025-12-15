@extends('layouts.back-end.app')

@push('css_or_js')
    <!-- Custom styles for this page -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom styles for this page -->
@endpush

@section('content')
    <div class="content container-fluid"> <!-- Page Heading -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img width="20" src="{{dynamicAsset(path: 'public/assets/back-end/img/delivery.png')}}" alt="">
                {{translate('shipping_Method')}}
            </h2>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card report-card">
                    <div class="card-header border-0 pb-0">
                        <h5 class="text-capitalize mb-0">{{translate('shipping_method_form')}}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.business-settings.shipping-method.add')}}"
                              class="text-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}"
                              method="post">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="title" class="title-color">{{translate('title')}}</label>
                                    <input type="text" name="title" class="form-control"
                                           placeholder="{{translate('title')}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="duration" class="title-color">{{translate('duration')}}</label>
                                    <input type="text" name="duration" class="form-control"
                                           placeholder="{{translate('ex')}} : {{translate('4_to_6_days')}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="cost" class="title-color">{{translate('cost')}}</label>
                                    <input type="number" min="0" max="1000000" name="cost" class="form-control"
                                           placeholder="{{translate('ex')}} : 10">
                                </div>
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <button type="submit"
                                            class="btn btn--primary px-5">{{translate('submit')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row __mt-20">
            <div class="col-md-12">
                <div class="card report-card">
                    <div class="card-header border-0 pb-0">
                        <h5 class="text-capitalize mb-0">{{translate('shipping_method_table')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table table-sticky"
                                   width="100%" cellspacing="0"
                                   style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                                <thead>
                                <tr>
                                    <th scope="col">{{translate('SL')}}#</th>
                                    <th scope="col">{{translate('title')}}</th>
                                    <th scope="col">{{translate('duration')}}</th>
                                    <th scope="col">{{translate('cost')}}</th>
                                    <th scope="col">{{translate('status')}}</th>
                                    <th scope="col" class="__w-50px">{{translate('action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($shipping_methods as $k=>$method)
                                    <tr>
                                        <th scope="row">{{$k+1}}</th>
                                        <td>{{$method['title']}}</td>
                                        <td>
                                            {{$method['duration']}}
                                        </td>
                                        <td>
                                            {{\App\Utils\BackEndHelper::set_symbol(\App\Utils\BackEndHelper::usd_to_currency($method['cost']))}}
                                        </td>

                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="status"
                                                       id="{{$method['id']}}" {{$method->status == 1?'checked':''}}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>

                                        <td>
                                            <div class="dropdown float-right">
                                                <button class="btn btn-seconary btn-sm dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="tio-settings"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                       href="{{route('admin.business-settings.shipping-method.edit',[$method['id']])}}">{{translate('edit')}}</a>
                                                    <a class="dropdown-item delete cursor-pointer"
                                                       id="{{ $method['id'] }}">{{translate('delete')}}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Call the dataTables jQuery plugin
        $(document).on('change', '.status', function () {
            var id = $(this).attr("id");
            if ($(this).prop("checked") == true) {
                var status = 1;
            } else if ($(this).prop("checked") == false) {
                var status = 0;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('admin.business-settings.shipping-method.status-update')}}",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function () {
                    toastr.success('{{translate("status_updated_successfully")}}');
                }
            });
        });
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            Swal.fire({
                title: '{{translate("are_you_sure_delete_this")}} ?',
                text: "{{translate('you_will_not_be_able_to_revert_this')}}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{translate("yes_delete_it")}}!',
                cancelButtonText: '{{ translate("cancel") }}',
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('admin.business-settings.shipping-method.delete')}}",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('{{translate("shipping_Method_deleted_successfully")}}');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
