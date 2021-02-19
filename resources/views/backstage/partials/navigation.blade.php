<nav>

    <p class="nav-header">Navigation</p>

    <a href="{{ route('backstage.dashboard.index') }}" class="@if( request()->segment(2) === 'dashboard' || !request()->segment(2)) active @endif mb-2 group flex items-center text-sm leading-5 font-medium text-gray-900 hover:text-gray-900 hover:no-underline focus:outline-none transition ease-in-out duration-150">
        <span class="icon-holder"><i class="far fa-home navigation-icon"></i></span>
        <span class="text">Dashboard</span>
    </a>

    <a href="{{ route('backstage.campaigns.index') }}" class="@if( request()->segment(2) === 'campaigns' && (!isset($activeCampaign) || request()->segment(3) != $activeCampaign->id)) ) active @endif mb-2 group flex items-center text-sm leading-5 font-medium text-gray-900 hover:text-gray-900 hover:no-underline focus:outline-none transition ease-in-out duration-150">
        <span class="icon-holder"><i class="far fa-bullhorn navigation-icon"></i></span>
        <span class="text">Campaigns</span>
    </a>

    <a href="{{ route('backstage.games.index') }}" class="@if( request()->segment(2) === 'games' ) active @endif mb-2 group flex items-center text-sm leading-5 font-medium text-gray-900 hover:text-gray-900 hover:no-underline focus:outline-none transition ease-in-out duration-150">
        <span class="icon-holder"><i class="far fa-play-circle navigation-icon"></i></span>
        <span class="text">Games</span>
    </a>

    @if( $activeCampaign )



        <a href="{{ route('backstage.prizes.index') }}" class="@if( request()->segment(2) === 'prizes' ) active @endif mb-2 group flex items-center text-sm leading-5 font-medium text-gray-900 hover:text-gray-900 hover:no-underline focus:outline-none transition ease-in-out duration-150">
            <span class="icon-holder"><i class="far fa-trophy-alt navigation-icon"></i></span>
            <span class="text">Prizes</span>
        </a>




        <a href="{{ route( auth()->user()->isAdmin() ? 'backstage.campaigns.edit' : 'backstage.campaigns.show', $activeCampaign->id) }}" class="@if( request()->segment(2) === 'campaigns' && request()->segment(3) == $activeCampaign->id) active @endif mb-2 group flex items-center text-sm leading-5 font-medium text-gray-900 hover:text-gray-900 hover:no-underline focus:outline-none transition ease-in-out duration-150">
            <span class="icon-holder"><i class="far fa-sliders-v navigation-icon"></i></span>
            <span class="text">Settings</span>
        </a>
    @endif

    @if( auth()->user()->isAdmin())
    <a href="{{ route('backstage.users.index') }}" class="@if( request()->segment(2) === 'users' ) active @endif mb-2 group flex items-center text-sm leading-5 font-medium text-gray-900 hover:text-gray-900 hover:no-underline focus:outline-none transition ease-in-out duration-150">
        <span class="icon-holder"><i class="far fa-user-friends navigation-icon"></i></span>
        <span class="text">Users</span>
    </a>
    @endif

</nav>
