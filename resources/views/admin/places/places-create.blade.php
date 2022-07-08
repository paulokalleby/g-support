<div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" method="post">

        <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Cadastrar Departamento</h6>
        </div>

        <div class="modal-body mb-0 pb-0 pt-1">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group mb-2">
                        <label for="" class="form-control-label">Nome</label>
                        <input type="text" class="form-control form-control-muted" placeholder="Nome"
                            wire:model.defer="name">
                        @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group mb-2">
                        <label for="" class="form-control-label">Descrição</label>
                        <textarea class="form-control form-control-muted" rows="2" placeholder="Descrição" wire:model.defer="description"></textarea>
                        @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

        </div>

        <div class="modal-footer pt-0 mt-2">
            <button type="button" wire:click.prevent="clear" class="btn btn-outline-primary" data-dismiss="modal">
                Cancelar
            </button>
            <button type="button" wire:loading.attr="disabled" wire:click.prevent="store"
                class="btn btn-primary ml-auto">
                Salvar
                <i wire:loading wire:target="store" class="fas fa-spinner fa-pulse"></i>
            </button>
        </div>
    </div>
</div>
