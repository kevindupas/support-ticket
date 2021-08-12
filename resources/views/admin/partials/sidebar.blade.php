<div class="sidenav custom-sidenav" id="sidenav-main">
    <div class="sidenav-header d-flex align-items-center">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{asset(Storage::url('logo/logo.png'))}}" class="sidebar-logo" alt="{{ env('APP_NAME') }}">
        </a>
        <div class="ml-auto">
            <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="scrollbar-inner">
        <div class="div-mega">
            <ul class="navbar-nav navbar-nav-docs">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('*dashboard*') ? ' active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                @can('manage-users')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*users*') ? ' active' : '' }}" href="{{ route('admin.users') }}">
                            <i class="fas fa-users"></i>
                            <span>{{ __('Users') }}</span>
                        </a>
                    </li>
                @endcan
                @can('manage-tickets')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*ticket*') ? ' active' : '' }}" href="{{ route('admin.tickets.index') }}">
                            <i class="fas fa-ticket-alt"></i>
                            <span>{{ __('Tickets') }}</span>
                        </a>
                    </li>
                @endcan
                @can('manage-category')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*category*') ? ' active' : '' }}" href="{{ route('admin.category') }}">
                            <i class="fas fa-list-alt"></i>
                            <span>{{ __('Category') }}</span>
                        </a>
                    </li>
                @endcan
                @can('manage-faq')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*faq*') ? ' active' : '' }}" href="{{ route('admin.faq') }}">
                            <i class="fas fa-question"></i>
                            <span>{{ __('FAQ') }}</span>
                        </a>
                    </li>
                @endcan
                @if(env('CHAT_MODULE') == 'yes')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*chat*') ? ' active' : '' }}" href="{{ route('admin.chats') }}">
                            <i class="fas fa-comments"></i>
                            <span>{{ __('Chat') }}</span>
                        </a>
                    </li>
                @endif
                @can('manage-setting')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('*setting*') ? ' active' : '' }}" href="{{ route('admin.settings.index') }}">
                            <i class="fas fa-cog"></i>
                            <span>{{ __('Settings') }}</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
