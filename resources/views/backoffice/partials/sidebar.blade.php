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
                    <i class="fas fa-chart-pie align-middle"></i> <span class="align-middle">Vue d’ensemble</span>
                </a>
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.logs'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.logs') }}">
                    <i class="fas fa-history align-middle"></i> <span class="align-middle">Activités récentes</span>
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
                    <i class="fas fa-cog align-middle"></i> <span class="align-middle">Paramètres des chèques
                        cadeau</span>
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
                Rapports et Statitiques
            </li>
            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.stats.sales'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.stats.sales') }}">
                    <i class="fas fa-chart-line"></i> <span class="align-middle">Statistiques des Ventes</span>
                </a>
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.stats.sales_by_category'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.stats.sales_by_category') }}">
                    <i class="fas fa-tags"></i> <span class="align-middle">Analyse par Catégorie</span>
                </a>
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.stats.reports_customizations'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.stats.reports_customizations') }}">
                    <i class="fas fa-cogs"></i> <span class="align-middle">Rapport des Personnalisations</span>
                </a>
            </li>



            <li class="sidebar-header">
                Finances
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.cash_entries'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.cash_entries') }}">
                    <i class="fas fa-wallet"></i> <span class="align-middle">Revenus</span>
                </a>
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs(
                    'dashboard.finance.card_payment_to_validate'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.finance.card_payment_to_validate') }}">
                    <i class="far fa-credit-card"></i> <span class="align-middle">Valider les paiements par Carte
                        Bancaire</span>
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
                Paramètres du Site
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.admin_accounts.index'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.admin_accounts.index') }}">
                    <i class="fas fa-users-cog"></i> <span class="align-middle">Gestion des comptes Admins</span>
                </a>
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.email_templates.index'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.email_templates.index') }}">
                    <i class="fas fa-cog"></i> <span class="align-middle">Personnalisation des Notifications</span>
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

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('dashboard.partner_message.index'),
            ])>
                <a class="sidebar-link" href="{{ route('dashboard.partner_message.index') }}">
                    <i class="fas fa-phone align-middle"></i> <span class="align-middle">Contact Partenaires</span>
                </a>
            </li>


            <li class="sidebar-header">
                Autres
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
