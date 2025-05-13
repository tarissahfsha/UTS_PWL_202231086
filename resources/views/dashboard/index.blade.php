@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
    
    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Wilayah</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalWilayah }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pemadaman Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pemadamanHariIni }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bolt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pemadaman Bulan Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pemadamanBulanIni }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Sedang Berlangsung</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pemadamanAktif }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts - Combined Section with No Spacing -->
    <div class="row">
        <!-- Trend & Top Wilayah Charts (Enhanced styling) -->
        <div class="col-xl-8 col-lg-7">
            <!-- Trend Pemadaman 6 Bulan Terakhir -->
            <div class="card shadow chart-container-no-spacing card-with-hover">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between gradient-header">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-chart-line mr-2"></i> Trend Pemadaman 6 Bulan Terakhir
                    </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body chart-body-no-spacing">
                    <div class="chart-area chart-with-shadow">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Top 10 Wilayah Pemadaman (Directly attached to above) -->
            <div class="card shadow chart-container-attached card-with-hover">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between gradient-header-secondary">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-map-marker-alt mr-2"></i> Top 10 Wilayah Pemadaman
                    </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-bar chart-with-shadow">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart & Upcoming -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4 card-with-hover">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between gradient-header-alt">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-chart-pie mr-2"></i> Jenis Pemadaman
                    </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2 chart-with-shadow">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4 card-with-hover">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between gradient-header-alt2">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-calendar-alt mr-2"></i> Pemadaman Mendatang
                    </h6>
                </div>
                <div class="card-body">
                    @if($upcomingPemadaman->count() > 0)
                        @foreach($upcomingPemadaman as $pemadaman)
                            <div class="mb-3 pb-3 border-bottom upcoming-item">
                                <div class="small text-gray-500">
                                    <i class="far fa-clock mr-1"></i> {{ $pemadaman->tanggal->format('d M Y') }} • {{ $pemadaman->waktu_format }}
                                </div>
                                <div class="font-weight-bold">{{ $pemadaman->wilayah->kelurahan }}</div>
                                <div class="small">{{ $pemadaman->alasan }}</div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">Tidak ada pemadaman terjadwal</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
/* CSS untuk menghilangkan spacing antar chart */
.chart-container-no-spacing {
    margin-bottom: 0 !important;
    border-radius: 10px 10px 0 0 !important;
    overflow: hidden;
    transition: all 0.3s ease;
}

.chart-container-attached {
    margin-top: 0 !important;
    border-top: none !important;
    border-top-left-radius: 0 !important;
    border-top-right-radius: 0 !important;
    border-bottom-left-radius: 10px !important;
    border-bottom-right-radius: 10px !important;
    overflow: hidden;
    transition: all 0.3s ease;
}

.chart-container-no-spacing .card-body {
    padding-bottom: 5px !important;
}

.chart-container-attached .card-header {
    border-top: 1px solid rgba(227, 230, 240, 0.5);
}

/* Ensure charts have appropriate heights */
.chart-area canvas {
    height: 250px !important;
}

.chart-bar canvas {
    height: 300px !important;
}

/* Enhanced styling for cards */
.card-with-hover {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1) !important;
    transition: all 0.3s ease !important;
    border-radius: 10px !important;
    overflow: hidden;
}

.card-with-hover:hover {
    box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.2) !important;
    transform: translateY(-2px);
}

.gradient-header {
    background: linear-gradient(90deg, rgba(78, 115, 223, 0.9) 0%, rgba(78, 115, 223, 0.7) 100%) !important;
    color: white !important;
    border-bottom: none !important;
}

.gradient-header-secondary {
    background: linear-gradient(90deg, rgba(28, 70, 168, 0.9) 0%, rgba(78, 115, 223, 0.8) 100%) !important;
    color: white !important;
    border-bottom: none !important;
}

.gradient-header-alt {
    background: linear-gradient(90deg, rgba(246, 194, 62, 0.9) 0%, rgba(246, 194, 62, 0.7) 100%) !important;
    color: white !important;
    border-bottom: none !important;
}

.gradient-header-alt2 {
    background: linear-gradient(90deg, rgba(231, 74, 59, 0.9) 0%, rgba(231, 74, 59, 0.7) 100%) !important;
    color: white !important;
    border-bottom: none !important;
}

.chart-with-shadow {
    padding: 10px;
    border-radius: 8px;
    background-color: rgba(255, 255, 255, 0.8);
    box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.05);
}

.upcoming-item {
    padding: 10px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.upcoming-item:hover {
    background-color: rgba(0, 0, 0, 0.03);
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Line Chart - Trend Pemadaman 6 Bulan Terakhir (Ditingkatkan)
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    
    // Buat gradient untuk area di bawah line chart
    const lineGradient = lineCtx.createLinearGradient(0, 0, 0, 400);
    lineGradient.addColorStop(0, 'rgba(78, 115, 223, 0.5)');
    lineGradient.addColorStop(1, 'rgba(78, 115, 223, 0.0)');
    
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartData->pluck('month')) !!},
            datasets: [{
                label: 'Jumlah Pemadaman',
                data: {!! json_encode($chartData->pluck('total')) !!},
                borderColor: 'rgb(78, 115, 223)',
                backgroundColor: lineGradient,
                borderWidth: 4,
                pointRadius: 6,
                pointBackgroundColor: '#fff',
                pointBorderColor: 'rgb(78, 115, 223)',
                pointBorderWidth: 3,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(78, 115, 223)',
                pointHoverBorderWidth: 4,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 2000,
                easing: 'easeOutQuart'
            },
            interaction: {
                mode: 'index',
                intersect: false
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)',
                        drawBorder: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: 'bold'
                        },
                        padding: 10,
                        color: '#666'
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Kejadian',
                        font: {
                            size: 14,
                            weight: 'bold'
                        },
                        color: '#666'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: 'bold'
                        },
                        padding: 10,
                        color: '#666'
                    },
                    title: {
                        display: true,
                        text: 'Bulan',
                        font: {
                            size: 14,
                            weight: 'bold'
                        },
                        color: '#666',
                        padding: {
                            top: 20
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 13,
                            weight: 'bold'
                        },
                        padding: 15,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    titleAlign: 'center',
                    titleMarginBottom: 10,
                    bodyFont: {
                        size: 13
                    },
                    padding: 12,
                    cornerRadius: 6,
                    displayColors: false,
                    callbacks: {
                        title: function(tooltipItems) {
                            return tooltipItems[0].label;
                        },
                        label: function(context) {
                            return 'Jumlah Pemadaman: ' + context.raw;
                        }
                    }
                }
            }
        }
    });

    // Pie Chart - Jenis Pemadaman (Ditingkatkan)
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($jenisPemadaman->pluck('jenis')) !!},
            datasets: [{
                data: {!! json_encode($jenisPemadaman->pluck('total')) !!},
                backgroundColor: ['rgba(246, 194, 62, 0.9)', 'rgba(231, 74, 59, 0.9)'],
                borderColor: '#ffffff',
                borderWidth: 3,
                hoverBackgroundColor: ['rgba(246, 194, 62, 1)', 'rgba(231, 74, 59, 1)'],
                hoverBorderColor: '#ffffff',
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            animation: {
                animateRotate: true,
                animateScale: true,
                duration: 1500
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        font: {
                            size: 12,
                            weight: 'bold'
                        },
                        generateLabels: function(chart) {
                            // Customize legend labels
                            const data = chart.data;
                            if (data.labels.length && data.datasets.length) {
                                return data.labels.map(function(label, i) {
                                    const value = data.datasets[0].data[i];
                                    const total = data.datasets[0].data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return {
                                        text: `${label}: ${value} (${percentage}%)`,
                                        fillStyle: data.datasets[0].backgroundColor[i],
                                        strokeStyle: '#fff',
                                        lineWidth: 2,
                                        index: i
                                    };
                                });
                            }
                            return [];
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleFont: {
                        size: 13,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 12,
                        weight: 'bold'
                    },
                    padding: 12,
                    cornerRadius: 6,
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Bar Chart - Top 10 Wilayah Pemadaman (Ditingkatkan)
    const barCtx = document.getElementById('barChart').getContext('2d');
    
    // Buat array gradient untuk setiap bar
    function generateBarGradients(ctx, count) {
        const gradients = [];
        for (let i = 0; i < count; i++) {
            // Buat warna gradient yang lebih variatif berdasarkan posisi
            const intensity = 0.9 - (i * 0.03); // Semakin tinggi posisi, semakin gelap warnanya
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, `rgba(78, 115, 223, ${intensity})`);
            gradient.addColorStop(1, `rgba(78, 115, 223, ${intensity * 0.5})`);
            gradients.push(gradient);
        }
        return gradients;
    }

    // Dapatkan jumlah wilayah
    const wilayahCount = {!! json_encode($pemadamanPerWilayah->count()) !!};
    const barGradients = generateBarGradients(barCtx, wilayahCount);

    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($pemadamanPerWilayah->pluck('wilayah')) !!},
            datasets: [{
                label: 'Jumlah Pemadaman',
                data: {!! json_encode($pemadamanPerWilayah->pluck('total')) !!},
                backgroundColor: barGradients,
                borderRadius: 6,
                borderWidth: 0,
                borderSkipped: false,
                hoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                barPercentage: 0.8,
                categoryPercentage: 0.85
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                delay: function(context) {
                    return context.dataIndex * 100;
                },
                duration: 1000,
                easing: 'easeOutQuart'
            },
            scales: {
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 11,
                            weight: 'bold'
                        },
                        color: '#666'
                    },
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Wilayah',
                        font: {
                            size: 14,
                            weight: 'bold'
                        },
                        color: '#666',
                        padding: {
                            top: 20
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)',
                        drawBorder: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        font: {
                            size: 11,
                            weight: 'bold'
                        },
                        color: '#666',
                        padding: 10,
                        callback: function(value) {
                            if (Math.floor(value) === value) {
                                return value;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Kejadian',
                        font: {
                            size: 14,
                            weight: 'bold'
                        },
                        color: '#666'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    titleAlign: 'center',
                    titleMarginBottom: 8,
                    bodyFont: {
                        size: 13
                    },
                    padding: 12,
                    cornerRadius: 6,
                    displayColors: false,
                    callbacks: {
                        title: function(tooltipItems) {
                            return tooltipItems[0].label;
                        },
                        label: function(context) {
                            return 'Jumlah Pemadaman: ' + context.raw;
                        },
                        afterLabel: function(context) {
                            const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((context.raw / total) * 100);
                            return `Persentase: ${percentage}% dari total`;
                        }
                    }
                }
            }
        }
    });
</script>
@endsection