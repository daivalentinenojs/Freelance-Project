<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(KaryawansTableSeeder::class);
        $this->call(PembelisTableSeeder::class);
        $this->call(PemasoksTableSeeder::class);
        $this->call(KategorisTableSeeder::class);
        $this->call(BarangsTableSeeder::class);
        $this->call(NotaJualsTableSeeder::class);
        $this->call(BarangCatatNotaJualsTableSeeder::class);
        $this->call(NotaBelisTableSeeder::class);
        $this->call(BarangCatatNotaBelisTableSeeder::class);
        $this->call(StokOpnamesTableSeeder::class);
        $this->call(BarangCatatStokOpnamesTableSeeder::class);
        $this->call(ReturJualsTableSeeder::class);
        $this->call(BarangCatatReturJualsTableSeeder::class);
        $this->call(ReturBelisTableSeeder::class);
        $this->call(BarangCatatReturBelisTableSeeder::class);
        $this->call(PengeluaransTableSeeder::class);
    }
}
