<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call('PostsTableSeeder');
        $this->call('TagTableSeeder');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Model::reguard();
    }
}
