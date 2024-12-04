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
            <h1 class="mt-5">Kategori Düzenle</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('menu-management.categories.update', $category->id) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="name">Kategori Adı</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{ old('name', $category->name) }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="description">Açıklama</label>
                    <textarea class="form-control" id="description" name="description"
                              rows="3">{{ old('description', $category->description) }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="parent_id">Üst Kategori</label>
                    <select id="parent_id" name="parent_id" class="form-control" data-control="select2"
                            data-placeholder="Üst Kategori Seçin">
                        <option></option>
                        @foreach($categories as $parentCategory)
                            <option
                                value="{{ $parentCategory->id }}" {{ $category->parent_id == $parentCategory->id ? 'selected' : '' }}>{{ $parentCategory->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="image_path">Kategori Resmi</label>
                    <input type="file" class="form-control" id="image_path" name="image_path">
                    @if($category->image_path)
                        <img src="{{ $category->image_path }}" alt="Kategori Resmi" class="img-thumbnail mt-2"
                             width="150">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Güncelle</button>
            </form>
        </div>
    </div>
</x-default-layout>
