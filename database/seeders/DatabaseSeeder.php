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
            'email' => 'grandonk457@gmail.com',
            'password' => bcrypt('22012000'),
            'address' => 'Rungkut',
            'province_id' => '11',
            'province' => 'Jawa Timur',
            'city_id' => '444',
            'city' => 'Kota Surabaya',
            'postal_code' => '66666',
            'phone' => '081234567890'
        ]);

        Category::create([
            'name' => 'Buah',
            'slug' => 'buah'
        ]);
        Category::create([
            'name' => 'Sayur',
            'slug' => 'sayur'
        ]);

        Product::create([
            'name' => "Apple",
            'category_id' => 1,
            'slug' => 'apple',
            'price' => 40000,
            'detail' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint asperiores quod ullam sapiente ducimus ab veritatis natus doloribus praesentium, tempora repellat voluptatem! Nostrum illum ad eaque quis architecto, incidunt voluptatum.Eum, amet? Necessitatibus, minima atque? Dolor accusantium provident vitae adipisci velit dicta porro mollitia cumque consequatur in recusandae nemo, quisquam odit tempora delectus, dolore maxime doloribus suscipit odio asperiores molestiae!',
        ]);
        Product::create([
            'name' => "Banana",
            'category_id' => 1,
            'slug' => 'banana',
            'price' => 38000,
            'detail' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint asperiores quod ullam sapiente ducimus ab veritatis natus doloribus praesentium, tempora repellat voluptatem! Nostrum illum ad eaque quis architecto, incidunt voluptatum.Eum, amet? Necessitatibus, minima atque? Dolor accusantium provident vitae adipisci velit dicta porro mollitia cumque consequatur in recusandae nemo, quisquam odit tempora delectus, dolore maxime doloribus suscipit odio asperiores molestiae!',
        ]);
        Product::create([
            'name' => "Cucumber",
            'category_id' => 2,
            'slug' => 'cucumber',
            'price' => 57000,
            'detail' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint asperiores quod ullam sapiente ducimus ab veritatis natus doloribus praesentium, tempora repellat voluptatem! Nostrum illum ad eaque quis architecto, incidunt voluptatum.Eum, amet? Necessitatibus, minima atque? Dolor accusantium provident vitae adipisci velit dicta porro mollitia cumque consequatur in recusandae nemo, quisquam odit tempora delectus, dolore maxime doloribus suscipit odio asperiores molestiae!',
        ]);
        Product::create([
            'name' => "Broccoli",
            'category_id' => 2,
            'slug' => 'broccoli',
            'price' => 60000,
            'detail' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint asperiores quod ullam sapiente ducimus ab veritatis natus doloribus praesentium, tempora repellat voluptatem! Nostrum illum ad eaque quis architecto, incidunt voluptatum.Eum, amet? Necessitatibus, minima atque? Dolor accusantium provident vitae adipisci velit dicta porro mollitia cumque consequatur in recusandae nemo, quisquam odit tempora delectus, dolore maxime doloribus suscipit odio asperiores molestiae!',
        ]);
    }
}
