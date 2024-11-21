<!-- Le conteneur de l'alerte modale -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">Notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                {!! session('message') !!}
            </div>
        </div>
    </div>
</div>


<!-- Le conteneur de l'alerte modale -->
<div class="modal fade" id="paymentNotifModal" tabindex="-1" aria-labelledby="paymentNotifModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentNotifModalLabel">Notification de Paiement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" id="paymentNotifMessage"></div>
        </div>
    </div>
</div>
