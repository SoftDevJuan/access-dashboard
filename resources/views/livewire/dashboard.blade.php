<div>
      <!-- Navbar -->
      <!-- End Navbar -->
      <div class="container-fluid py-4">
          <div class="row pl-2">
            @foreach ($doors as $door)
                @if(isset($door->status))
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute"
                                >
                                <i class="fa fa-fw fa-door-open" aria-hidden="true"></i>
                            </div>
                            <div class="text-end pt-1">
                                <h4 class="mb-0">Puerta {{ $door->numero }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                                <div class="form-check form-switch float-end my-auto">
                                    <input 
                                        id="door-{{ $door->_id }}"
                                        class="form-check-input"
                                        type="checkbox"
                                        wire:click="toggleDoorStatus('{{ $door->_id }}')"
                                        @if($door->status) checked @endif
                                    >
                                </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
          </div>
          <div class="row mt-4">
              <div class="col-lg-2 col-md-3 mt-4 mb-4">
              </div>
              <div class="col-lg-8 col-md-6 mt-4 mb-4">
                  <div class="card z-index-2  ">
                      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                          <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                              <div class="chart">
                                  <canvas id="chart-line" class="chart-canvas" height="350"  wire:ignore></canvas>
                              </div>
                          </div>
                      </div>
                      <div class="card-body">
                            <h6 class="mb-0 "> Selecciona una puerta </h6>
                            <select class="form-select" wire:model="selectedDoor">
                                <option selected value=""></option>
                                @foreach ($doors as $door)
                                @if(isset($door->status))
                                <option value="{{ $door->numero }}">Puerta {{ $door->numero }}</option>
                                @endif
                                @endforeach
                            </select>
                      </div>
                  </div>
              </div>
              <div class="col-lg-2 col-md-3 mt-4 mb-3">
              </div>
          </div>
      </div>
  </div>
  </div>
  @push('js')
  <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
  <script>

        document.addEventListener('livewire:load', function () {
            var ctx = document.getElementById('chart-line').getContext('2d');
            var chart;

            Livewire.on('chartDataUpdated', data => {
                if (chart) {
                    chart.destroy();
                }

                chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                            labels: data.labels,
                            datasets: [{
                                label: "doors data",
                                data: data.data,
                                tension: 0,
                                borderWidth: 0,
                                pointRadius: 5,
                                pointBackgroundColor: "rgba(255, 255, 255, .8)",
                                pointBorderColor: "transparent",
                                borderColor: "rgba(255, 255, 255, .8)",
                                borderColor: "rgba(255, 255, 255, .8)",
                                borderWidth: 4,
                                backgroundColor: "transparent",
                                fill: true,
                                maxBarThickness: 6,
                            }],
                        },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },
                        scales: {
                            y: {
                                grid: {
                                    drawBorder: false,
                                    display: true,
                                    drawOnChartArea: true,
                                    drawTicks: false,
                                    borderDash: [5, 5],
                                    color: 'rgba(255, 255, 255, .2)'
                                },
                                ticks: {
                                    display: true,
                                    color: '#f8f9fa',
                                    padding: 10,
                                    font: {
                                        size: 14,
                                        weight: 300,
                                        family: "Roboto",
                                        style: 'normal',
                                        lineHeight: 2
                                    },
                                },
                                title: {
                                    display: true,
                                    text: 'Cantidad Personal',
                                    color: '#f8f9fa',
                                    font: {
                                        size: 16,
                                        weight: 'bold',
                                        family: "Roboto",
                                        style: 'normal',
                                    },
                                }
                            },
                            x: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false,
                                    borderDash: [5, 5]
                                },
                                ticks: {
                                    display: true,
                                    color: '#f8f9fa',
                                    padding: 10,
                                    font: {
                                        size: 14,
                                        weight: 300,
                                        family: "Roboto",
                                        style: 'normal',
                                        lineHeight: 2
                                    },
                                },
                                title: {
                                    display: true,
                                    text: 'Hora',
                                    color: '#f8f9fa',
                                    font: {
                                        size: 16,
                                        weight: 'bold',
                                        family: "Roboto",
                                        style: 'normal',
                                    },
                                }
                            },
                        },
                    },
                });
            });

            @this.on('updatedSelectedDoor', () => {
                @this.call('updatedSelectedDoor', @this.selectedDoor);
            });
        });

  </script>
  @endpush
