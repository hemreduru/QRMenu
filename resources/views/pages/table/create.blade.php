<x-default-layout>

    @section('title')
        Dashboard
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <x-slot name="header">
        <h1 class="page-title">Table</h1>
    </x-slot>
    <form action="{{ route('tables.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tablo Adı</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Oluştur</button>
    </form>
</x-default-layout>
