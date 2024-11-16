@extends('partner_backoffice.layouts.main')
@section('title')
    Contactez les Admins
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">Historique des Messages</h2>
        <div class="list-group">
            @foreach ($datas as $item)
                <div class="list-group-item list-group-item-action mb-2">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">
                            <i class="fa fa-tag me-2"></i>{{ $item->subject }}
                        </h5>
                        <small class="text-muted">
                            <i class="fa fa-calendar-alt me-1"></i>{{ $item->created_at->format('d F Y, H:i') }}
                        </small>
                    </div>
                    <p class="mb-1 text-muted">
                        <i class="fa fa-envelope me-2"></i>{{ substr($item->message, 0, 120) }}
                    </p>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#partner_messageModal_{{ $item->id }}">
                            <i class="fa fa-eye me-2"></i>Voir le message
                            </a>
                    </div>
                </div>

                <!-- Modale -->
                <div class="modal fade" id="partner_messageModal_{{ $item->id }}" tabindex="-1"
                    aria-labelledby="partner_messageModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="partner_messageModalLabel">Objet: {{ $item->subject }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <p>{{ $item->message }} </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Contactez les administrateurs</h2>
                <form method="POST" action="{{ route('partner.panel.message.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="subject" class="form-label">
                            <i class="fa fa-tag me-2"></i>Objet
                        </label>
                        <input type="text" class="form-control" id="subject" name="subject"
                            placeholder="Objet de votre message*" required>
                        @error('subject')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">
                            <i class="bx bx-message-detail me-2"></i>Message
                        </label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Votre message*" required></textarea>
                        @error('message')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-paper-plane me-2"></i>Envoyer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Le conteneur de l'alerte modale -->
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertModalLabel">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    {{ session('message') }}
                </div>
            </div>
        </div>
    </div>
@endsection


@section('additionnal_js')
    <script>
        @if (session('message'))
            $(document).ready(function() {
                $('#alertModal').modal('show')
            });
        @endif
    </script>
@endsection
