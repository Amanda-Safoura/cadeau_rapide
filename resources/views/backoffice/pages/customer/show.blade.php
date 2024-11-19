@extends('backoffice.layouts.main')
@section('title')
    Commandes client
@endsection

@section('additionnal_css')
    <!-- Bootstrap DataTable -->
    <link rel="stylesheet" href="{{ asset('assets/backoffice/css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('content')
    <div class="container my-4">
        <h2 class="text-center mb-4">Liste des chèques cadeaux commandées</h2>

        <div class="table-responsive">
            <table id="editableTable" class="display table table-striped table-bordered bg-white" cellspacing="0"
                style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client</th>
                        <th>Bénéficiaire</th>
                        <th>Partenaire</th>
                        <th>Montant (XOF)</th>
                        <th>Somme totale payé (XOF)</th>
                        <th>Customisé</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $gift_card)
                        <tr>
                            <td>{{ $gift_card->id }}</td>
                            <td>{{ $gift_card->client_name }}</td>
                            <td>
                                @if ($gift_card->is_client_beneficiary)
                                    Le client lui-même
                                @else
                                    {{ $gift_card->beneficiary_name }}
                                @endif
                            </td>
                            <td>{{ $gift_card->partner->name }} </td>
                            <td>{{ $gift_card->amount }}</td>
                            <td>{{ $gift_card->total_amount }}</td>
                            <td class=" text-center">
                                @if ($gift_card->is_customized)
                                    <span class="bg-success text-white p-1"><i class="fas fa-check"></i></span>
                                @else
                                    <span class="bg-danger text-white px-2 py-1"><i class="fas fa-times"></i></span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('dashboard.gift_card.show', ['id' => $gift_card->id]) }}"
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
