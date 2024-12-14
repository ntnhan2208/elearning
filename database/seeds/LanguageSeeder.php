<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'name' => 'VietNamese',
            'slug' => 'vi',
            'code' => 'vi_VN',
            'flag' => 'vn',
            'status'=> 1,
            'default' => '1',
        ]);
    }
}
