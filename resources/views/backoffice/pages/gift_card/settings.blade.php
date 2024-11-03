@extends('backoffice.layouts.main')
@section('title')
    Paramètres Chèques Cadeau
@endsection

@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4">Paramètres des chèques cadeau</h2>

        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Prix de la personnalisation :</strong>
                    @if ($settings)
                        {{ $settings->customization_fee }}
                    @else
                        0
                    @endif XOF
                </p>
                <p><strong>Durée de validité :</strong>
                    @if ($settings)
                        {{ $settings->validity_duration }}
                    @else
                        1
                    @endif mois
                </p>
            </div>
        </div>

        <div class="text-center mt-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateGiftCardSettings">Modifier ces
                valeurs</button>
        </div>

        <!-- Modale -->
        <div class="modal fade" id="updateGiftCardSettings" tabindex="-1" aria-labelledby="updateGiftCardSettingsLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateGiftCardSettingsLabel">Modification des paramètres</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <form action="{{ route('dashboard.gift_card.update_settings') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="customization_fee" class="form-label">Prix de personnalisation<span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="customization_fee" id="customization_fee"
                                    placeholder="Entrez ici le prix" min="0"
                                    @if ($settings) value="{{ $settings->customization_fee }}" @else value="0" @endif
                                    step="1" />
                            </div>

                            <div class="mb-3">
                                <label for="validity_duration" class="form-label">Durée de validité (en mois)<span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="validity_duration" id="validity_duration"
                                    placeholder="Entrez ici le nombre de mois" min="0"
                                    @if ($settings) value="{{ $settings->validity_duration }}" @else value="1" @endif
                                    step="1" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Modifier</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                        <form>
                </div>
            </div>
        </div>
    </div>
@endsection
