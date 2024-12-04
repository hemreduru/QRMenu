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
            <h3 class="card-title">@lang('common.categories_create')</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('menu-management.categories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label required">@lang('common.category_name')</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">@lang('common.description')</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="image_path" class="form-label required">@lang('common.image')</label>
                    <input type="file" class="form-control" id="image_path" name="image_path">
                </div>
                <div class="mb-3">
                    <label for="parent_id" class="form-label">@lang('common.parent_category')</label>
                    <select class="form-select" data-control="select2" data-placeholder="@lang('common.select_parent_category')" id="parent_id" name="parent_id">
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
