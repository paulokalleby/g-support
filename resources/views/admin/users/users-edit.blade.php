<div class="modal-dialog" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Editar Usuário</h6>
            <div class="d-flex align-items-center">
                <div>
                    <label class="custom-toggle mt-0">
                        <input type="checkbox" wire:model.defer="active">
                        <span class="custom-toggle-slider rounded-circle" data-label-off="" data-label-on=""></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="modal-body mb-0 pb-0 pt-0">

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

        </div>

        <div class="modal-footer pt-0 mt-2">

            <button type="button" wire:click.prevent="clear" class="btn btn-outline-primary"
                data-dismiss="modal">
                Fechar
            </button>

            <button type="button" wire:loading.attr="disabled" wire:click.prevent="update" 
                class="btn btn-primary  ml-auto">
                Alterar
                <i wire:loading wire:target="update" class="fas fa-spinner fa-pulse"></i>
            </button>

        </div>
    </div>
</div>
