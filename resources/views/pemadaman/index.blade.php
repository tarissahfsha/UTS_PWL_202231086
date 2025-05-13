@extends('layouts.admin')

@section('title', 'Data Pemadaman')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pemadaman</h1>
        <a href="{{ route('pemadaman.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pemadaman
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-light border-0 small" 
                           placeholder="Cari wilayah..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Wilayah</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Alasan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemadamans as $index => $pemadaman)
                            <tr>
                                <td>{{ $pemadamans->firstItem() + $index }}</td>
                                <td>{{ $pemadaman->wilayah->kelurahan }}, {{ $pemadaman->wilayah->kecamatan }}</td>
                                <td>{{ $pemadaman->tanggal->format('d/m/Y') }}</td>
                                <td>{{ substr($pemadaman->jam_mulai, 0, 5) }} - {{ substr($pemadaman->jam_selesai, 0, 5) }}</td>
                                <td>
                                    <!-- Jenis Pemadaman -->
                                    <span class="badge" style="background-color: {{ $pemadaman->jenis_pemadaman == 'terencana' ? '#17a2b8' : '#ffc107' }}; color: white;">
    {{ ucfirst($pemadaman->jenis_pemadaman) }}
</span>
                                </td>
                                <td>
    <!-- Status Pemadaman -->
<span class="badge" style="background-color: 
    {{ $pemadaman->status == 'completed' ? '#28a745' : 
       ($pemadaman->status == 'scheduled' ? '#ffc107' : 
       ($pemadaman->status == 'ongoing' ? '#dc3545' : '#6c757d')) }}; 
    color: white;">
    {{ $pemadaman->status_label }}
</span>

</td>

                                <td>{{ Str::limit($pemadaman->alasan, 50) }}</td>
                                <td>
                                    <a href="{{ route('pemadaman.show', $pemadaman->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('pemadaman.edit', $pemadaman->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" 
                                          action="{{ route('pemadaman.destroy', $pemadaman->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Data Pemadaman belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-end">
                {{ $pemadamans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
