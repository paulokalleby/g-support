@section('title', 'Recuperar senha')

<div>
    <div class="py-5 pb-5">
        <div class="container">
            <div class="text-center mb-3">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <img class="rounded" src="{{ orImage(settings('logo'), 'brand.jpg') }}" alt="" width="140"> 
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7">
                        <div class="bg-secondary border-0 p-3">
                            <div class="px-md-5 py-4">
                                <h2>Recuperar senha</h2>
                                <div class="text-center text-muted mb-4">
                                    <small>Informe o seu email</small>
                                </div>

                                <form role="form" method="post" wire:target="sendResetLink"
                                    wire:submit.prevent="sendResetLink">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                            </div>
                                            <input class="form-control" type="text" name="email"
                                                wire:model.defer="email" placeholder="Email">
                                        </div>

                                        @error('email')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <button type="submit" wire:loading.attr="disabled"
                                        class="btn btn-lg btn-primary mb-2 mt-0 btn-block">
                                        <span wire:loading.remove wire:target="sendResetLink">Enviar</span>
                                        <i wire:loading wire:target="sendResetLink" class="fas fa-spinner fa-pulse"></i>
                                    </button>

                                    <small>
                                        <a href="{{ route('auth.login') }}">Fazer login</a>
                                    </small>

                                    @if (session()->has('success'))
                                        <small class="form-text text-success">{{ session('success') }}</span>
                                        @elseif (session()->has('danger'))
                                            <small class="form-text text-danger">{{ session('danger') }}</span>
                                    @endif

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('component-styles')
    <style>
        input[readonly] {
            background-color: white !important;
        }
    </style>
@endpush
