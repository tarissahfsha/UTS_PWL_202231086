@extends('layouts.admin')

@section('title', 'Tambah Pemadaman')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Pemadaman</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('pemadaman.store') }}" method="POST">
                @csrf
                
                <div class="form-group mb-3">
                    <label for="wilayah_id">Wilayah</label>
                    <select class="form-control @error('wilayah_id') is-invalid @enderror" 
                            id="wilayah_id" name="wilayah_id" required>
                        <option value="">-- Pilih Wilayah --</option>
                        @foreach($wilayahs as $wilayah)
                            <option value="{{ $wilayah->id }}" {{ old('wilayah_id') == $wilayah->id ? 'selected' : '' }}>
                                {{ $wilayah->kelurahan }}, {{ $wilayah->kecamatan }} - {{ $wilayah->nama_wilayah }}
                            </option>
                        @endforeach
                    </select>
                    @error('wilayah_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                           id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" 
                           min="{{ date('Y-m-d') }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="jam_mulai">Jam Mulai</label>
                            <input type="time" class="form-control @error('jam_mulai') is-invalid @enderror" 
                                   id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}" required>
                            @error('jam_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="jam_selesai">Jam Selesai</label>
                            <input type="time" class="form-control @error('jam_selesai') is-invalid @enderror" 
                                   id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}" required>
                            @error('jam_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="jenis_pemadaman">Jenis Pemadaman</label>
                    <select class="form-control @error('jenis_pemadaman') is-invalid @enderror" 
                            id="jenis_pemadaman" name="jenis_pemadaman" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="terencana" {{ old('jenis_pemadaman') == 'terencana' ? 'selected' : '' }}>Terencana</option>
                        <option value="mendadak" {{ old('jenis_pemadaman') == 'mendadak' ? 'selected' : '' }}>Mendadak</option>
                    </select>
                    @error('jenis_pemadaman')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" 
                            id="status" name="status" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Terjadwal</option>
                        <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Sedang Berlangsung</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="alasan">Alasan Pemadaman</label>
                    <textarea class="form-control @error('alasan') is-invalid @enderror" 
                              id="alasan" name="alasan" rows="4" required>{{ old('alasan') }}</textarea>
                    @error('alasan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('pemadaman.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Set nilai default tanggal ke hari ini
    document.addEventListener('DOMContentLoaded', function() {
        // Mendapatkan tanggal hari ini dalam format YYYY-MM-DD
        const today = new Date().toISOString().split('T')[0];
        
        // Mengatur nilai default untuk tanggal jika belum diisi
        const tanggalInput = document.getElementById('tanggal');
        if (!tanggalInput.value) {
            tanggalInput.value = today;
        }
        
        // Membatasi tanggal minimum yang bisa dipilih
        tanggalInput.setAttribute('min', today);
    });

    // Validasi tanggal saat berubah
    document.getElementById('tanggal').addEventListener('change', function() {
        const today = new Date().toISOString().split('T')[0];
        if (this.value < today) {
            alert('Tanggal harus hari ini atau setelahnya');
            this.value = today;
        }
    });

    // Validasi jam selesai harus setelah jam mulai
    document.getElementById('jam_selesai').addEventListener('change', function() {
        var jamMulai = document.getElementById('jam_mulai').value;
        var jamSelesai = this.value;
        
        if (jamMulai && jamSelesai && jamSelesai <= jamMulai) {
            alert('Jam selesai harus setelah jam mulai');
            this.value = '';
        }
    });
    
    // Juga validasi jam mulai jika dirubah (untuk memastikan jam selesai tetap valid)
    document.getElementById('jam_mulai').addEventListener('change', function() {
        var jamMulai = this.value;
        var jamSelesai = document.getElementById('jam_selesai').value;
        
        if (jamMulai && jamSelesai && jamSelesai <= jamMulai) {
            alert('Jam selesai harus setelah jam mulai');
            document.getElementById('jam_selesai').value = '';
        }
    });
</script>
@endsection