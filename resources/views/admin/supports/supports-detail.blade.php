<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Chamado Nº {{ $identify }}</h6>
            <button type="button" wire:click.prevent="clear" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body mb-0 pt-0 pb-3 px-3">

            <div class="row">
                <div class="col-lg-8 border-right">

                    <div class="flex-column align-items-start py-2 px-2">
                        <div class="d-flex w-100 justify-content-between">
                            <div>
                                <div class="d-flex w-100 align-items-center">
                                    <img src="{{ orImage($avatar_r, 'avatar.jpg') }}" alt="Image placeholder"
                                        class="avatar avatar-xs mr-2" />
                                    <h5 class="mb-1">{{ $requester }}</h5>
                                </div>
                            </div>
                            {{--<small>{{ dateTimeToBr($created) }}</small>--}}
                        </div>
                        <h4 class="mt-3 mb-1">{{ $title }}</h4>
                        <p class="text-sm mb-0">{{ $problem }}</p>
                    </div>


                    @if ($status != 'pending')
                        <div class="flex-column align-items-start py-2 px-2">
                            <div class="d-flex w-100 justify-content-between">
                                <div>
                                    <div class="d-flex w-100 align-items-center">
                                        <img src="{{ orImage($avatar_a, 'avatar.jpg') }}" alt="Image placeholder"
                                            class="avatar avatar-xs mr-2" />
                                        <h5 class="mb-1">{{ $attendance }}</h5>
                                    </div>
                                </div>
                                {{--<small>{{ dateTimeToBr($updated) }}</small>--}}
                            </div>
                            @if ($solution)
                                <p class="text-sm mb-0">{{ $solution }}</p>
                            @endif
                        </div>
                    @endif

                    {{--
                    <p class="ml-2">
                        @if ($status == 'pending')
                            <span class="badge badge-pill badge-warning">
                                {{ config('enums.status')[$status] }}
                            </span>
                        @elseif($status == 'attending')
                            <span class="badge badge-pill badge-info">
                                {{ config('enums.status')[$status] }}
                            </span>
                        @elseif($status == 'solved')
                            <span class="badge badge-pill badge-success">
                                {{ config('enums.status')[$status] }}
                            </span>
                        @elseif($status == 'canceled')
                            <span class="badge badge-pill badge-danger">
                                {{ config('enums.status')[$status] }}
                            </span>
                        @endif
                    </p>
                    --}}

                    @if ($status == 'attending' && $attendance_id == auth()->user()->id)
                        <div class="form-group mx-2 mb-0">
                            <label for="" class="form-control-label">Informe a solução</label>
                            <textarea class="form-control form-control-muted" style="resize: none" rows="3" wire:model.defer="solution"
                                placeholder="Descreva o procedimento realizado"></textarea>
                            @error('solution')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    @endif

                </div>

                <div class="col-lg-4 pl-4">

                    <h5 class="text-muted">Linha do Tempo</h5>
                    <div class="timeline timeline-one-side" data-timeline-content="axis"
                        data-timeline-axis-style="dashed">
                    
                        @foreach($timelines as $v)
                        <div class="timeline-block my-0">
                            <span class="timeline-step badge-{{ $v->color }} mt-1">
                                <i class="fa {{ $v->icon }}"></i>
                            </span>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between pt-1">
                                    <div>
                                        <span class="text-muted text-sm font-weight-bold">{{ $v->label }}</span>
                                    </div>
                                    <div class="text-right">
                                        {{--<small class="text-muted"><i class="fas fa-clock mr-1"></i>2 hrs ago</small>--}}
                                    </div>
                                </div>
                                <h6 class="text-sm mt-1 mb-0">{{ dateTimeToBr($v->created_at) }}</h6>
                            </div>
                        </div>
                        @endforeach
                    
                    </div>

                </div>

            </div>
        </div>

        @if (auth()->user()->technician == 1)
            <div class="modal-footer pt-0 mt-0">

                @if ($status == 'pending')
                    <button type="button" wire:loading.attr="disabled" wire:click.prevent="toMeet"
                        class="btn btn-primary mr-auto">
                        Atender
                        <i wire:loading wire:target="toMeet" class="fas fa-spinner fa-pulse"></i>
                    </button>
                @endif

                @if ($status == 'attending' && $attendance_id == auth()->user()->id)
                    <button type="button" wire:loading.attr="disabled" wire:click.prevent="finishing"
                        class="btn btn-primary mr-auto">
                        Finalizar
                        <i wire:loading wire:target="finishing" class="fas fa-spinner fa-pulse"></i>
                    </button>
                @endif

            </div>
        @endif

    </div>
</div>
