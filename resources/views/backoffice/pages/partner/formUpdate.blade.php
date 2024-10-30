<div class="offcanvas offcanvas-end" tabindex="-1" id="editPartner" aria-labelledby="editPartnerLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="editPartnerLabel">Formulaire de Modification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <form id="editPartnerForm" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-3 custom-form-input">
                <label for="nameEdit" class="form-label">Nom Partenaire <span class="text-danger">*</span></label>
                <input type="text" id="nameEdit" class="form-control" name="name" placeholder="Entrez son nom">
                <div class="alert alert-danger" error-input="name"></div>
            </div>

            <!-- Conteneur pour l'image de l'aperçu de la vidéo -->
            <div id="pictureContainer" class="mb-3">
                <label class="form-label me-5">Photo :</label>
                <p class="form-text text-muted text-info">Cette image ne vous convient pas ? Vous pouvez
                    la changer dans la section qui suit.</p>

                <div class="d-flex justify-content-center">
                    <img id="picture_1" src="" alt="Photo Partenaire" class="img-fluid"
                        style="max-height: 150px;">
                </div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="picture_1Edit" class="form-label">Photo/Logo Partenaire <span
                        class="text-danger">*</span></label>
                <input id="picture_1Edit" name="picture_1" type="file" class="file" data-show-preview="false"
                    data-msg-placeholder="Sélectionner l'image...">

                <div class="alert alert-danger" error-input="picture_1"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="picture_2Edit" class="form-label">Photo Service/Offre 1</label>
                <input id="picture_2Edit" name="picture_2" type="file" class="file" data-show-preview="false"
                    data-msg-placeholder="Sélectionner l'image...">

                <div class="alert alert-danger" error-input="picture_2"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="picture_3Edit" class="form-label">Photo Service/Offre 2</label>
                <input id="picture_3Edit" name="picture_3" type="file" class="file" data-show-preview="false"
                    data-msg-placeholder="Sélectionner l'image...">

                <div class="alert alert-danger" error-input="picture_3"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="picture_4Edit" class="form-label">Photo Service/Offre 3</label>
                <input id="picture_4Edit" name="picture_4" type="file" class="file" data-show-preview="false"
                    data-msg-placeholder="Sélectionner l'image...">

                <div class="alert alert-danger" error-input="picture_4"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="category_idEdit">Catégorie Partenaire <span class="text-danger">*</span></label>
                <select class="form-select" id="category_idEdit" name="category_id">
                    <option selected value="">Sélectionnez la categorie du partenaire</option>
                    @foreach ($partner_categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="alert alert-danger" error-input="category_id"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="min_amountEdit" class="form-label">Valeur Minimale Coupon <span
                        class="text-danger">*</span></label>

                <input type="number" class="form-control" name="min_amount" id="min_amountEdit"
                    aria-describedby="min_amountHelp" placeholder="Entrez ici le prix" min="0" step="1" />

                <small id="min_amountHelp" class="form-text text-muted">Cette valeur représente le prix minimal d'un
                    chèque
                    cadeau pour ce partenaire.</small>

                <div class="alert alert-danger" error-input="min_amount"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="commission_percentEdit" class="form-label">Valeur commission (%)<span
                        class="text-danger">*</span></label>

                <input type="number" class="form-control" name="commission_percent" id="commission_percentEdit"
                    aria-describedby="commission_percentHelp" placeholder="Entrez ici le prix" min="0"
                    step="1" />

                <small id="commission_percentHelp" class="form-text text-muted">Cette valeur représente le pourcentage
                    prélévé par Cadeau Rapide à ce partenaire.</small>

                <div class="alert alert-danger" error-input="commission_percent"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="phone_numberEdit" class="form-label">Tel <span class="text-danger">*</span></label>
                <input type="text" id="phone_numberEdit" class="form-control" name="phone_number"
                    placeholder="Entrez son numéro de téléphone">
                <div class="alert alert-danger" error-input="phone_number"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="emailEdit" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="text" id="emailEdit" class="form-control" name="email"
                    placeholder="Entrez son adresse mail">
                <div class="alert alert-danger" error-input="email"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="adressEdit" class="form-label">Adresse physique</label>
                <input type="text" id="adressEdit" class="form-control" name="adress"
                    placeholder="Entrez son adresse">
                <div class="alert alert-danger" error-input="adress"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="short_descriptionEdit" class="form-label">Phrase de présentation</label>
                <input type="text" id="short_descriptionEdit" class="form-control" name="short_description"
                    placeholder="Entrez une courte phrase caractérisant l'identité de l'entreprise">
                <div class="alert alert-danger" error-input="short_description"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="descriptionEdit" class="form-label">Texte descriptif <span
                        class="text-danger">*</span></label>
                <textarea class="form-control" name="description" id="descriptionEdit" rows="4"></textarea>
                <div class="alert alert-danger" error-input="description"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="offersEdit" class="form-label">Offres/Services <span class="text-danger">*</span></label>
                <textarea class="form-control" name="offers" id="offersEdit" rows="4"></textarea>
                <div class="alert alert-danger" error-input="offers"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="tagsEdit" class="form-label">Tags <span class="text-muted">(utiliser des virgules `,` pour séparer les tags)</span></label>
                <input type="text" id="tagsEdit" class="form-control" name="tags"
                    placeholder="Ex: beauté, sport, santé ...">
                <div class="alert alert-danger" error-input="tags"></div>
            </div>

            <div class="alert alert-danger" error-input="general"></div>

            <button type="submit" class="w-100 btn btn-primary btn-rounded mt-3">Modifier</button>
        </form>
    </div>
</div>
