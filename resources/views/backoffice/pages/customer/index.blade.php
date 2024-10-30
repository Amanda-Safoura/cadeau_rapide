@extends('backoffice.layouts.main')
@section('title')
    Clients
@endsection

@section('additionnal_css')
    <!-- Bootstrap DataTable -->
    <link rel="stylesheet" href="{{ asset('assets/backoffice/css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
    <div class="container mt-4">
        <div class="table-responsive">
            <table id="editableTable" class="display table table-striped table-bordered bg-white" cellspacing="0"
                style="width:100%">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Nombre d'achat</th>
                        <th>Total Commandes (XOF)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->giftCards->count() }}</td>
                            @php
                                $total = 0;
                                foreach ($customer->giftCards as $giftCard) {
                                    $total += (int) $giftCard->total_amount;
                                }
                            @endphp
                            <td>{{ $total }}</td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('dashboard.customer.show', ['id' => $customer->id]) }}"
                                        title="Voir plus">
                                        <i class="far fa-file-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('additionnal_js')
    <!-- DataTable -->
    <script src="{{ asset('assets/backoffice/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/backoffice/js/plugin/datatables/dataTables.bootstrap5.min.js') }}"></script>

    <script>
        let table = $('#editableTable').DataTable()
    </script>
@endsection
