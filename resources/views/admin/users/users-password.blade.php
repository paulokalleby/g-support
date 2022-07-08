<div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Alterar Senha</h6>
        </div>

        <div class="modal-body mb-0 pb-2 pt-1">

            <div class="form-group mb-2">
                <label for="" class="form-control-label">Nova Senha</label>
                <input type="password" class="form-control form-control-muted" placeholder="Senha"
                    wire:model.defer="password">
                @error('password')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="" class="form-control-label">Confirmar</label>
                <input type="password" class="form-control form-control-muted" placeholder="Confirmar Senha"
                    wire:model.defer="confirm">
                @error('confirm')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>

        <div class="modal-footer pt-0 mt-0">

            <button type="button" wire:click.prevent="clear" class="btn btn-outline-primary" data-dismiss="modal">
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
