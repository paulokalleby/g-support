@section('title', 'Login')

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
                                <h2>Login</h2>
                                <div class="text-center text-muted mb-4">
                                    <small>Informe as credenciais para acessar</small>
                                </div>

                                <form role="form" action="" method="post" wire:target="submit"
                                    wire:submit.prevent="submit">
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

                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-unlock"></i>
                                                </span>
                                            </div>
                                            <input class="form-control" type="password" name="password"
                                                wire:model.defer="password" placeholder="Senha">
                                        </div>

                                        @error('password')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <button type="submit" wire:loading.attr="disabled"
                                        class="btn btn-lg btn-primary mb-2 mt-0 btn-block">
                                        <span wire:loading.remove wire:target="submit">Entrar</span>
                                        <i wire:loading wire:target="submit" class="fas fa-spinner fa-pulse"></i>
                                    </button>

                                    <small>
                                        <a href="{{ route('password.forgot') }}">Esqueceu a senha?</a>
                                    </small>

                                    @if (session()->has('message'))
                                        <small class="form-text text-danger">{{ session('message') }}</span>
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
