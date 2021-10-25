<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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
        User::create([
            'is_admin' => true,
            'firstname' => 'Rizal',
            'lastname' => 'Grandonk',
            'email' => 'grandonk.cm@gmail.com',
            'password' => bcrypt('66666666'),
            'address' => 'Dawarblandong',
            'province_id' => '11',
            'province' => 'Jawa Timur',
            'city_id' => '133',
            'city' => 'Kabupaten Gresik',
            'postal_code' => '61354',
            'phone' => '081234567890'
        ]);

        Category::create([
            'name' => 'Sayur',
            'slug' => 'sayur'
        ]);
        Category::create([
            'name' => 'Buah',
            'slug' => 'buah'
        ]);

        Product::create([
            'name' => "Sawi",
            'category_id' => 1,
            'slug' => 'sawi',
            'price' => 10000,
            'detail' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint asperiores quod ullam sapiente ducimus ab veritatis natus doloribus praesentium, tempora repellat voluptatem! Nostrum illum ad eaque quis architecto, incidunt voluptatum.Eum, amet? Necessitatibus, minima atque? Dolor accusantium provident vitae adipisci velit dicta porro mollitia cumque consequatur in recusandae nemo, quisquam odit tempora delectus, dolore maxime doloribus suscipit odio asperiores molestiae!',
        ]);
        Product::create([
            'name' => "Kubis",
            'category_id' => 1,
            'slug' => 'kubis',
            'price' => 12000,
            'detail' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint asperiores quod ullam sapiente ducimus ab veritatis natus doloribus praesentium, tempora repellat voluptatem! Nostrum illum ad eaque quis architecto, incidunt voluptatum.Eum, amet? Necessitatibus, minima atque? Dolor accusantium provident vitae adipisci velit dicta porro mollitia cumque consequatur in recusandae nemo, quisquam odit tempora delectus, dolore maxime doloribus suscipit odio asperiores molestiae!',
        ]);
        Product::create([
            'name' => "Apel",
            'category_id' => 2,
            'slug' => 'apel',
            'price' => 17000,
            'detail' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint asperiores quod ullam sapiente ducimus ab veritatis natus doloribus praesentium, tempora repellat voluptatem! Nostrum illum ad eaque quis architecto, incidunt voluptatum.Eum, amet? Necessitatibus, minima atque? Dolor accusantium provident vitae adipisci velit dicta porro mollitia cumque consequatur in recusandae nemo, quisquam odit tempora delectus, dolore maxime doloribus suscipit odio asperiores molestiae!',
        ]);
        Product::create([
            'name' => "Jeruk",
            'category_id' => 2,
            'slug' => 'jeruk',
            'price' => 15000,
            'detail' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint asperiores quod ullam sapiente ducimus ab veritatis natus doloribus praesentium, tempora repellat voluptatem! Nostrum illum ad eaque quis architecto, incidunt voluptatum.Eum, amet? Necessitatibus, minima atque? Dolor accusantium provident vitae adipisci velit dicta porro mollitia cumque consequatur in recusandae nemo, quisquam odit tempora delectus, dolore maxime doloribus suscipit odio asperiores molestiae!',
        ]);
    }
}
