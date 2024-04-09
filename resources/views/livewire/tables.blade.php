<div class="">
        <!-- Navbar -->
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                            <h6 class="text-uppercase text-white text-center text-lg mx-3">
                                Registro de Accesos
                            </h6>                            
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nombre
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Puerta
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Fecha
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($movimientos as $movimiento)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $movimiento->username }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success">{{ $movimiento->puerta }}</span>
                                            </td>
                                            <td>
                                                {{ $movimiento->fecha }}
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
    </div>