<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Product::create([
            'name' => 'Golden Glow',
            'price' => 1290,
            'old_price' => 1690,
            'discount' => 24,
            'colors' => ['#f6d365'],
            'image' => 'products/golden.jpg',
            'description' => 'Warm golden ambient light for cozy evenings.',
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'name' => 'Rose Glow',
            'price' => 1290,
            'old_price' => 1690,
            'discount' => 24,
            'colors' => ['#fda085'],
            'image' => 'products/rose.jpg',
            'description' => 'Romantic rose lighting perfect for gifting.',
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'name' => 'Ocean Glow',
            'price' => 1290,
            'old_price' => 1690,
            'discount' => 24,
            'colors' => ['#c3cfe2'],
            'image' => 'products/ocean.jpg',
            'description' => 'Calm blue tones for bedroom ambiance.',
            'is_active' => true,
        ]);

        \App\Models\Product::create([
            'name' => 'Pink Dream',
            'price' => 1290,
            'old_price' => 1690,
            'discount' => 24,
            'colors' => ['#fbc2eb'],
            'image' => 'products/pink.jpg',
            'description' => 'Dreamy pink light for reading corners.',
            'is_active' => true,
        ]);

        // Seed contents for CMS
        \App\Models\Content::create(['key' => 'hero_title', 'value' => 'Magic Lantern BD - Premium Mood Lights']);
        \App\Models\Content::create(['key' => 'phone', 'value' => '01XXXXXXXXX']);
        // Seed reviews
        Review::create([
            'name' => 'রাফি হাসান',
            'place' => 'ঢাকা',
            'text' => 'লাইটের গ্লোটা সত্যি খুব সুন্দর। রুমের পরিবেশ পুরো বদলে যায়।',
            'rating' => 5,
            'is_published' => true,
        ]);

        Review::create([
            'name' => 'নুসরাত জাহান',
            'place' => 'চট্টগ্রাম',
            'text' => 'উপহার হিসেবে নিয়েছিলাম। প্যাকেজিং, লুক আর কোয়ালিটি — সবই দারুণ।',
            'rating' => 5,
            'is_published' => true,
        ]);

        Review::create([
            'name' => 'তানভীর রহমান',
            'place' => 'সিলেট',
            'text' => 'রাতে বেডসাইডে ব্যবহার করি। আলো নরম, চোখে লাগে না, দেখতে অনেক প্রিমিয়াম।',
            'rating' => 5,
            'is_published' => true,
        ]);

        Review::create([
            'name' => 'সুমাইয়া আক্তার',
            'place' => 'রাজশাহী',
            'text' => 'ডেলিভারি দ্রুত এসেছে এবং পণ্যের কোয়ালিটি একদম দারুণ!',
            'rating' => 5,
            'is_published' => true,
        ]);

        // Add more as needed
    }
}
