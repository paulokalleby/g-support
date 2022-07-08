<div class="modal-dialog" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Cadastrar Usuário</h6>
        </div>

        <div class="modal-body mb-0 pb-2 pt-1">

            <div class="form-group mb-2">
                <label for="" class="form-control-label">Nome</label>
                <input type="text" class="form-control form-control-muted" placeholder="Nome" wire:model.defer="name">
                @error('name')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="" class="form-control-label">Email</label>
                <input type="text" class="form-control form-control-muted" placeholder="Email" wire:model.defer="email">
                @error('email')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group mb-2">
                        <label for="" class="form-control-label">Localidade</label>
                        <select class="form-control form-control-muted" wire:model.defer="locality">
                            <option value="">Selecione uma Localidade</option>
                            @foreach ($localities as $locality)
                                <option value="{{ $locality->id }}">{{ $locality->name }}</option>
                            @endforeach
                        </select>
                        @error('locality')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-2">
                        <label for="" class="form-control-label">Departamento</label>
                        <select class="form-control form-control-muted" wire:model.defer="department">
                            <option value="">Selecione um Departamento</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group mb-2">
                        <label for="" class="form-control-label">Senha</label>
                        <input type="password" class="form-control form-control-muted" placeholder="Senha" wire:model.defer="password">
                        @error('password')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group mb-2">
                        <label for="" class="form-control-label">Confirmar</label>
                        <input type="password" class="form-control form-control-muted" placeholder="Confirmar Senha"
                            wire:model.defer="confirm">
                        @error('confirm')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            @if (session()->has('message'))
                <p class="text-success">{{ session('message') }}</p>
            @endif


        </div>

        <div class="modal-footer pt-0 mt-0 text-right">

            <button type="button" wire:click.prevent="clear" class="btn btn-outline-primary"
                data-dismiss="modal">
                Fechar
            </button>

            <button type="button" wire:loading.attr="disabled" wire:click.prevent="store"
                class="btn btn-primary ml-auto">
                Salvar
                <i wire:loading wire:target="store" class="fas fa-spinner fa-pulse"></i>
            </button>

        </div>
    </div>
</div>
