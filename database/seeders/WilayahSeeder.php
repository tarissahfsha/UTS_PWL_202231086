<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wilayah;

class WilayahSeeder extends Seeder
{
    public function run()
    {
        // Jakarta
        Wilayah::create([
            'nama_wilayah' => 'Jakarta Pusat',
            'kode_wilayah' => 'JP001',
            'kecamatan' => 'Menteng',
            'kelurahan' => 'Cikini',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Jakarta Pusat',
            'kode_wilayah' => 'JP002',
            'kecamatan' => 'Tanah Abang',
            'kelurahan' => 'Kebon Melati',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Jakarta Pusat',
            'kode_wilayah' => 'JP003',
            'kecamatan' => 'Gambir',
            'kelurahan' => 'Cideng',
        ]);

        Wilayah::create([
            'nama_wilayah' => 'Jakarta Barat',
            'kode_wilayah' => 'JB001',
            'kecamatan' => 'Tambora',
            'kelurahan' => 'Jembatan Lima',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Jakarta Barat',
            'kode_wilayah' => 'JB002',
            'kecamatan' => 'Grogol Petamburan',
            'kelurahan' => 'Jelambar',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Jakarta Barat',
            'kode_wilayah' => 'JB003',
            'kecamatan' => 'Kebon Jeruk',
            'kelurahan' => 'Kedoya Utara',
        ]);

        Wilayah::create([
            'nama_wilayah' => 'Jakarta Selatan',
            'kode_wilayah' => 'JS001',
            'kecamatan' => 'Kebayoran Baru',
            'kelurahan' => 'Senayan',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Jakarta Selatan',
            'kode_wilayah' => 'JS002',
            'kecamatan' => 'Pancoran',
            'kelurahan' => 'Pengadegan',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Jakarta Selatan',
            'kode_wilayah' => 'JS003',
            'kecamatan' => 'Tebet',
            'kelurahan' => 'Tebet Timur',
        ]);

        Wilayah::create([
            'nama_wilayah' => 'Jakarta Timur',
            'kode_wilayah' => 'JT001',
            'kecamatan' => 'Matraman',
            'kelurahan' => 'Pisangan Baru',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Jakarta Timur',
            'kode_wilayah' => 'JT002',
            'kecamatan' => 'Pulo Gadung',
            'kelurahan' => 'Rawamangun',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Jakarta Timur',
            'kode_wilayah' => 'JT003',
            'kecamatan' => 'Duren Sawit',
            'kelurahan' => 'Pondok Bambu',
        ]);

        Wilayah::create([
            'nama_wilayah' => 'Jakarta Utara',
            'kode_wilayah' => 'JU001',
            'kecamatan' => 'Tanjung Priok',
            'kelurahan' => 'Sunter Jaya',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Jakarta Utara',
            'kode_wilayah' => 'JU002',
            'kecamatan' => 'Koja',
            'kelurahan' => 'Rawa Badak',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Jakarta Utara',
            'kode_wilayah' => 'JU003',
            'kecamatan' => 'Kelapa Gading',
            'kelurahan' => 'Kelapa Gading Barat',
        ]);

        // Jawa Barat
        Wilayah::create([
            'nama_wilayah' => 'Bandung',
            'kode_wilayah' => 'BDG001',
            'kecamatan' => 'Andir',
            'kelurahan' => 'Cigondewah',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Bandung',
            'kode_wilayah' => 'BDG002',
            'kecamatan' => 'Cicendo',
            'kelurahan' => 'Pasirkaliki',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Bogor',
            'kode_wilayah' => 'BGR001',
            'kecamatan' => 'Bogor Tengah',
            'kelurahan' => 'Babakan',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Bogor',
            'kode_wilayah' => 'BGR002',
            'kecamatan' => 'Bogor Utara',
            'kelurahan' => 'Ciparigi',
        ]);

        Wilayah::create([
            'nama_wilayah' => 'Depok',
            'kode_wilayah' => 'DPK001',
            'kecamatan' => 'Cimanggis',
            'kelurahan' => 'Mekarsari',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Depok',
            'kode_wilayah' => 'DPK002',
            'kecamatan' => 'Beji',
            'kelurahan' => 'Kemiri Muka',
        ]);

        // Jawa Tengah
        Wilayah::create([
            'nama_wilayah' => 'Semarang',
            'kode_wilayah' => 'SMG001',
            'kecamatan' => 'Semarang Tengah',
            'kelurahan' => 'Tugurejo',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Semarang',
            'kode_wilayah' => 'SMG002',
            'kecamatan' => 'Semarang Barat',
            'kelurahan' => 'Kembangarum',
        ]);

        Wilayah::create([
            'nama_wilayah' => 'Solo',
            'kode_wilayah' => 'SOL001',
            'kecamatan' => 'Jebres',
            'kelurahan' => 'Mojosongo',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Solo',
            'kode_wilayah' => 'SOL002',
            'kecamatan' => 'Banjarsari',
            'kelurahan' => 'Mangkubumen',
        ]);

        // Yogyakarta
        Wilayah::create([
            'nama_wilayah' => 'Yogyakarta',
            'kode_wilayah' => 'YK001',
            'kecamatan' => 'Gondokusuman',
            'kelurahan' => 'Jogoyudan',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Yogyakarta',
            'kode_wilayah' => 'YK002',
            'kecamatan' => 'Umbulharjo',
            'kelurahan' => 'Pandeyan',
        ]);

        // Jawa Timur
        Wilayah::create([
            'nama_wilayah' => 'Surabaya',
            'kode_wilayah' => 'SBY001',
            'kecamatan' => 'Gubeng',
            'kelurahan' => 'Bubutan',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Surabaya',
            'kode_wilayah' => 'SBY002',
            'kecamatan' => 'Tegalsari',
            'kelurahan' => 'Keputran',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Surabaya',
            'kode_wilayah' => 'SBY003',
            'kecamatan' => 'Wonokromo',
            'kelurahan' => 'Darmo',
        ]);

        Wilayah::create([
            'nama_wilayah' => 'Malang',
            'kode_wilayah' => 'MLG001',
            'kecamatan' => 'Klojen',
            'kelurahan' => 'Kauman',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Malang',
            'kode_wilayah' => 'MLG002',
            'kecamatan' => 'Lowokwaru',
            'kelurahan' => 'Dinoyo',
        ]);

        // Banten
        Wilayah::create([
            'nama_wilayah' => 'Tangerang',
            'kode_wilayah' => 'TNG001',
            'kecamatan' => 'Ciledug',
            'kelurahan' => 'Sudimara Barat',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Tangerang',
            'kode_wilayah' => 'TNG002',
            'kecamatan' => 'Karawaci',
            'kelurahan' => 'Cimone',
        ]);

        // Sumatra
        Wilayah::create([
            'nama_wilayah' => 'Medan',
            'kode_wilayah' => 'MDN001',
            'kecamatan' => 'Medan Kota',
            'kelurahan' => 'Teladan Barat',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Medan',
            'kode_wilayah' => 'MDN002',
            'kecamatan' => 'Medan Petisah',
            'kelurahan' => 'Petisah Tengah',
        ]);

        Wilayah::create([
            'nama_wilayah' => 'Palembang',
            'kode_wilayah' => 'PLB001',
            'kecamatan' => 'Ilir Barat I',
            'kelurahan' => 'Bukit Lama',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Palembang',
            'kode_wilayah' => 'PLB002',
            'kecamatan' => 'Ilir Timur II',
            'kelurahan' => '3 Ilir',
        ]);

        // Kalimantan
        Wilayah::create([
            'nama_wilayah' => 'Pontianak',
            'kode_wilayah' => 'PTK001',
            'kecamatan' => 'Pontianak Selatan',
            'kelurahan' => 'Benua Melayu Darat',
        ]);

        Wilayah::create([
            'nama_wilayah' => 'Banjarmasin',
            'kode_wilayah' => 'BJM001',
            'kecamatan' => 'Banjarmasin Tengah',
            'kelurahan' => 'Teluk Dalam',
        ]);

        // Sulawesi
        Wilayah::create([
            'nama_wilayah' => 'Makassar',
            'kode_wilayah' => 'MKS001',
            'kecamatan' => 'Rappocini',
            'kelurahan' => 'Buakana',
        ]);

        Wilayah::create([
            'nama_wilayah' => 'Manado',
            'kode_wilayah' => 'MND001',
            'kecamatan' => 'Wenang',
            'kelurahan' => 'Wenang Selatan',
        ]);

        // Bali
        Wilayah::create([
            'nama_wilayah' => 'Denpasar',
            'kode_wilayah' => 'DPS001',
            'kecamatan' => 'Denpasar Barat',
            'kelurahan' => 'Dauh Puri',
        ]);
        
        Wilayah::create([
            'nama_wilayah' => 'Denpasar',
            'kode_wilayah' => 'DPS002',
            'kecamatan' => 'Denpasar Timur',
            'kelurahan' => 'Kesiman',
        ]);

        // Papua
        Wilayah::create([
            'nama_wilayah' => 'Jayapura',
            'kode_wilayah' => 'JPR001',
            'kecamatan' => 'Abepura',
            'kelurahan' => 'Wahno',
        ]);
    }
}