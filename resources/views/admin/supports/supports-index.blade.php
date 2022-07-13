@section('title', 'Chamados')

@section('breadcrumb')
    <ol class="breadcrumb breadcrumb-links">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">chamados</li>
    </ol>
@endsection

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">

            <div class="card card-table">
                <div class="card-header border-1 border-bottom-0 pt-0 mb-0">
                    <div class="row align-items-center">

                        <div class="col-lg-2 col-12">
                            <div class="input-group mb-2">
                                <input class="form-control form-control-muted" placeholder="Nº" type="text"
                                    wire:model="identify">
                            </div>
                        </div>

                        <div class="@if(auth()->user()->technician) col-lg-2 @else col-lg-3 @endif col-12">
                            <div class="input-group mb-2">
                                <input class="form-control form-control-muted" placeholder="Titulo" type="text"
                                    wire:model="search">
                            </div>
                        </div>

                        @if(auth()->user()->technician)
                            <div class="col-lg-2 col-12">
                                <div class="input-group mb-2">
                                    <select class="form-control form-control-muted" wire:model="category">
                                        <option value="">Todas as Categorias</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-2 col-12">
                                <div class="input-group mb-2">
                                    <select class="form-control form-control-muted" wire:model="status">
                                        <option value="">Todas os Status</option>
                                        @foreach (config('enums.status') as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="col-lg-2 col-12">
                            <div class="input-group  mb-2">
                                <select class="form-control form-control-muted" wire:model="active">
                                    <option value="1">Em andamento</option>
                                    <option value="0">Encerrado</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-1 col-6">
                            <button type="button" class="btn btn-secondary mb-2" wire:loading.attr="disabled"
                                wire:click="resetFilters">
                                <i wire:target="resetFilters" wire:loading.class="fa-pulse" class="far fa-sync-alt"></i>
                            </button>
                        </div>

                        <div class=" @if(auth()->user()->technician) col-lg-1 @else col-lg-4 @endif col-6 text-right">
                            <button type="button" class="btn btn-primary mb-2" wire:click="openCreateModal"
                                data-toggle="modal" data-target="#modal-create">
                                <i class="far fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive table-striped">

                    @if ($calleds->isEmpty())
                        <p class="text-center">Nenhum registro encontrado!</p>
                    @else
                        <table class="table table-sm align-items-center table-flush">
                            <thead class="thead-light_">
                                <tr>
                                    <th>Nº</th>
                                    <th>Solicitante</th>
                                    <th>Chamado</th>
                                    <th>Categoria</th>
                                    <th>Prioridade</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list" wire:poll.15000ms>

                                @foreach ($calleds as $called)
                                    <tr>
                                        <td>
                                            <b># {{ $called->identify }}</b><br>
                                        </td>
                                        <td>
                                            <div class="media align-items-center">
                                                <div class="avatar avatar-sm rounded-circle mr-3">
                                                  <img alt="{{ $called->requester->name }}" src="{{ orImage($called->requester->avatar, 'avatar.jpg') }}">
                                                </div>
                                                <div class="media-body">
                                                  <h5 class="mb-0">{{ $called->requester->name }}<h5>
                                                  <small class="text-muted"><i class="far fa-briefcase"></i> {{ $called->requester->department->name }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="mb-0">{{ $called->title }}</h5>
                                            <small class="text-muted"><i class="fal fa-clock"></i> {{ dateTimeToBr($called->created_at) }}</small>
                                        </td>
                                        <td>
                                            {{ $called->category->name }}
                                        </td>
                                        <td>
                                            {{ config('nums.priority')[$called->category->priority] }}
                                        </td>
                                        <td>
                                            @if ($called->status == 'pending')
                                                <span class="badge badge-pill badge-warning">
                                                    {{ config('enums.status')[$called->status] }}
                                                </span>
                                            @elseif($called->status == 'attending')
                                                <span class="badge badge-pill badge-info">
                                                    {{ config('enums.status')[$called->status] }}
                                                </span>
                                            @elseif($called->status == 'solved')
                                                <span class="badge badge-pill badge-success">
                                                    {{ config('enums.status')[$called->status] }}
                                                </span>
                                            @elseif($called->status == 'canceled')
                                                <span class="badge badge-pill badge-danger">
                                                    {{ config('enums.status')[$called->status] }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-sm btn-link"
                                                wire:click="$emit('setDetailSupport', '{{ $called->id }}')"
                                                data-toggle="modal" data-target="#modal-detail">
                                                <i class="fas fa-arrow-right"></i> Detalhes
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @endif

                </div>
            </div>

            <div class="d-flex justify-content-center">
                {{ $calleds->onEachSide(1)->links() }}
            </div>

        </div>
    </div>

    <!-- MODAL FORM-CREATE -->
    <div wire:ignore.self class="modal fade" id="modal-create" tabindex="-1" role="dialog"
        aria-labelledby="modal-create" aria-hidden="true">
        <livewire:admin.supports.supports-create />
    </div>
    <!-- MODAL FORM-CREATE -->
 
    <!-- MODAL-DETAIL -->
    <div wire:ignore.self class="modal fade" id="modal-detail" tabindex="-1" role="dialog"
        aria-labelledby="modal-detail" aria-hidden="true">
        <livewire:admin.supports.supports-detail />
    </div>
    <!-- MODAL-DETAIL -->

</div>
