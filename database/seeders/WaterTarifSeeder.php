<?php

namespace Database\Seeders;

use App\Models\WaterTarif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaterTarifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        WaterTarif::create([
            'tariff_name' => 'Tempat ibadah',
            'tariff_category' => 'I',
            't0_3_M3' => 1050,
            't__3_10_M3' => 1050,
            't__10_20_M3' => 1050,
            't__20_M3' => 1050,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Hidran',
            'tariff_category' => 'I',
            't0_3_M3' => 1050,
            't__3_10_M3' => 1050,
            't__10_20_M3' => 1050,
            't__20_M3' => 1050,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Asrama Badan Sosial',
            'tariff_category' => 'I',
            't0_3_M3' => 1050,
            't__3_10_M3' => 1050,
            't__10_20_M3' => 1050,
            't__20_M3' => 1050,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Rumah Yatim Piatu',
            'tariff_category' => 'I',
            't0_3_M3' => 1050,
            't__3_10_M3' => 1050,
            't__10_20_M3' => 1050,
            't__20_M3' => 1050,
        ]);

        // Kelompok II
        WaterTarif::create([
            'tariff_name' => 'Rumah Sakit Pemerintah',
            'tariff_category' => 'II',
            't0_3_M3' => 1050,
            't__3_10_M3' => 1050,
            't__10_20_M3' => 1050,
            't__20_M3' => 1575,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Rumah Tangga Sangat Sederhana',
            'tariff_category' => 'II',
            't0_3_M3' => 1050,
            't__3_10_M3' => 1050,
            't__10_20_M3' => 1050,
            't__20_M3' => 1575,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Rumah Susun Sangat Sederhana',
            'tariff_category' => 'II',
            't0_3_M3' => 1050,
            't__3_10_M3' => 1050,
            't__10_20_M3' => 1050,
            't__20_M3' => 1575,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Rumah Susun Sederhana Sewa',
            'tariff_category' => 'II',
            't0_3_M3' => 1050,
            't__3_10_M3' => 1050,
            't__10_20_M3' => 7450,
            't__20_M3' => 7450,
        ]);

        // Kelompok III A
        WaterTarif::create([
            'tariff_name' => 'Rumah Tangga Sederhana',
            'tariff_category' => 'III A',
            't0_3_M3' => 3550,
            't__3_10_M3' => 3550,
            't__10_20_M3' => 4700,
            't__20_M3' => 5500,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Rumah Susun Sederhana',
            'tariff_category' => 'III A',
            't0_3_M3' => 3550,
            't__3_10_M3' => 3550,
            't__10_20_M3' => 4700,
            't__20_M3' => 5500,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Stasiun Air dan Mobil Tangki',
            'tariff_category' => 'III A',
            't0_3_M3' => 3550,
            't__3_10_M3' => 3550,
            't__10_20_M3' => 4700,
            't__20_M3' => 5500,
        ]);

        // Kelompok III B
        WaterTarif::create([
            'tariff_name' => 'Rumah Tangga Menengah',
            'tariff_category' => 'III B',
            't0_3_M3' => 4900,
            't__3_10_M3' => 4900,
            't__10_20_M3' => 6000,
            't__20_M3' => 7450,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Rumah Susun Menengah',
            'tariff_category' => 'III B',
            't0_3_M3' => 4900,
            't__3_10_M3' => 4900,
            't__10_20_M3' => 6000,
            't__20_M3' => 7450,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Kios Warung',
            'tariff_category' => 'III B',
            't0_3_M3' => 4900,
            't__3_10_M3' => 4900,
            't__10_20_M3' => 6000,
            't__20_M3' => 7450,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Bengkel Kecil',
            'tariff_category' => 'III B',
            't0_3_M3' => 4900,
            't__3_10_M3' => 4900,
            't__10_20_M3' => 6000,
            't__20_M3' => 7450,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Usaha Kecil Dalam Rumah Tangga',
            'tariff_category' => 'III B',
            't0_3_M3' => 4900,
            't__3_10_M3' => 4900,
            't__10_20_M3' => 6000,
            't__20_M3' => 7450,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Lembaga Swasta Non Komersial',
            'tariff_category' => 'III B',
            't0_3_M3' => 4900,
            't__3_10_M3' => 4900,
            't__10_20_M3' => 6000,
            't__20_M3' => 7450,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Usaha Kecil',
            'tariff_category' => 'III B',
            't0_3_M3' => 4900,
            't__3_10_M3' => 4900,
            't__10_20_M3' => 6000,
            't__20_M3' => 7450,
        ]);

        // Kelompok IV A
        WaterTarif::create([
            'tariff_name' => 'Rumah Tangga di atas Menengah',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Kedutaan/Konsultan',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Kantor Instansi Pemerintah',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Kantor Perwakilan Negara Asing',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Lembaga Swasta Komersial',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Institusi Pendidikan/Kursus',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Instansi TNI',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Usaha Menengah',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Usaha Menengah Dalam Rumah Tangga',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Tempat Pangkas Rambut',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Penjahit',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Rumah Makan/Restoran',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Rumah Sakit Swasta/Poliklinik/Laboratorium',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Praktik Dokter',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Kantor Pengacara',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Hotel Melati/Non Bintang',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Rumah Susun di atas Menengah',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Bengkel Menengah',
            'tariff_category' => 'IV A',
            't0_3_M3' => 6825,
            't__3_10_M3' => 6825,
            't__10_20_M3' => 8150,
            't__20_M3' => 9800,
        ]);

        // Kelompok IV B
        WaterTarif::create([
            'tariff_name' => 'Hotel Berbintang 1, 2, 3/Motel/Cottage',
            'tariff_category' => 'IV B',
            't0_3_M3' => 12550,
            't__3_10_M3' => 12550,
            't__10_20_M3' => 12550,
            't__20_M3' => 12550,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Steambath/Salon Kecantikan',
            'tariff_category' => 'IV B',
            't0_3_M3' => 12550,
            't__3_10_M3' => 12550,
            't__10_20_M3' => 12550,
            't__20_M3' => 12550,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Night Club/Kafe',
            'tariff_category' => 'IV B',
            't0_3_M3' => 12550,
            't__3_10_M3' => 12550,
            't__10_20_M3' => 12550,
            't__20_M3' => 12550,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Bank',
            'tariff_category' => 'IV B',
            't0_3_M3' => 12550,
            't__3_10_M3' => 12550,
            't__10_20_M3' => 12550,
            't__20_M3' => 12550,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Service Station/Bengkel Besar',
            'tariff_category' => 'IV B',
            't0_3_M3' => 12550,
            't__3_10_M3' => 12550,
            't__10_20_M3' => 12550,
            't__20_M3' => 12550,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Perusahaan Perdagangan/Niaga/Ruko/Rukan',
            'tariff_category' => 'IV B',
            't0_3_M3' => 12550,
            't__3_10_M3' => 12550,
            't__10_20_M3' => 12550,
            't__20_M3' => 12550,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Hotel Berbintang',
            'tariff_category' => 'IV B',
            't0_3_M3' => 12550,
            't__3_10_M3' => 12550,
            't__10_20_M3' => 12550,
            't__20_M3' => 12550,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Gedung Bertingkat Tinggi, Apartemen/Kondominium',
            'tariff_category' => 'IV B',
            't0_3_M3' => 12550,
            't__3_10_M3' => 12550,
            't__10_20_M3' => 12550,
            't__20_M3' => 12550,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Pabrik Es',
            'tariff_category' => 'IV B',
            't0_3_M3' => 12550,
            't__3_10_M3' => 12550,
            't__10_20_M3' => 12550,
            't__20_M3' => 12550,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Pabrik Makanan/Minuman',
            'tariff_category' => 'IV B',
            't0_3_M3' => 12550,
            't__3_10_M3' => 12550,
            't__10_20_M3' => 12550,
            't__20_M3' => 12550,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Pabrik Kimia/Obat/Kosmetik',
            'tariff_category' => 'IV B',
            't0_3_M3' => 12550,
            't__3_10_M3' => 12550,
            't__10_20_M3' => 12550,
            't__20_M3' => 12550,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Pabrik/Gudang/Perindustrian',
            'tariff_category' => 'IV B',
            't0_3_M3' => 12550,
            't__3_10_M3' => 12550,
            't__10_20_M3' => 12550,
            't__20_M3' => 12550,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Pabrik Tekstil',
            'tariff_category' => 'IV B',
            't0_3_M3' => 12550,
            't__3_10_M3' => 12550,
            't__10_20_M3' => 12550,
            't__20_M3' => 12550,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Pergudangan/Industri Lainnya',
            'tariff_category' => 'IV B',
            't0_3_M3' => 12550,
            't__3_10_M3' => 12550,
            't__10_20_M3' => 12550,
            't__20_M3' => 12550,
        ]);
        WaterTarif::create([
            'tariff_name' => 'Tongkang Air',
            'tariff_category' => 'IV B',
            't0_3_M3' => 12550,
            't__3_10_M3' => 12550,
            't__10_20_M3' => 12550,
            't__20_M3' => 12550,
        ]);
    }
}
