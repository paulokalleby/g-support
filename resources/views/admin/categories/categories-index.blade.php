@section('title', 'Categorias')

@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-links">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">categorias</li>
    </ol>
@endsection

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card card-table">
                <div class="card-header border-1 border-bottom-0 pt-0 mb-0">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-12">
                            <div class="input-group  mb-2">
                                <input class="form-control form-control-muted" placeholder="Categoria" type="text"
                                    wire:model="name">
                            </div>
                        </div>
                        <div class="col-lg-2 col-12">
                            <div class="input-group  mb-2">
                                <select class="form-control form-control-muted" wire:model="status">
                                    <option value="">Todos</option>
                                    <option value="1">Ativos</option>
                                    <option value="0">Inativos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-12">
                            <div class="input-group  mb-2">
                                <select class="form-control form-control-muted" wire:model="pages">
                                    <option value="6">6 Itens</option>
                                    <option value="15">15 Itens</option>
                                    <option value="25">25 Itens</option>
                                    <option value="50">50 Itens</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-1 col-6">
                            <button type="button" class="btn btn-secondary mb-2" wire:loading.attr="disabled"
                                wire:click="resetFilters">
                                <i wire:target="resetFilters" wire:loading.class="fa-pulse"
                                    class="far fa-sync-alt"></i>
                            </button>
                        </div>
                        <div class="col-lg-4 col-6 text-right">
                            <button type="button" class="btn btn-primary mb-2" wire:click="openCreateModal"
                                data-toggle="modal" data-target="#modal-create">
                                <i class="far fa-plus"></i>
                            </button>
                        </div>

                    </div>
                </div>

                <div class="table-responsive">

                    @if ($categories->isEmpty())
                        <p class="text-center">Nenhum registro encontrado!</p>
                    @else
                        <table class="table table-sm align-items-center table-flush">
                            <thead class="thead-light_">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Prioridade</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="status">
                                            @if ($category->active)
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-success"></i>
                                                </span>
                                            @else
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-warning"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td>
                                            {{ config('enums.priority')[$category->priority] }}
                                        </td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-sm btn-link"
                                                wire:click="$emit('setEditCategory', '{{ $category->id }}')"
                                                data-toggle="modal" data-target="#modal-edit">
                                                <i class="fas fa-pencil"></i> Editar
                                            </button>

                                            @if ($category->calleds->count() > 0)
                                                <button type="button"  disabled="" class="btn btn-sm btn-link">
                                                    <i class="fas fa-trash"></i> Remover
                                                </button>
                                            @else
                                                <button type="button"
                                                    class="btn btn-sm btn-link"
                                                    wire:click="$emit('setDeleteCategory', '{{ $category->id }}')"
                                                    data-toggle="modal" data-target="#modal-delete">
                                                    <i class="fas fa-trash"></i> Remover
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>

            <div class="d-flex justify-content-center">
                {{ $categories->onEachSide(1)->links() }}
            </div>

        </div>
    </div>


    <!-- MODAL FORM-CREATE -->
    <div wire:ignore.self class="modal fade" id="modal-create" tabindex="-1" role="dialog"
        aria-labelledby="modal-create" aria-hidden="true">
        <livewire:admin.categories.categories-create />
    </div>
    <!-- MODAL FORM-CREATE -->

    <!-- MODAL FORM-EDIT -->
    <div wire:ignore.self class="modal fade" id="modal-edit" tabindex="-1" role="dialog"
        aria-labelledby="modal-edit" aria-hidden="true">
        <livewire:admin.categories.categories-edit />
    </div>
    <!-- MODAL FORM-EDIT -->

    <!-- MODAL DELETE -->
    <div wire:ignore.self class="modal modal-danger fade" id="modal-delete" tabindex="-1" role="dialog"
        aria-labelledby="modal-delete" aria-hidden="true">
        <livewire:admin.categories.categories-delete />
    </div>
    <!-- MODAL DELETE -->

</div>
