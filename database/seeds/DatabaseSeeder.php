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
        DB::table('ham_kayit_tipler')->insert([['tip' => "Meşk"],['tip' => "Zikrullah"],['tip' => "Konser"],['tip' => "Diğer"]]);
    }
}
