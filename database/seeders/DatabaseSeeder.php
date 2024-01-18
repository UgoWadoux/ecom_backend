<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
//        // ]);
//        $users = User::factory(10)->create();
//        foreach ($users as $user){
//            Service::factory()
//                ->create([
//                    'user_id'=>$user->id
//                ]);
//            $order = Order::factory()
//                ->create([
//                    'user_id'=>$user->id
//                ]);
//            Blog::factory()
//                ->create([
//                    'user_id'=>$user->id
//                ]);
//
//        }
//        $categories = Category::factory(5)->create();
//        foreach ($categories as $category){
//            Product::factory()
//                ->hasAttached($order, ['quantity'=>1])
//                ->hasAttached($users, ['comment'=>'Ceci est un commentaire'])
//                ->create([
//                   'category_id'=>$category->id
//                ]);
//        }
//        $user = User::factory()->count(10);
        $user = User::factory()->create();

        Service::factory()
            ->count(3)
            ->for($user)
            ->create();

        Blog::factory()
            ->count(3)
            ->for($user)
            ->create();

        $order = Order::factory()
            ->count(3)
            ->for($user)
            ->create();
        $category = Category::factory()->create();
        Product::factory()
            ->count(3)
            ->for($category)
            ->hasAttached($order, ['quantity'=>1])
            ->hasAttached($user, ['comment'=>'Ceci est un commentaire'])
            ->create();
    }
}
