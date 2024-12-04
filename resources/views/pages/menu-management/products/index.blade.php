<x-default-layout>

    @section('title')
        @lang('common.products')
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('menu-management.products.index') }}
    @endsection
    <x-slot name="header">
        <h1 class="page-title">@yield('title')</h1>
    </x-slot>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">@lang('common.products')</h3>
        </div>
        <div class="card-body">
            <table id="products-table" class="table table-row-bordered gy-5">
                <thead>
                <tr>
                    <th>@lang('common.name')</span></th>
                    <th>@lang('common.price')</th>
                    <th>@lang('common.category')</th>
                    <th>@lang('common.parent_category')</th>
                    <th>@lang('common.image')</th>
                    <th>@lang('common.created_at')</th>
                    <th>@lang('common.updated_at')</th>
                    <th>@lang('common.actions')</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#products-table').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    language: {
                        url: languageUrl
                    },
                    ajax: {
                        url: '{{ route('menu-management.products.data') }}',
                    },
                    columns: [
                        {data: 'name', name: 'name'},
                        {
                            data: 'price', name: 'price', render: function (data) {
                                return data + ' ₺';
                            }
                        },
                        {data: 'category_name', name: 'category_name'},
                        {data: 'parent_category_name', name: 'parent_category_name'},
                        {
                            data: 'image_path', name: 'image_path', render: function (data) {
                                return `<img src="${data}" alt="image" class="img-fluid" style="max-width: 100px;">`;
                            }
                        },
                        {
                            data: 'created_at', name: 'created_at', render: function (data) {
                                return moment(data).format('DD.MM.YYYY - HH.mm');
                            }
                        },
                        {
                            data: 'updated_at', name: 'updated_at', render: function (data) {
                                return moment(data).format('DD.MM.YYYY - HH.mm');
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
                                        <li><a class="dropdown-item" href="/menu-management/products/${row.id}/edit">@lang('common.edit')</a></li>
                                        <li>
                                            <form action="/menu-management/products/${row.id}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" onclick="return confirm('@lang('common.confirm_delete')')">@lang('common.delete')</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            `;
                            }
                        },
                    ]
                });
            });
        </script>
    @endpush
</x-default-layout>
