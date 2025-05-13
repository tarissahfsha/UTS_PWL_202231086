@extends('layouts.admin')

@section('title', 'Detail Pemadaman')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pemadaman</h1>
        <div>
            <a href="{{ route('pemadaman.edit', $pemadaman->id) }}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('pemadaman.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pemadaman</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Status</th>
                            <td>
                                <span class="badge badge-{{ $pemadaman->status_color }} badge-lg">
                                    {{ $pemadaman->status_label }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Wilayah</th>
                            <td>{{ $pemadaman->wilayah->kelurahan }}, {{ $pemadaman->wilayah->kecamatan }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>{{ $pemadaman->tanggal->format('l, d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Waktu</th>
                            <td>{{ date('H:i', strtotime($pemadaman->jam_mulai)) }} - {{ date('H:i', strtotime($pemadaman->jam_selesai)) }}</td>
                        </tr>
                        <tr>
                            <th>Durasi</th>
                            <td>{{ $pemadaman->duration }}</td>
                        </tr>
                        <tr>
    <th>Jenis Pemadaman</th>
    <td>
        <span class="badge" style="background-color: {{ $pemadaman->jenis_pemadaman == 'terencana' ? '#17a2b8' : '#ffc107' }}; color: white;">
            {{ ucfirst($pemadaman->jenis_pemadaman) }}
        </span>
    </td>
</tr>

                    </table>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Alasan Pemadaman</h6>
                </div>
                <div class="card-body">
                    <p>{{ $pemadaman->alasan }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Tambahan</h6>
                </div>
                <div class="card-body">
                    <p><strong>Dibuat pada:</strong><br>
                    {{ $pemadaman->created_at->format('d/m/Y H:i') }}</p>
                    
                    <p><strong>Terakhir diupdate:</strong><br>
                    {{ $pemadaman->updated_at->format('d/m/Y H:i') }}</p>

                    @if($pemadaman->status == 'scheduled' && $pemadaman->tanggal->isFuture())
                        <div class="alert alert-warning">
                            <i class="fas fa-clock"></i> 
                            Pemadaman dalam {{ $pemadaman->tanggal->diffForHumans() }}
                        </div>
                    @elseif($pemadaman->status == 'ongoing')
                        <div class="alert alert-danger">
                            <i class="fas fa-bolt"></i> 
                            Pemadaman sedang berlangsung
                        </div>
                    @elseif($pemadaman->status == 'completed')
                        <div class="alert alert-success">
                            <i class="fas fa-check"></i> 
                            Pemadaman telah selesai
                        </div>
                    @endif
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('pemadaman.edit', $pemadaman->id) }}" class="btn btn-warning btn-block mb-2">
                        <i class="fas fa-edit"></i> Edit Pemadaman
                    </a>
                    
                    <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" 
                          action="{{ route('pemadaman.destroy', $pemadaman->id) }}" 
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="fas fa-trash"></i> Hapus Pemadaman
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection