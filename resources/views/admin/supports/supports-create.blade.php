<div class="modal-dialog" role="document">
    <form class="modal-content" method="post">

        <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Novo Chamado</h6>
        </div>

        <div class="modal-body mb-0 pb-0 pt-1">

            @if(auth()->user()->technician)
                <div wire:ignore class="form-group mb-2">
                    <label for="" class="form-control-label">Solicitante</label>
                    <select class="form-control_ form-control-muted" id="select2" data-toggle="select" wire:model.defer="requester">
                        @foreach ($requesters as $requester)
                            <option value=""></option>
                            <option value="{{ $requester->id }}">{{ $requester->name }}</option>
                        @endforeach
                    </select>
                    @error('requester')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            @endif

            <div class="form-group mb-2">
                <label for="" class="form-control-label">Titulo</label>
                <input type="text" class="form-control form-control-muted" placeholder="Titulo do Chamado"
                    wire:model.defer="title">
                @error('title')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div wire:ignore class="form-group mb-2">
                <label for="" class="form-control-label">Categoria</label>
                <select class="form-control form-control-muted" wire:model.defer="category">
                    <option>Selecione uma Categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-control-label">Descreva o problema</label>
                <textarea class="form-control form-control-muted" style="resize: none" rows="5" wire:model.defer="problem"
                    placeholder="Problema ou incidente"></textarea>
                @error('problem')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
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
    </form>
</div>


@push('component-styles')
   <link href="{{ asset('/vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css">
   <link href="{{ asset('/vendor/select2/dist/css/select2-bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('component-scripts')
    <script src="{{ asset('/vendor/select2/dist/js/select2.min.js') }}"></script>
    <script>
	$('#select2').select2({
            theme: 'bootstrap4',
            placeholder: 'Selecione um Solicitante',
            language: { noResults: () => "Nenhum resultado",},
            dropdownParent: $("#modal-create"),
        }).on('change', function () {
            @this.set('requester', $(this).val());
        });
    </script>
@endpush