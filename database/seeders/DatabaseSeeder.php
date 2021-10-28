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
            'firstname' => 'Tri',
            'lastname' => 'Kurniawan',
            'email' => 'trikurniawan02091998@gmail.com',
            'password' => bcrypt('Trikurniawan1927'),
            'address' => 'UNTAG',
            'province_id' => '11',
            'province' => 'Jawa Timur',
            'city_id' => '444',
            'city' => 'Kota Surabaya',
            'postal_code' => '66666',
            'phone' => '081234567890'
        ]);

        Category::create([
            'name' => 'Fish',
            'slug' => 'fish'
        ]);
        Category::create([
            'name' => 'Lobster',
            'slug' => 'lobster'
        ]);

        Product::create([
            'name' => "Lizard Fish",
            'category_id' => 1,
            'slug' => 'lizard-fish',
            'price' => 40000,
            'detail' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint asperiores quod ullam sapiente ducimus ab veritatis natus doloribus praesentium, tempora repellat voluptatem! Nostrum illum ad eaque quis architecto, incidunt voluptatum.Eum, amet? Necessitatibus, minima atque? Dolor accusantium provident vitae adipisci velit dicta porro mollitia cumque consequatur in recusandae nemo, quisquam odit tempora delectus, dolore maxime doloribus suscipit odio asperiores molestiae!',
        ]);
        Product::create([
            'name' => "Ribbon Fish",
            'category_id' => 1,
            'slug' => 'ribbon-fish',
            'price' => 38000,
            'detail' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint asperiores quod ullam sapiente ducimus ab veritatis natus doloribus praesentium, tempora repellat voluptatem! Nostrum illum ad eaque quis architecto, incidunt voluptatum.Eum, amet? Necessitatibus, minima atque? Dolor accusantium provident vitae adipisci velit dicta porro mollitia cumque consequatur in recusandae nemo, quisquam odit tempora delectus, dolore maxime doloribus suscipit odio asperiores molestiae!',
        ]);
        Product::create([
            'name' => "Slipper Lobster",
            'category_id' => 2,
            'slug' => 'slipper-lobster',
            'price' => 57000,
            'detail' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint asperiores quod ullam sapiente ducimus ab veritatis natus doloribus praesentium, tempora repellat voluptatem! Nostrum illum ad eaque quis architecto, incidunt voluptatum.Eum, amet? Necessitatibus, minima atque? Dolor accusantium provident vitae adipisci velit dicta porro mollitia cumque consequatur in recusandae nemo, quisquam odit tempora delectus, dolore maxime doloribus suscipit odio asperiores molestiae!',
        ]);
        Product::create([
            'name' => "Bamboo Lobster",
            'category_id' => 2,
            'slug' => 'bamboo-lobster',
            'price' => 60000,
            'detail' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint asperiores quod ullam sapiente ducimus ab veritatis natus doloribus praesentium, tempora repellat voluptatem! Nostrum illum ad eaque quis architecto, incidunt voluptatum.Eum, amet? Necessitatibus, minima atque? Dolor accusantium provident vitae adipisci velit dicta porro mollitia cumque consequatur in recusandae nemo, quisquam odit tempora delectus, dolore maxime doloribus suscipit odio asperiores molestiae!',
        ]);
    }
}
