<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ShopeeAffiliateProduct;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ShopeeAffiliateSeeder extends Seeder
{
    public function run()
    {
        // Buat kategori
        $electronics = Category::create([
            'name' => 'Elektronik',
            'slug' => 'elektronik'
        ]);

        $fashion = Category::create([
            'name' => 'Fashion',
            'slug' => 'fashion'
        ]);

        // Buat produk 1
        $product1 = ShopeeAffiliateProduct::create([
            'category_id' => $electronics->id,
            'name' => 'Smartphone X',
            'price' => 2500000,
            'discounted_price' => 2300000,
            'affiliate_url' => 'https://affiliate.shopee.co.id/yourlink1',
            'is_active' => true
        ]);

        ProductImage::create([
            'shopee_affiliate_product_id' => $product1->id,
            'image_url' => 'https://cf.shopee.co.id/file/smartphone1.jpg',
            'is_primary' => true
        ]);

        // Buat produk 2
        $product2 = ShopeeAffiliateProduct::create([
            'category_id' => $fashion->id,
            'name' => 'Kaos Premium',
            'price' => 120000,
            'affiliate_url' => 'https://affiliate.shopee.co.id/yourlink2',
            'is_active' => true
        ]);

        ProductImage::create([
            'shopee_affiliate_product_id' => $product2->id,
            'image_url' => 'https://cf.shopee.co.id/file/kaos1.jpg',
            'is_primary' => true
        ]);
    }
}
