
<div class="container my-auto mt-5">
                <div class="row signin-margin">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1" style="background-image: linear-gradient(195deg, #000 0%, #43A047 100%);">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">V I T A </h4>
                                    
                                </div>
                            </div>
                            <div class="card-body">
                                <form wire:submit.prevent='store'>
                                    @if (Session::has('status'))
                                    <div class="alert alert-success alert-dismissible text-white" role="alert">
                                        <span class="text-sm">{{ Session::get('status') }}</span>
                                        <button type="button" class="btn-close text-lg py-3 opacity-10"
                                            data-bs-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                    <div class="input-group input-group-outline mt-3 @if(strlen($email ?? '') > 0) is-filled @endif">
                                        <label class="form-label">Correo electrónico</label>
                                        <input wire:model='email' type="email" class="form-control" >
                                    </div>
                                    @error('email')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror

                                    <div class="input-group input-group-outline mt-3 @if(strlen($password ?? '') > 0) is-filled @endif">
                                        <label class="form-label">Contraseña</label>
                                        <input wire:model="password" type="password" class="form-control"
                                             >
                                    </div>  
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2" style="background-image: linear-gradient(195deg, #000 0%, #43A047 100%);">Iniciar sesión</button>
                                    </div>
                                    <p class="mt-4 text-sm text-center">
                                        ¿No tienes una cuenta? ¡Regístrate!
                                        <a href="{{ route('register') }}"
                                            class="text-success text-gradient font-weight-bold"style="background-image: linear-gradient(195deg, #000 0%, #43A047 100%);">Crear</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>