<?php

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
        // $this->call(UsersTableSeeder::class);
        factory(App\Models\Brand::class, 6)->create();
        factory(App\Models\Category::class, 6)->create();
        factory(App\Models\Product::class, 50)->create();
    }
}
