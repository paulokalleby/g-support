<div class="modal-dialog modal-sm" role="document">
    <form class="modal-content" method="post">

        <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Editar Categoria</h6>
            <div class="d-flex align-items-center">
                <div>
                    <label class="custom-toggle mt-0">
                        <input type="checkbox" wire:model.defer="active">
                        <span class="custom-toggle-slider rounded-circle" data-label-off="" data-label-on=""></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="modal-body mb-0 pb-0 pt-1">

            <div class="form-group mb-2">
                <label for="" class="form-control-label">Nome</label>
                <input type="text" class="form-control form-control-muted" placeholder="Nome"
                    wire:model.defer="name">
                @error('name')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div wire:ignore class="form-group mb-2">
                <label for="" class="form-control-label">Prioridade</label>
                <select class="form-control form-control-muted" wire:model.defer="priority">
                    <option>Selecione uma Prioridade</option>
                    @foreach (config('enums.priority') as $k => $v)
                        <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
                @error('priority')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>

        <div class="modal-footer pt-0 mt-2">

            <button type="button" wire:click.prevent="clear" class="btn btn-outline-primary" data-dismiss="modal">
                Fechar
            </button>

            <button type="button" wire:loading.attr="disabled" wire:click.prevent="update"
                class="btn btn-primary  ml-auto">
                Alterar
                <i wire:loading wire:target="update" class="fas fa-spinner fa-pulse"></i>
            </button>

        </div>
    </form>
</div>
