<form method="POST" action="{{ route('dashboard.partner_categories.store') }}" id="addPartnerCategoryForm">
    @csrf
    <div class="mb-3 custom-form-input">
        <label for="nameCreate" class="form-label">Nom</label>
        <input type="text" id="nameCreate" class="form-control" name="name" placeholder="Entrez son titre">
        <div class="alert alert-danger d-none" error-input="name"></div>
    </div>

    <button type="submit" class="w-100 btn btn-primary btn-rounded mt-3">Créer</button>
</form>
