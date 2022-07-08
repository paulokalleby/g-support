@section('title', 'Configurações')

@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-links">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">configurações</li>
    </ol>
@endsection

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-lg-9 col-12">

            <div class="card">

                <div class="card-body pt-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">Nome</label>
                                <input type="text" class="form-control form-control-muted" placeholder="Nome"
                                    wire:model.defer="name">
                                @error('name')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">URL</label>
                                <input type="text" class="form-control form-control-muted"
                                    placeholder="https://exemplo.com.br" wire:model.defer="url">
                                @error('url')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @if (session()->has('data'))
                        <p class="text-success">{{ session('data') }}</p>
                    @endif

                    <button type="button" wire:loading.attr="disabled" wire:click.prevent="updateData"
                        class="btn btn-primary">
                        Atualizar
                        <i wire:loading wire:target="updateData" class="fas fa-spinner fa-pulse"></i>
                    </button>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-12">

            <div class="card">

                <div class="card-body pb-0">

                    <div class="form-group logo">
                        @if ($photo)
                            <img alt="{{ $name }}" class="mx-auto d-block img-fluid rounded"
                                src="{{ $photo->temporaryUrl() }}">
                        @else
                            <img alt="{{ $name }}" class="mx-auto d-block img-fluid rounded"
                                src="{{ orImage($logo, 'brand.jpg') }}">
                        @endif

                        <p class="text-center mt-3">
                            @if ($photo)
                                <button class="btn btn-icon-only btn-sm rounded-circle btn-outline-primary"
                                    wire:click="uploadCancel">
                                    <span class="btn-inner--icon"><i class="fas fa-times"></i></span>
                                </button>
                                <button class="btn btn-icon-only btn-sm rounded-circle btn-outline-primary"
                                    wire:click="uploadLogo">
                                    <span class="btn-inner--icon"><i class="fas fa-check"></i></span>
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

            </div>


            <p class="text-muted">
                <small>Formatos aceitos: jpeg, png e jpg</small><br>
                <small>Tamanho máximo: 1024KB</small>
            </p>

        </div>

    </div>
</div>
