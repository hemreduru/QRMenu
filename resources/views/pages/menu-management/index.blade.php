<x-default-layout>

    @section('title')
        Dashboard
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <x-slot name="header">
        <h1 class="page-title">Dashboard</h1>
    </x-slot>

</x-default-layout>
