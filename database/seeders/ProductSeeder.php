<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name'        => 'Laptop Pro X',
                'sku'         => 'LPX-001',
                'description' => 'High-performance laptop for professionals.',
                'price'       => 15000000,
                'stock'       => 20,
                'is_active'   => true,
                'is_featured' => true,
            ],
            [
                'name'        => 'Wireless Mouse',
                'sku'         => 'WM-002',
                'description' => 'Ergonomic wireless mouse with long battery life.',
                'price'       => 250000,
                'stock'       => 100,
                'is_active'   => true,
                'is_featured' => false,
            ],
            [
                'name'        => 'Mechanical Keyboard',
                'sku'         => 'MK-003',
                'description' => 'Tactile mechanical keyboard with RGB backlight.',
                'price'       => 850000,
                'stock'       => 50,
                'is_active'   => true,
                'is_featured' => true,
            ],
            [
                'name'        => 'USB-C Hub',
                'sku'         => 'UCH-004',
                'description' => '7-in-1 USB-C hub with HDMI, USB 3.0, and SD card reader.',
                'price'       => 350000,
                'stock'       => 75,
                'is_active'   => true,
                'is_featured' => false,
            ],
            [
                'name'        => 'Monitor 27 inch',
                'sku'         => 'MON-005',
                'description' => '4K IPS monitor with 144Hz refresh rate.',
                'price'       => 5500000,
                'stock'       => 15,
                'is_active'   => true,
                'is_featured' => true,
            ],
            [
                'name'        => 'Webcam HD',
                'sku'         => 'WC-006',
                'description' => '1080p webcam with built-in microphone.',
                'price'       => 450000,
                'stock'       => 0,
                'is_active'   => false,
                'is_featured' => false,
            ],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }
    }
}
