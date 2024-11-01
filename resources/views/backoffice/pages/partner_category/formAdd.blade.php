<form method="POST" action="{{ route('dashboard.partner_categories.store') }}" id="addPartnerCategoryForm">
    @csrf
    <div class="mb-3 custom-form-input">
        <label for="nameCreate" class="form-label">Nom <span class="text-danger">*</span></label>
        <input type="text" id="nameCreate" class="form-control" name="name" placeholder="Entrez son titre">
        <div class="alert alert-danger d-none" error-input="name"></div>
    </div>

    <div class="mb-3 custom-form-input">
        <label for="iconCreate" class="form-label">Icône <span class="text-danger">*</span></label>
        <input type="text" id="iconCreate" class="form-control" name="icon"
            placeholder="Entrez l'icône de cette catégorie">
        <p class="form-text text-muted">Vous disposez des icones de Boxicons et FontAwesome. Entrez quelque chose comme
            ceci : fa fa-user dans le champ.</p>

        <div class="alert alert-danger d-none" error-input="icon"></div>
    </div>

    <div class="mb-3 custom-form-input">
        <label for="short_descriptionCreate" class="form-label">Description Courte</label>
        <textarea class="form-control" name="short_description" id="short_descriptionCreate" rows="3"></textarea>
        <div class="alert alert-danger d-none" error-input="name"></div>
    </div>

    <button type="submit" class="w-100 btn btn-primary btn-rounded mt-3">Créer</button>
</form>
