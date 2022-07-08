@section('title', 'Perfil')

@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-links">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">perfil</li>
    </ol>
@endsection

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-lg-8">

            <!-- CARD PROFILE -->
            <div class="card">
                <div class="card-header border-1">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">
                                Meus dados
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-3">
                    <div class="row">
                        <div class="col-md-2 col-12 pb-5">

                            <div class="form-group">
                                @if ($photo)
                                    <img alt="{{ $name }}" class="rounded-circle mx-auto d-block img-fluid"
                                        src="{{ $photo->temporaryUrl() }}">
                                @else
                                    <img alt="{{ $name }}" class="rounded-circle mx-auto d-block img-fluid"
                                        src="{{ orImage($avatar, 'avatar.jpg') }}">
                                @endif

                                <p class="text-center mt-1">
                                    @if ($photo)
                                        <button class="btn btn-icon-only btn-sm rounded-circle btn-outline-primary"
                                            wire:click="uploadCancel">
                                            <span class="btn-inner--icon">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        </button>

                                        <button class="btn btn-icon-only btn-sm rounded-circle btn-outline-primary"
                                            wire:click="uploadAvatar">
                                            <span class="btn-inner--icon">
                                                <i class="fas fa-check"></i>
                                            </span>
                                        </button>
                                    @else
                                        <label for="photo" class="mb-0">
                                            <input class="img-upload-brand-input" type="file" hidden id="photo"
                                                wire:model="photo" accept="image/*">

                                            <span class="text-center btn btn-outline-primary rounded-circle btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </span>
                                        </label>
                                    @endif
                                </p>
                                <p class="text-center">
                                    <small wire:loading wire:target="photo">Carregando...</small>
                                </p>
                            </div>


                        </div>
                        <div class="col-md-10 col-12">
                            <form action="" method="post" class="mb-1">
                                <div class="form-group mb-2 mt-0">
                                    <label for="" class="form-control-label">Nome</label>
                                    <input type="text" class="form-control form-control-muted" placeholder="Nome"
                                        wire:model.defer="name">
                                    @error('name')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-control-label">Email</label>
                                    <input type="text" class="form-control form-control-muted" placeholder="Email"
                                        wire:model.defer="email">
                                    @error('email')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                @if (session()->has('message-profile'))
                                    <p class="text-success">{{ session('message-profile') }}</p>
                                @endif

                                <button type="button" class="btn btn-primary" wire:loading.attr="disabled"
                                    wire:click.prevent="updateProfile">
                                    Atualizar
                                    <i wire:loading wire:target="updateProfile" class="fas fa-spinner fa-pulse"></i>
                                </button>

                                <button type="button" class="btn btn-secondary" wire:loading.attr="disabled"
                                    wire:click="clear">
                                    <i wire:target="clear" wire:loading.class="fa-pulse" class="far fa-sync-alt"></i>
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CARD PROFILE -->
        </div>

        <div class="col-lg-4 col-12">

            <!-- CARD PASSWORD -->
            <div class="card">
                <div class="card-header border-1">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">
                                Alteração de senha
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-3">
                    <form action="" method="post" class="mb-1">

                        <div class="form-group mb-2">
                            <label for="" class="form-control-label">Senha</label>
                            <input type="password" class="form-control form-control-muted" wire:model.defer="password"
                                placeholder="Senha">
                            @error('password')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="" class="form-control-label">Confirmação da Senha</label>
                            <input type="password" class="form-control form-control-muted" wire:model.defer="confirm"
                                placeholder="Confirmação">
                            @error('confirm')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        @if (session()->has('message-password'))
                            <p class="text-success">{{ session('message-password') }}</p>
                        @endif

                        <button type="button" class="btn btn-primary" wire:loading.attr="disabled"
                            wire:click.prevent="updatePassword">
                            Alterar
                            <i wire:loading wire:target="updatePassword" class="fas fa-spinner fa-pulse"></i>
                        </button>

                        <button type="button" class="btn btn-secondary" wire:loading.attr="disabled"
                            wire:click="clear">
                            <i wire:target="clear" wire:loading.class="fa-pulse" class="far fa-sync-alt"></i>
                        </button>

                    </form>
                </div>
            </div>
            <!-- CARD PASSWORD -->

        </div>


    </div>

    <div class="row">
        <div class="col-lg-12">

            <!-- CARD PROFILE -->
            <div class="card">
                <div class="card-header border-1">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">
                                Permissões
                            </h3>

                        </div>
                    </div>
                </div>
                <div class="card-body pt-3">

                    @foreach ($user->permissions as $permission)
                        <span class="badge badge-lg badge-pill badge-primary mb-2">{{ $permission->name }}</span>
                    @endforeach

                    @if ($technician)
                        <span class="badge badge-lg badge-pill badge-primary mb-2">Técnico</span>
                    @endif

                </div>
            </div>
            <!-- CARD PROFILE -->
        </div>
    </div>
</div>
