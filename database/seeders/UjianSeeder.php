<?php

namespace Database\Seeders;
use App\Models\Ujian;
use Illuminate\Database\Seeder;

class UjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ujian::create([
            'name' => 'quiz matamatika'
        ]);
    }
}
