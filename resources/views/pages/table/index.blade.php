<x-default-layout>

    @section('title')
        Table
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <x-slot name="header">
        <h1 class="page-title">Table</h1>
    </x-slot>
    <div class="row">
        @foreach($tables as $tableData)
            <div class="col-md-3 mb-4">
                <!-- Masa Kartı -->
                <div class="card card-hover
                    @if(count($tableData['grouped_orders']) > 0)
                        bg-danger
                    @else
                        bg-success
                    @endif"
                     data-bs-toggle="modal"
                     data-bs-target="#kt_modal_{{ $tableData['table']->id }}">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h5 class="card-title text-white">{{ $tableData['table']->name }}</h5>
                        <p class="text-white"><strong>Toplam Tutar: </strong>{{ $tableData['total_amount'] }} TL</p>
                    </div>
                </div>
            </div>

            <!-- Metronic Modal -->
            <div class="modal fade" id="kt_modal_{{ $tableData['table']->id }}" tabindex="-1"
                 aria-labelledby="kt_modal_label_{{ $tableData['table']->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="fw-bold">{{ $tableData['table']->name }} Sipariş Detayları</h2>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                 aria-label="Close">
                                <i class="bi bi-x fs-2"></i>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-row-bordered table-striped table-hover align-middle">
                                    <thead class="text-gray-600 fw-bold">
                                    <tr>
                                        <th>Ürün</th>
                                        <th>Adet</th>
                                        <th>Birim Fiyat</th>
                                        <th>Toplam</th>
                                        <th>İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tableData['grouped_orders'] as $order)
                                        <tr>
                                            <td>{{ $order['product']->name }}</td>
                                            <td>{{ $order['quantity'] }}</td>
                                            <td>{{ $order['product']->price }} TL</td>
                                            <td>{{ $order['total'] }} TL</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <form method="POST" action="{{ route('order.update', $order['product']->id) }}" class="me-2">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="input-group input-group-sm">
                                                            <input type="number" name="quantity" value="{{ $order['quantity'] }}" class="form-control me-2" style="width: 80px;" />
                                                            <button type="submit" class="btn btn-primary">Güncelle</button>
                                                        </div>
                                                    </form>
                                                    <form method="POST" action="{{ route('order.destroy', $order['product']->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Kaldır</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <h5 class="fw-bold me-auto">Toplam Tutar: {{ $tableData['total_amount'] }} TL</h5>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Kapat</button>
                            <form method="POST" action="{{ route('table.clear', $tableData['table']->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hesabı Kapat</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</x-default-layout>
