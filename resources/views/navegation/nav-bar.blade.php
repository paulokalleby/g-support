@auth
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-gradient-primary border-bottom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <div class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                    <h3 class="text-white">
                        @yield('title')
                    </h3>
                </div>

                <ul class="navbar-nav align-items-center  ml-md-auto ">
                    <li class="nav-item d-xl-none">
                        <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                            data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </div>
                    </li>
                </ul>

                <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">

                    {{--
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fas fa-bell"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">

                            <div class="px-3 py-3">
                                <h6 class="text-sm text-muted m-0">Ultimos pedidos <strong class="text-primary">Abertos</strong></h6>
                            </div>

                            <div class="list-group list-group-flush">
                                <a href="#!" class="list-group-item list-group-item-action">
                                    <div class="row align-items-center">
                                        <div class="col-auto">

                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                    --}}


                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0 " href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="{{ auth()->user()->name }}"
                                        src="{{ orImage(auth()->user()->avatar, 'avatar.jpg') }}">
                                </span>
                                <div class="media-body  ml-2  d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">
                                        {{ auth()->user()->name }}
                                    </span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right ">
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Bem-vindo!</h6>
                            </div>
                            <a href="{{ route('profile.index') }}" class="dropdown-item">
                                <i class="fas fa-id-card"></i>
                                <span>Meu Perfil</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a wire:click.prevent="navLogout" class="dropdown-item btn-logout">
                                <i class="fas fa-power-off"></i>
                                <span>Sair</span>
                            </a>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
@endauth
