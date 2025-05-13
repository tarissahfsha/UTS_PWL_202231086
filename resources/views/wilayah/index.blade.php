@extends('layouts.admin')

@section('title', 'Data Wilayah')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Wilayah</h1>
        <a href="{{ route('wilayah.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Wilayah
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
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
                            <th>Kode Wilayah</th>
                            <th>Nama Wilayah</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Jumlah Pemadaman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($wilayahs as $index => $wilayah)
                            <tr>
                                <td>{{ $wilayahs->firstItem() + $index }}</td>
                                <td>{{ $wilayah->kode_wilayah }}</td>
                                <td>{{ $wilayah->nama_wilayah }}</td>
                                <td>{{ $wilayah->kecamatan }}</td>
                                <td>{{ $wilayah->kelurahan }}</td>
                               <td>
    <span class="badge" style="background-color: {{ $wilayah->pemadamans->count() > 0 ? '#17a2b8' : '#ffc107' }}; color: white;">
        {{ $wilayah->pemadamans->count() }}
    </span>
</td>

                                <td>
                                    <a href="{{ route('wilayah.show', $wilayah->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('wilayah.edit', $wilayah->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" 
                                          action="{{ route('wilayah.destroy', $wilayah->id) }}" 
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
                                <td colspan="7" class="text-center">Data Wilayah belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
 <div class="d-flex justify-content-end">
                 {{ $wilayahs->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
