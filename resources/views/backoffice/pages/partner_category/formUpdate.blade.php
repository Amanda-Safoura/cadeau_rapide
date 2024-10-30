<div class="offcanvas offcanvas-end" tabindex="-1" id="editPartnerCategory" aria-labelledby="editPartnerCategoryLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="editPartnerCategoryLabel">Formulaire de Modification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <form method="POST" id="editPartnerCategoryForm">
            @method('PATCH')
            @csrf
            <div class="mb-3 custom-form-input">
                <label for="nameEdit" class="form-label">Nom <span class="text-danger">*</span></label>
                <input type="text" id="nameEdit" class="form-control" name="name" placeholder="Entrez son titre">
                <div class="alert alert-danger" error-input="name"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="short_descriptionEdit" class="form-label">Description Courte</label>
                <textarea class="form-control" name="short_description" id="short_descriptionEdit" rows="3"></textarea>
                <div class="alert alert-danger d-none" error-input="name"></div>
            </div>

            <button type="submit" class="w-100 btn btn-primary btn-rounded mt-3">Créer</button>
        </form>

    </div>

</div>
