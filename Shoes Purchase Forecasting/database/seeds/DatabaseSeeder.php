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
        $this->call(UsersTableSeeder::class);
        $this->call(KaryawansTableSeeder::class);
        $this->call(PembelisTableSeeder::class);
        $this->call(PemasoksTableSeeder::class);
        $this->call(TeleponsTableSeeder::class);
        $this->call(JabatansTableSeeder::class);
        $this->call(KategorisTableSeeder::class);
        $this->call(BarangsTableSeeder::class);
        $this->call(NotaJualsTableSeeder::class);
        $this->call(BarangCatatNotaJualsTableSeeder::class);
        $this->call(ProfitsTableSeeder::class);
        $this->call(DiskonsTableSeeder::class);
        $this->call(NotaBelisTableSeeder::class);
        $this->call(BarangCatatNotaBelisTableSeeder::class);
        $this->call(LaporanLabaRugisTableSeeder::class);
        $this->call(PemasokJualBarangsTableSeeder::class);
        
    }
}
