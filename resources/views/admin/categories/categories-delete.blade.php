<div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" method="post">

        <div class="modal-header bg-danger">
            <h6 class="modal-title text-white" id="modal-title-default">Atenção</h6>
        </div>
          
        <div class="modal-body py-0">
            <p>Deseja excluir o item  de UUID?</p>
            <p><b>{{ $uuid }}</b></p>
        </div>

        <div class="modal-footer pt-0 mt-0">

            <button type="button" wire:loading.attr="disabled" wire:click.prevent="delete('{{ $uuid }}')"
                class="btn btn-white" data-dismiss="modal">
                Sim
                <i wire:loading wire:target="delete" class="fas fa-spinner fa-pulse"></i>
            </button>

            <button type="button" wire:click.prevent="cancel" class="btn btn-outline-white ml-auto" data-dismiss="modal">
                Cancelar
            </button>

        </div>
    </div>
</div>
