<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pemadaman Listrik PLN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .hero-section {
            background: linear-gradient(135deg,rgb(36, 50, 74) 0%,rgb(70, 89, 123) 100%);
            color: white;
            padding: 3rem 0;
        }

        .status-badge {
            font-size: 0.875rem;
            padding: 0.375rem 0.75rem;
            border-radius: 1rem;
        }

        .status-scheduled {
            background: #ffc107;
            color: #000;
        }

        .status-ongoing {
            background: #dc3545;
            color: #fff;
        }

        .status-completed {
            background: #28a745;
            color: #fff;
        }

        .status-cancelled {
            background: #6c757d;
            color: #fff;
        }

        .card-pemadaman {
            transition: transform 0.2s;
            cursor: pointer;
        }

        .card-pemadaman:hover {
            transform: translateY(-5px);
        }

        .countdown {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
        }

        .blink {
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0%, 50% {
                opacity: 1;
            }

            51%, 100% {
                opacity: 0;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/PLN_LOGO.png') }}" alt="PLN Logo" height="60">
                Informasi Pemadaman Listrik PLN
            </a>
            <a href="/login" class="btn btn-warning btn-sm">Admin Login</a>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container text-center">
            <h1 class="mb-3">Informasi Pemadaman Listrik</h1>
            <p class="lead">Cek jadwal pemadaman listrik di wilayah Anda</p>
        </div>
    </section>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Pilih Wilayah Anda</h5>
                        <form id="cekPemadamanForm">
                            <div class="mb-3">
                                <label for="wilayah" class="form-label">Wilayah</label>
                                <select class="form-select" id="wilayah" required>
                                    <option value="">-- Pilih Wilayah --</option>
                                    @foreach($wilayahs as $wilayah)
                                        <option value="{{ $wilayah->id }}">
                                            {{ $wilayah->kelurahan }}, {{ $wilayah->kecamatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-warning w-100">
                                <i class="bi bi-search"></i> Cek Pemadaman
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5" id="hasilPemadaman" style="display: none;">
            <div class="col-12">
                <h3 class="mb-4">Jadwal Pemadaman</h3>
                <div id="listPemadaman" class="row">
                    <!-- Data akan dimuat di sini via AJAX -->
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 PLN - Tarissa Nurhapsari Laksono</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cekPemadamanForm').on('submit', function(e) {
                e.preventDefault();
                
                const wilayahId = $('#wilayah').val();
                if (!wilayahId) {
                    alert('Pilih wilayah terlebih dahulu');
                    return;
                }

                // Show loading
                $('#listPemadaman').html('<div class="text-center"><div class="spinner-border text-warning" role="status"><span class="visually-hidden">Loading...</span></div></div>');
                $('#hasilPemadaman').show();

                // Fetch data
                $.get(`/cek-pemadaman/${wilayahId}`)
                    .done(function(data) {
                        let html = '';
                        
                        if (data.length === 0) {
                            html = '<div class="col-12"><div class="alert alert-success">Tidak ada jadwal pemadaman untuk wilayah ini.</div></div>';
                        } else {
                            data.forEach(function(pemadaman) {
                                const statusClass = `status-${pemadaman.status}`;
                                const statusLabel = {
                                    'scheduled': 'Terjadwal',
                                    'ongoing': 'Sedang Berlangsung',
                                    'completed': 'Selesai',
                                    'cancelled': 'Dibatalkan'
                                }[pemadaman.status];

                                const tanggal = new Date(pemadaman.tanggal);
                                const isToday = tanggal.toDateString() === new Date().toDateString();

                                html += `
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="card card-pemadaman h-100">
                                            <div class="card-body">
                                                <h6 class="card-title">${isToday ? '<span class="badge bg-info">Hari Ini</span>' : ''} ${tanggal.toLocaleDateString()}</h6>
                                                <span class="status-badge ${statusClass}">${statusLabel}</span>
                                                <p class="card-text">
                                                    <strong>Waktu:</strong> ${pemadaman.jam_mulai} - ${pemadaman.jam_selesai}<br>
                                                    <strong>Jenis:</strong> ${pemadaman.jenis_pemadaman}<br>
                                                    <strong>Alasan:</strong> ${pemadaman.alasan}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            });
                        }
                        $('#listPemadaman').html(html);
                    })
                    .fail(function() {
                        $('#listPemadaman').html('<div class="col-12"><div class="alert alert-danger">Terjadi kesalahan saat memuat data.</div></div>');
                    });
            });

            // Auto-refresh every 30 seconds for ongoing outages
            setInterval(function() {
                const wilayahId = $('#wilayah').val();
                if (wilayahId && $('#hasilPemadaman').is(':visible')) {
                    $('#cekPemadamanForm').submit();
                }
            }, 30000);
        });
    </script>
</body>

</html>
