<div class="offcanvas offcanvas-end" tabindex="-1" id="editShipping" aria-labelledby="editShippingLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="editShippingLabel">Formulaire de Modification</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <form id="editShippingForm">
            @csrf
            @method('PATCH')

            <div class="mb-3 custom-form-input">
                <label for="zoneEdit" class="form-label">Zone applicable <span
                        class="text-danger">*</span></label>
                <input type="text" id="zoneEdit" class="form-control" name="zone"
                    placeholder="Ex: Cotonou Akpakpa, Cotonou...">
                <div class="alert alert-danger" error-input="zone"></div>
            </div>

            <div class="mb-3 custom-form-input">
                <label for="priceEdit" class="form-label">Prix de la livraison <span
                        class="text-danger">*</span></label>
                <input type="number" id="priceEdit" class="form-control" name="price" placeholder="1000">
                <div class="alert alert-danger" error-input="price"></div>
            </div>


            <div class="alert alert-danger" error-input="general"></div>
            <button type="submit" class="w-100 btn btn-primary btn-rounded mt-3">Modifier</button>
        </form>
    </div>
</div>
