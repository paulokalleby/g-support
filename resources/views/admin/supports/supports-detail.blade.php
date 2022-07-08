<div class="modal-dialog" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Nº #{{ $identify }}</h6>
            <button type="button" wire:click.prevent="clear" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body mb-0 py-0 px-3">

            <div class="flex-column align-items-start py-2 px-2">
                <div class="d-flex w-100 justify-content-between">
                    <div>
                        <div class="d-flex w-100 align-items-center">
                            <img src="{{ orImage($avatar_r, 'avatar.jpg') }}" alt="Image placeholder"
                                class="avatar avatar-xs mr-2" />
                            <h5 class="mb-1">{{ $requester }}</h5>
                        </div>
                    </div>
                    <small>{{ dateTimeToBr($created) }}</small>
                </div>
                <h4 class="mt-3 mb-1">{{ $title }}</h4>
                <p class="text-sm mb-0">{{ $problem }}</p>
            </div>


            @if ($status != 'pending')
                <div class="flex-column align-items-start py-2 px-2">
                    <div class="d-flex w-100 justify-content-between">
                        <div>
                            <div class="d-flex w-100 align-items-center">
                                <img src="{{ orImage($avatar_r, 'avatar.jpg') }}" alt="Image placeholder"
                                    class="avatar avatar-xs mr-2" />
                                <h5 class="mb-1">{{ $requester }}</h5>
                            </div>
                        </div>
                        <small>{{ dateTimeToBr($updated) }}</small>
                    </div>
                    @if ($solution)
                        <p class="text-sm mb-0">{{ $solution }}</p>
                    @endif
                </div>
            @endif
            <p>
                @if ($status == 'pending')
                    <span class="badge badge-pill badge-warning badge-lg">
                        {{ config('enums.status')[$status] }}
                    </span>
                @elseif($status == 'attending')
                    <span class="badge badge-pill badge-info badge-lg">
                        {{ config('enums.status')[$status] }}
                    </span>
                @elseif($status == 'solved')
                    <span class="badge badge-pill badge-success badge-lg">
                        {{ config('enums.status')[$status] }}
                    </span>
                @elseif($status == 'canceled')
                    <span class="badge badge-pill badge-danger badge-lg">
                        {{ config('enums.status')[$status] }}
                    </span>
                @endif
            </p>


        </div>

    </div>
</div>
