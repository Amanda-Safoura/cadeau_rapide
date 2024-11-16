@extends('backoffice.layouts.main')
@section('title')
    Messages Utilisateur
@endsection


@section('content')
    <div class="container mt-4">
        <div class="table-responsive">
            <table class="display table table-striped table-bordered bg-white" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Objet</th>
                        <th>Date d'envoi</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->subject ?? 'N/A' }}</td>
                            <td>{{ date_format($item->created_at, 'd F Y, H:i') }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button class="more-btn btn btn-sm btn-info me-2" title="Voir plus" data-bs-toggle="modal"
                                        data-bs-target="#user_messageModal_{{ $item->id }}">
                                        <i class="far fa-file-alt"></i>
                                    </button>
                                    @if ($item->read)
                                        <button class="read-btn btn btn-sm btn-warning" title="Marquer comme non lu"
                                            data-id="{{ $item->id }}">
                                            <i class="far fa-eye-slash"></i>
                                        </button>
                                    @else
                                        <button class="read-btn btn btn-sm btn-warning" title="Marquer comme lu"
                                            data-id="{{ $item->id }}">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <!-- Modale -->
                        <div class="modal fade" id="user_messageModal_{{ $item->id }}" tabindex="-1"
                            aria-labelledby="user_messageModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="user_messageModalLabel">Objet: {{ $item->subject }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Fermer"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{ $item->message }} </p>
                                        <small class="text-muted">Envoyé par : {{ $item->name }}
                                            ({{ $item->email }})</small>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('additionnal_js')
    <script>
        $(document).ready(function() {
            $('.read-btn').on('click', function() {
                let $button = $(this); // Référence au bouton cliqué
                let itemId = $button.data(
                    'id'); // ID de l'élément (doit être défini en attribut data-id dans le bouton)
                let isRead = $button.hasClass('read'); // Vérifier l'état actuel

                // Envoi de la requête AJAX
                $.ajax({
                    url: "{{ route('dashboard.user_messages.change-read-status') }}", // Remplacez par le chemin de votre route
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token pour sécuriser la requête
                        id: itemId,
                        read: !isRead // Nouveau statut de lecture (inverse de l'actuel)
                    },
                    success: function(response) {
                        // Mise à jour de l'interface utilisateur en fonction du nouveau statut
                        if (!isRead) {
                            $button.addClass('read').attr('title', 'Marquer comme non lu')
                                .html('<i class="far fa-eye-slash"></i>');
                        } else {
                            $button.removeClass('read').attr('title', 'Marquer comme lu')
                                .html('<i class="far fa-eye"></i>');
                        }
                    },
                    error: function(xhr, status, error) {}
                });
            });
        });
    </script>
@endsection
