<div class="modal-dialog" role="document">
    <form class="modal-content" method="post" wire:submit.prevent="update">

        <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Permissões de Acesso</h6>
        </div>

        <div class="modal-body mb-0 pb-0 pt-1">

            <div class="row mb-2">
                @foreach ($permissions as $index => $item)
                    <div class="col-lg-6">
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-input" id="permission-{{ $item->slug }}"
                                wire:model.defer="permission.{{ $item->id }}">
                            <label class="custom-control-label" for="permission-{{ $item->slug }}">
                                {{ $item->name }}
                            </label>
                        </div>
                    </div>
                @endforeach

                <div class="col-lg-6">
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="technician"
                            wire:model.defer="technician">
                        <label class="custom-control-label" for="technician">
                            Técnico
                        </label>
                    </div>
                </div>

            </div>

        </div>

        <div class="modal-footer pt-0 mt-0">

            <button type="button" wire:click.prevent="clear" class="btn btn-outline-primary" data-dismiss="modal">
                Fechar
            </button>

            <button type="submit" wire:loading.attr="disabled" class="btn btn-primary  ml-auto">
                Atualizar
                <i wire:loading wire:target="update" class="fas fa-spinner fa-pulse"></i>
            </button>

        </div>
    </form>
</div>
