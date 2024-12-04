<x-default-layout>
    @section('title')
        @lang('common.products')
    @endsection
    @section('breadcrumbs')
        {{ Breadcrumbs::render('menu-management.categories.index') }}
    @endsection

    <x-slot name="header">
        <h1 class="page-title">@yield('title')</h1>
    </x-slot>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">@lang('common.categories')</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3 justify-content-between">
                <div class="col-md-4">
                    <select id="parent_id" name="parent_id" class="form-control" data-control="select2"
                            data-placeholder="@lang('common.select_parent_category')">
                        <option></option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <button id="filter_button" class="btn btn-primary">@lang('common.filter')</button>
                    <button id="reset_button" class="btn btn-secondary">@lang('common.reset')</button>
                </div>
            </div>
            <table class="table table-row-bordered gy-5" id="categories-table">
                <thead>
                <tr>
                    <th>@lang('common.dt_name')</th>
                    <th>@lang('common.dt_description')</th>
                    <th>@lang('common.dt_image')</th>
                    <th>@lang('common.dt_parent_category')</th>
                    <th>@lang('common.dt_actions')</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#categories-table').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    language: {
                        url: languageUrl
                    },
                    ajax: {
                        url: '{{ route('menu-management.categories.data') }}',
                        data: function (d) {
                            d.parent_id = $('#parent_id').val();
                        }
                    },
                    columns: [
                        {
                            data: 'name', name: 'name', defaultContent: "-",
                        },
                        {
                            data: 'description', name: 'description', defaultContent: "-",
                        },
                        {
                            data: 'image_path', name: 'image_path', defaultContent: "-",
                            render: function (data, type, row) {
                                return `<img src="${data}" class="img-fluid" style="max-width: 100px;">`;
                            }
                        },
                        {
                            data: 'parent_name',
                            name: 'parent_name',
                            defaultContent: "-",
                            render: function (data, type, row) {
                                const randomColor = ['primary', 'success', 'danger', 'warning', 'info'][Math.floor(Math.random() * 5)];
                                return `<span class="badge badge-light-${randomColor}">${data}</span>`;
                            }
                        },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row) {
                                return `
                                <div class="dropdown">
                                    <button class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm dropdown-toggle" type="button" id="actionMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                        @lang('common.actions')
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="actionMenu">
                                    <li><a class="dropdown-item" href="/menu-management/categories/${row.id}/edit">@lang('common.edit')</a></li>
                                     <li>
                                        <form action="/menu-management/categories/${row.id}" method="POST" style="display:inline;">
                                            @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item" onclick="return confirm('@lang('common.confirm_delete')')">@lang('common.delete')</button>
                                        </form>
                                        </li>
                                    </ul>
                                </div>
                            `;
                            }
                        },]
                });

                $('#parent_id_filter').select2({
                    ajax: {
                        url: '{{ route('menu-management.categories.data') }}',
                        dataType: 'json',
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        id: item.id,
                                        text: item.name
                                    };
                                })
                            };
                        }
                    }
                });

                $('#filter_button').on('click', function () {
                    $('#categories-table').DataTable().draw();
                });

                $('#reset_button').on('click', function () {
                    $('#parent_id').val('').trigger('change');
                    $('#categories-table').DataTable().draw();
                });
            });
        </script>
    @endpush
</x-default-layout>
