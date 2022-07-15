<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Chamado Nº {{ $identify }}</h6>
            <button type="button" wire:click.prevent="clear" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body mb-0 pt-0 pb-4 px-_">

            <div class="row">
                <div class="col-lg-8">


                    <div class="media media-comment mt-0 mb-3">
                        <img alt="Image placeholder"
                            class="avatar avatar-lg media-comment-avatar rounded-circle"
                            src="{{ orImage($avatar_r, 'avatar.jpg') }}">
                        <div class="media-body">
                            <div class="media-comment-text">
                                <h6 class="h5 mt-0">{{ $requester }}</h6>
                                <h6 class="h5 mt-0 text-muted">{{ $title }}</h6>
                                <p class="text-sm lh-160">{{ $problem }}</p>
                                {{--
                                <div class="icon-actions">
                                    <a class="text-success" href="https://api.whatsapp.com/send?1=pt_BR&phone=55{{ $whatsapp }}&text=Chamado:%20{{ $identify }}" target="_blank">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                                ---}}
                            </div>
                        </div>
                    </div>

                    @if ($status != 'pending' && $status != 'attending')
                    <div class="media media-comment mt-0">
                        <img alt="Image placeholder"
                            class="avatar avatar-lg media-comment-avatar rounded-circle"
                            src="{{ orImage($avatar_a, 'avatar.jpg') }}">
                        <div class="media-body">
                            <div class="media-comment-text">
                                <h6 class="h5 mt-0">{{ $attendance }}</h6>
                                @if ($solution)
                                    <p class="text-sm lh-160">{{ $solution }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @elseif($status == 'attending')
                        <div class="flex-column align-items-start ml-2">
                            <div class="d-flex w-100 justify-content-between">
                                <div>
                                    <div class="d-flex w-100 align-items-center">
                                        <img src="{{ orImage($avatar_a, 'avatar.jpg') }}" alt="Image placeholder"
                                            class="avatar avatar-xs mr-2" />
                                        <h5 class="">{{ $attendance }} <small class="text-info">atendendo...</small></h5>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($status == 'attending' && $attendance_id == auth()->user()->id)
                    
                        <hr />
                        <div class="media align-items-center">
                            <img alt="Image placeholder" class="avatar avatar-lg rounded-circle mr-4"
                                src="{{ orImage($avatar_a, 'avatar.jpg') }}">
                            <div class="media-body">
                                <div>
                                    <textarea class="form-control form-control-muted" style="resize: none" rows="2" wire:model.defer="solution"
                                        placeholder="Descreva o procedimento realizado"></textarea>
                                    @error('solution')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    @endif

                    @if (auth()->user()->technician == 1)

                        <div class="text-right mt-2">
                            @if ($status == 'pending')
                                <button type="button" wire:loading.attr="disabled" wire:click.prevent="toMeet"
                                    class="btn btn-primary btn-sm ml-auto">
                                    Iniciar atentimento
                                    <i wire:loading wire:target="toMeet" class="fas fa-spinner fa-pulse"></i>
                                </button>
                            @endif

                            @if ($status == 'attending' && $attendance_id == auth()->user()->id)
                                <button type="button" wire:loading.attr="disabled" wire:click.prevent="finishing"
                                    class="btn btn-primary btn-sm ml-auto mb-3">
                                    Finalizar
                                    <i wire:loading wire:target="finishing" class="fas fa-spinner fa-pulse"></i>
                                </button>
                            @endif
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

    </div>
</div>
