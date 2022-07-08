@auth
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <div class="sidenav-header d-flex align-items-center">


                <a class="navbar-brand" href="javascript:void(0)">
                    <img class="rounded" src="{{ orImage(settings('logo'), 'brand.jpg') }}" alt="">
                </a>

                <div class=" ml-auto">
                    <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>

            </div>

            <div class="navbar-inner">
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">

                    <ul class="navbar-nav">

                        @foreach (config('lwstart.menu') as $value)
                            @if ($value['can'])
                                @can($value['can'])
                                    <li class="nav-item">
                                        <a class="nav-link @if (request()->routeIs($value['route'])) active @endif"
                                            href="{{ route($value['route']) }}">
                                            <i class="fal {{ $value['icon'] }} text-primary"></i>
                                            <span class="nav-link-text">{{ $value['text'] }}</span>
                                        </a>
                                    </li>
                                @endcan
                            @else
                                <li class="nav-item">
                                    <a class="nav-link @if (request()->routeIs($value['route'])) active @endif"
                                        href="{{ route($value['route']) }}">
                                        <i class="fal {{ $value['icon'] }} text-primary"></i>
                                        <span class="nav-link-text">{{ $value['text'] }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach

                        <li class="nav-item">
                            <a class="nav-link btn-logout" wire:click.prevent="sideLogout">
                                <i class="fal fa-power-off text-primary"></i>
                                <span class="nav-link-text">Sair</span>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </nav>
@endauth
