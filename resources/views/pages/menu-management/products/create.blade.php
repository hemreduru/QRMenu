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
            <h3 class="card-title">@lang('common.products_create')</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('menu-management.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label required">@lang('common.product_name')</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label required">@lang('common.price')</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">@lang('common.description')</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">@lang('common.image')</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label required">@lang('common.category')</label>
                    <select class="form-select" data-control="select2" id="category_id" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">@lang('common.create')</button>
            </form>
        </div>
    </div>
</x-default-layout>
