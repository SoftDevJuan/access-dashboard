

        <!-- Navbar -->
        <!-- End Navbar -->
        <div class="container-fluid py-4">
        <div wire:ignore.self id="modal-open-form-employee" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Crear Puerta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="saveChanges" role="form text-left">
                        <div class="modal-body">
                            <div class="input-group input-group-static mb-4">
                                <label>Numero</label>
                                <input wire:model="numero" type="text" class="form-control">
                            </div>
                            <div class="input-group input-group-static mb-4">
                                <label>Serial ID</label>
                                <input wire:model="idPuerta" type="text" class="form-control">
                            </div>

                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="basic-url">Usuarios Permitidos</label>
                            </div>
                            <br>
                            @foreach ($doors as $door)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $door->username }}" username="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $door->username }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button wire:click="$toggle('showModal')" type="submit" class="btn bg-gradient-success">Guardar cambios</button>
                            @if (session()->has('message'))
                                <div>{{ session('message') }}</div>
                            @endif
                            @if (session()->has('error'))
                                <div>{{ session('error') }}</div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                                <h6 class="text-uppercase text-white text-center text-lg mx-3">
                                    <strong>Puertas Activas<strong>    
                                </h6>
                            </div>
                        </div>
                        <div class=" me-3 my-3 text-end">
                            <button class="btn bg-gradient-secondary mb-0" data-bs-toggle="modal" wire:click="$toggle('showModal')" data-bs-target="#modal-open-form-employee">
                                <i class="material-icons text-md">add</i>
                                &nbsp;&nbsp;Agregar Puerta Nueva
                            </button>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>                                            
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Numero
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                ID Puerta
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Administrador
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($resultados as  $resultados)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{ $resultados->numero }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $resultados->idPuerta }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs text-secondary mb-0">{{ $resultados->emailAdmin }}</p>
                                            </td>                                        
                                            <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-warning btn-link" href="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-link" data-original-title="" title="">
                                                    <i class="material-icons">delete</i>
                                                    <div class="ripple-container"></div>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   

