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
            <h1 class="mt-5">Ürün Düzenle</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('menu-management.products.update', $product->id) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="name">Ürün Adı</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{ old('name', $product->name) }}" required>
                </div>
                <div class="form-group
                    mb-3">
                    <label for="description">Açıklama</label>
                    <textarea class="form-control" id="description" name="description"
                              rows="3">{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="form-group
                    mb-3">
                    <label for="category_id">Kategori</label>
                    <select id="category_id" name="category_id" class="form-control" data-control="select2"
                            data-placeholder="Kategori Seçin">
                        <option></option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group
                    mb-3">
                    <label for="price">Fiyat</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="price" name="price"
                               value="{{ old('price', $product->price) }}" required>
                        <div class="input-group-append">
                            <span class="input-group-text rounded-start-0">₺</span>
                        </div>
                    </div>
                </div>
                <div class="form-group
                    mb-3">
                    <label for="image_path">Ürün Resmi</label>
                    <input type="file" class="form-control" id="image_path" name="image_path">
                    @if($product->image_path)
                        <img src="{{ $product->image_path }}" alt="Ürün Resmi" class="img-thumbnail mt-2"
                             width="150">
                    @endif

                </div>
                <button type="submit" class="btn btn-primary">Güncelle</button>
            </form>
        </div>
    </div>
</x-default-layout>
