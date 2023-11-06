<?php

namespace Database\Seeders;

use App\Models\Master\AsuransiProperti\KonstruksiProperti;
use App\Models\Master\AsuransiProperti\PerlindunganProperti;
use App\Models\Master\DataAsuransi\IntervalPembayaran;
use App\Models\Master\DataAsuransi\PerusahaanAsuransi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProvinceTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(DistrictTableSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(MenuFlowSeeder::class);
        $this->call(StructSeeder::class);
        $this->call(UserSeeder::class);

        // Mobil
        $this->call(MerkMobilSeeder::class);
        $this->call(SeriMobilSeeder::class);
        $this->call(TahunMobilSeeder::class);
        $this->call(TipeMobilSeeder::class);
        $this->call(KodePlatSeeder::class);

        // Kendaraan
        $this->call(TipeKendaraanSeeder::class);
        $this->call(TipePemakaianSeeder::class);
        $this->call(KondisiKendaraanSeeder::class);
        $this->call(LuasPertanggunganSeeder::class);

        // Asuransi
        $this->call(IntervalPembayaranSeeder::class);
        $this->call(PerusahaanAsuransiSeeder::class);
        $this->call(KategoriAsuransiSeeder::class);

        // Asuransi Properti
        $this->call(OkupasiSeeder::class);
        $this->call(PerlindunganPropertiSeeder::class);
        $this->call(KonstruksiPropertiSeeder::class);

        // Umum
        $this->call(PertanggunganTambahanSeeder::class);
        $this->call(RiderSeeder::class);
        
        // Asuransi Mobil
        $this->call(AsuransiMobilSeeder::class);

    }
}
