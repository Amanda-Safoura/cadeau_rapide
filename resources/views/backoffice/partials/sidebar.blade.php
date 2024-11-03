<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('dashboard.global_stats') }}">
            <span class="align-middle">Cadeau Rapide</span>
        </a>

        <ul class="sidebar-nav">

            <li class="sidebar-header">
                Tableau de Bord
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.global_stats'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.global_stats') }}">
                    <i class="fas fa-chart-bar align-middle"></i> <span class="align-middle">Vue d’ensemble</span>
                </a>
            </li>

            <li @class(['sidebar-item', 'active' => request()->routeIs('')])>
                <a class="sidebar-link" href="{{-- {{ route('') }} --}}#">
                    <i class="fas fa-chart-bar align-middle"></i> <span class="align-middle">Activités récentes</span>
                </a>
            </li>


            <li class="sidebar-header">
                Partenaires
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.partners.index'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.partners.index') }}">
                    <i class="fas fa-users align-middle"></i> <span class="align-middle">Liste des Partenaires</span>
                </a>
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.partners.create'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.partners.create') }}">
                    <i class="fas fa-user-plus align-middle"></i> <span class="align-middle">Ajouter un
                        Partenaire</span>
                </a>
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.partner_categories.index'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.partner_categories.index') }}">
                    <i class="fas fa-user-plus align-middle"></i> <span class="align-middle">
                        Catégories de Partenaire</span>
                </a>
            </li>

            <li class="sidebar-header">
                Chèques cadeau
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.gift_card.index'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.gift_card.index') }}">
                    <i class="fas fa-gift align-middle"></i> <span class="align-middle">Liste des chèques cadeau</span>
                </a>
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.gift_card.settings'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.gift_card.settings') }}">
                    <i class="fas fa-cog align-middle"></i> <span class="align-middle">Paramètres des chèques cadeau</span>
                </a>
            </li>


            <li class="sidebar-header">
                Clients
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.customer.index'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.customer.index') }}">
                    <i class="fas fa-user align-middle"></i> <span class="align-middle">Liste des clients</span>
                </a>
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.user_message.index'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.user_message.index') }}">
                    <i class="fas fa-headset align-middle"></i> <span class="align-middle">Support client</span>
                </a>
            </li>


            <li class="sidebar-header">
                Support & Réclamations
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.reclamation.index'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.reclamation.index') }}">
                    <i class="fas fa-exclamation-triangle align-middle"></i> <span class="align-middle">Gestion des
                        réclamations</span>
                </a>
            </li>

            <li @class(['sidebar-item', 'active' => request()->routeIs('')])>
                <a class="sidebar-link" href="{{-- {{ route('') }} --}}#">
                    <i class="fas fa-phone align-middle"></i> <span class="align-middle">Contact Partenaires</span>
                </a>
            </li>


            <li class="sidebar-header">
                Livraisons
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.shipping.to_deliver'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.shipping.to_deliver') }}">
                    <i class="fas fa-truck"></i> <span class="align-middle">Chèques cadeaux à
                        livrer</span>
                </a>
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.shippings.index'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.shippings.index') }}">
                    <i class="fas fa-map-marker-alt align-middle"></i> <span class="align-middle">Liste des options de
                        livraison</span>
                </a>
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.shippings.create'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.shippings.create') }}">
                    <i class="fas fa-plus-circle align-middle"></i> <span class="align-middle">Créer une option de
                        livraison</span>
                </a>
            </li>


            <li class="sidebar-header">
                Paramètres
            </li>

            <li @class(['sidebar-item', 'active' => request()->routeIs('')])>
                <a class="sidebar-link" href="{{-- {{ route('') }} --}}#">
                    <i class="fas fa-cog align-middle"></i> <span class="align-middle">Paramètres généraux</span>
                </a>
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.all_icon'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.all_icon') }}">
                    <span class="align-middle">Icones disponibles</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
