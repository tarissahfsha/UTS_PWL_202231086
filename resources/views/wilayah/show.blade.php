@extends('layouts.admin')

@section('title', 'Detail Wilayah')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Wilayah</h1>
        <div>
            <a href="{{ route('wilayah.edit', $wilayah->id) }}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('wilayah.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Wilayah</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Kode Wilayah</th>
                            <td>{{ $wilayah->kode_wilayah }}</td>
                        </tr>
                        <tr>
                            <th>Nama Wilayah</th>
                            <td>{{ $wilayah->nama_wilayah }}</td>
                        </tr>
                        <tr>
                            <th>Kecamatan</th>
                            <td>{{ $wilayah->kecamatan }}</td>
                        </tr>
                        <tr>
                            <th>Kelurahan</th>
                            <td>{{ $wilayah->kelurahan }}</td>
                        </tr>
                        <tr>
                            <th>Total Pemadaman</th>
                            <td>
                                <span class="badge badge-info">{{ $wilayah->pemadamans->count() }} kali</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Pemadaman Aktif</th>
                            <td>
                                <span class="badge badge-danger">{{ $wilayah->active_pemadaman_count }} kali</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Pemadaman</h6>
                </div>
                <div class="card-body">
                    <canvas id="pieChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Pemadaman</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Alasan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($wilayah->pemadamans()->latest()->get() as $index => $pemadaman)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pemadaman->tanggal->format('d/m/Y') }}</td>
                                <td>{{ substr($pemadaman->jam_mulai, 0, 5) }} - {{ substr($pemadaman->jam_selesai, 0, 5) }}</td>
                                <td>
                                    <span class="badge badge-{{ $pemadaman->jenis_pemadaman == 'terencana' ? 'info' : 'warning' }}">
                                        {{ ucfirst($pemadaman->jenis_pemadaman) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $pemadaman->status_color }}">
                                        {{ $pemadaman->status_label }}
                                    </span>
                                </td>
                                <td>{{ Str::limit($pemadaman->alasan, 30) }}</td>
                                <td>
                                    <a href="{{ route('pemadaman.show', $pemadaman->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada riwayat pemadaman</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pie Chart untuk jenis pemadaman
    const ctx = document.getElementById('pieChart').getContext('2d');
    
    const terencana = {{ $wilayah->pemadamans->where('jenis_pemadaman', 'terencana')->count() }};
    const mendadak = {{ $wilayah->pemadamans->where('jenis_pemadaman', 'mendadak')->count() }};
    
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Terencana', 'Mendadak'],
            datasets: [{
                data: [terencana, mendadak],
                backgroundColor: ['#4e73df', '#f6c23e'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection