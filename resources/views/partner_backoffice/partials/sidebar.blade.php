<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('partner.panel.global_stats') }}">
            <span class="align-middle">Cadeau Rapide</span>
        </a>

        <ul class="sidebar-nav">

            <li class="sidebar-header">
                Tableau de Bord
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('partner.panel.global_stats'),
            ])>
                <a class="sidebar-link" href="{{ route('partner.panel.global_stats') }}">
                    <i class="fas fa-chart-bar align-middle"></i> <span class="align-middle">Vue d’ensemble</span>
                </a>
            </li>
            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('partner.panel.sales_stats'),
            ])>
                <a class="sidebar-link" href="{{ route('partner.panel.sales_stats') }}">
                    <i class="fas fa-chart-line"></i> <span class="align-middle">Statistiques des Ventes</span>
                </a>
            </li>

            <li class="sidebar-header">
                Chèques cadeau
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('partner.panel.gift_card'),
            ])>
                <a class="sidebar-link" href="{{ route('partner.panel.gift_card') }}">
                    <i class="fas fa-gift align-middle"></i> <span class="align-middle">Liste des chèques cadeau</span>
                </a>
            </li>


            <li class="sidebar-header">
                Finances
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('partner.panel.cash_entries'),
            ])>
                <a class="sidebar-link" href="{{ route('partner.panel.cash_entries') }}">
                    <i class="fas fa-wallet"></i> <span class="align-middle">Revenus générés</span>
                </a>
            </li>

            <li @class(['sidebar-item', 'active' => request()->routeIs('')])>
                <a class="sidebar-link" href="{{-- {{ route('') }} --}}#">
                    <i class="fas fa-table align-middle"></i> <span class="align-middle">Rapports financiers</span>
                </a>
            </li>


            <li class="sidebar-header">
                Profil
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('partner.panel.profile'),
            ])>
                <a class="sidebar-link" href="{{ route('partner.panel.profile') }}">
                    <i class="fas fa-pen align-middle"></i> <span class="align-middle">Editer ma page de
                        présentation</span>
                </a>
            </li>


            <li class="sidebar-header">
                Support
            </li>

            <li @class([
                'sidebar-item',
                'active' => request()->routeIs('partner.panel.message.index'),
            ])>
                <a class="sidebar-link" href="{{ route('partner.panel.message.index') }}">
                    <i class="fas fa-phone align-middle"></i> <span class="align-middle">Contact Cadeau Rapide</span>
                </a>
            </li>

            <li @class(['sidebar-item', 'active' => request()->routeIs('')])>
                <a class="sidebar-link" href="{{-- {{ route('') }} --}}#">
                    <i class="fas fa-question-circle align-middle"></i> <span class="align-middle">FAQ et
                        Documentation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
