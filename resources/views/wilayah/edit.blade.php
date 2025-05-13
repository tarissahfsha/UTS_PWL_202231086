@extends('layouts.admin')

@section('title', 'Edit Wilayah')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Wilayah</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('wilayah.update', $wilayah->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-3">
                    <label for="kode_wilayah">Kode Wilayah</label>
                    <input type="text" class="form-control @error('kode_wilayah') is-invalid @enderror" 
                           id="kode_wilayah" name="kode_wilayah" 
                           value="{{ old('kode_wilayah', $wilayah->kode_wilayah) }}" required>
                    @error('kode_wilayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="nama_wilayah">Nama Wilayah</label>
                    <input type="text" class="form-control @error('nama_wilayah') is-invalid @enderror" 
                           id="nama_wilayah" name="nama_wilayah" 
                           value="{{ old('nama_wilayah', $wilayah->nama_wilayah) }}" required>
                    @error('nama_wilayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="kecamatan">Kecamatan</label>
                    <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" 
                           id="kecamatan" name="kecamatan" 
                           value="{{ old('kecamatan', $wilayah->kecamatan) }}" required>
                    @error('kecamatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="kelurahan">Kelurahan</label>
                    <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" 
                           id="kelurahan" name="kelurahan" 
                           value="{{ old('kelurahan', $wilayah->kelurahan) }}" required>
                    @error('kelurahan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('wilayah.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection