<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = Setting::create([
            'id_setting' => '1',
            'no_akun' => '501',
            'nama_transaksi' => 'Retur',
        ]);

        $setting = Setting::create([
            'id_setting' => '2',
            'no_akun' => '500',
            'nama_transaksi' => 'Pembelian',
        ]);

        $setting = Setting::create([
            'id_setting' => '3',
            'no_akun' => '101',
            'nama_transaksi' => 'Kas',
        ]);
    }
}
