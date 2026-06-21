<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Component;
use App\Models\ComponentCategory;

class ComponentSeeder extends Seeder
{
    public function run(): void
    {
        $cpu = ComponentCategory::where('slug', 'cpu')->first();
        $ram = ComponentCategory::where('slug', 'ram')->first();
        $gpu = ComponentCategory::where('slug', 'gpu')->first();
        $case = ComponentCategory::where('slug', 'case')->first();
        $storage = ComponentCategory::where('slug', 'storage')->first();

        // CPU
        $cpus = [
            [
                'category_id' => $cpu->id,
                'name' => 'Ryzen 5 5600X',
                'brand' => 'AMD',
                'price' => 189.99,
                'specs' => [
                    'ram_type' => 'DDR4',
                    'ram_slots' => 4,
                    'cores' => 6,
                    'threads' => 12,
                    'frequency' => 3.7,
                    'tdp' => 65,
                ],
            ],
            [
                'category_id' => $cpu->id,
                'name' => 'Ryzen 7 7700X',
                'brand' => 'AMD',
                'price' => 299.99,
                'specs' => [
                    'ram_type' => 'DDR5',
                    'ram_slots' => 4,
                    'cores' => 8,
                    'threads' => 16,
                    'frequency' => 4.5,
                    'tdp' => 105,
                ],
            ],
            [
                'category_id' => $cpu->id,
                'name' => 'Core i5-12600K',
                'brand' => 'Intel',
                'price' => 229.99,
                'specs' => [
                    'ram_type' => 'DDR4',
                    'ram_slots' => 4,
                    'cores' => 10,
                    'threads' => 16,
                    'frequency' => 3.7,
                    'tdp' => 125,
                ],
            ],
            [
                'category_id' => $cpu->id,
                'name' => 'Core i7-13700K',
                'brand' => 'Intel',
                'price' => 389.99,
                'specs' => [
                    'ram_type' => 'DDR5',
                    'ram_slots' => 4,
                    'cores' => 16,
                    'threads' => 24,
                    'frequency' => 3.4,
                    'tdp' => 125,
                ],
            ],
            [
                'category_id' => $cpu->id,
                'name' => 'Core i9-13900K',
                'brand' => 'Intel',
                'price' => 549.99,
                'specs' => [
                    'ram_type' => 'DDR5',
                    'ram_slots' => 4,
                    'cores' => 24,
                    'threads' => 32,
                    'frequency' => 3.0,
                    'tdp' => 253,
                ],
            ],
        ];

        // RAM
        $rams = [
            [
                'category_id' => $ram->id,
                'name' => 'Vengeance 16GB DDR4',
                'brand' => 'Corsair',
                'price' => 49.99,
                'specs' => [
                    'type' => 'DDR4',
                    'speed' => 3200,
                    'capacity' => 16,
                    'sticks' => 2,
                    'tdp' => 3,
                ],
            ],
            [
                'category_id' => $ram->id,
                'name' => 'Vengeance 32GB DDR4',
                'brand' => 'Corsair',
                'price' => 89.99,
                'specs' => [
                    'type' => 'DDR4',
                    'speed' => 3600,
                    'capacity' => 32,
                    'sticks' => 2,
                    'tdp' => 5,
                ],
            ],
            [
                'category_id' => $ram->id,
                'name' => 'Trident Z5 16GB DDR5',
                'brand' => 'G.Skill',
                'price' => 79.99,
                'specs' => [
                    'type' => 'DDR5',
                    'speed' => 5600,
                    'capacity' => 16,
                    'sticks' => 2,
                    'tdp' => 4,
                ],
            ],
            [
                'category_id' => $ram->id,
                'name' => 'Trident Z5 32GB DDR5',
                'brand' => 'G.Skill',
                'price' => 149.99,
                'specs' => [
                    'type' => 'DDR5',
                    'speed' => 6000,
                    'capacity' => 32,
                    'sticks' => 2,
                    'tdp' => 6,
                ],
            ],
            [
                'category_id' => $ram->id,
                'name' => 'Fury Beast 16GB DDR4',
                'brand' => 'Kingston',
                'price' => 44.99,
                'specs' => [
                    'type' => 'DDR4',
                    'speed' => 3200,
                    'capacity' => 16,
                    'sticks' => 2,
                    'tdp' => 3,
                ],
            ],
        ];

        // GPU
        $gpus = [
            [
                'category_id' => $gpu->id,
                'name' => 'RTX 3060',
                'brand' => 'NVIDIA',
                'price' => 299.99,
                'specs' => [
                    'vram' => 12,
                    'length' => 240,
                    'tdp' => 170,
                ],
            ],
            [
                'category_id' => $gpu->id,
                'name' => 'RTX 4070',
                'brand' => 'NVIDIA',
                'price' => 599.99,
                'specs' => [
                    'vram' => 12,
                    'length' => 285,
                    'tdp' => 200,
                ],
            ],
            [
                'category_id' => $gpu->id,
                'name' => 'RTX 4090',
                'brand' => 'NVIDIA',
                'price' => 1599.99,
                'specs' => [
                    'vram' => 24,
                    'length' => 336,
                    'tdp' => 450,
                ],
            ],
            [
                'category_id' => $gpu->id,
                'name' => 'RX 6700 XT',
                'brand' => 'AMD',
                'price' => 349.99,
                'specs' => [
                    'vram' => 12,
                    'length' => 267,
                    'tdp' => 230,
                ],
            ],
            [
                'category_id' => $gpu->id,
                'name' => 'RX 7900 XTX',
                'brand' => 'AMD',
                'price' => 999.99,
                'specs' => [
                    'vram' => 24,
                    'length' => 287,
                    'tdp' => 355,
                ],
            ],
        ];

        // Case
        $cases = [
            [
                'category_id' => $case->id,
                'name' => 'H510',
                'brand' => 'NZXT',
                'price' => 69.99,
                'specs' => [
                    'form_factor' => 'ATX',
                    'max_gpu_length' => 360,
                    'storage_bays' => 2,
                    'tdp' => 0,
                ],
            ],
            [
                'category_id' => $case->id,
                'name' => '4000D Airflow',
                'brand' => 'Corsair',
                'price' => 104.99,
                'specs' => [
                    'form_factor' => 'ATX',
                    'max_gpu_length' => 360,
                    'storage_bays' => 4,
                    'tdp' => 0,
                ],
            ],
            [
                'category_id' => $case->id,
                'name' => 'Meshify C',
                'brand' => 'Fractal Design',
                'price' => 89.99,
                'specs' => [
                    'form_factor' => 'ATX',
                    'max_gpu_length' => 315,
                    'storage_bays' => 3,
                    'tdp' => 0,
                ],
            ],
            [
                'category_id' => $case->id,
                'name' => 'Pure Base 500',
                'brand' => 'be quiet!',
                'price' => 94.99,
                'specs' => [
                    'form_factor' => 'ATX',
                    'max_gpu_length' => 369,
                    'storage_bays' => 3,
                    'tdp' => 0,
                ],
            ],
            [
                'category_id' => $case->id,
                'name' => 'O11 Dynamic',
                'brand' => 'Lian Li',
                'price' => 149.99,
                'specs' => [
                    'form_factor' => 'ATX',
                    'max_gpu_length' => 420,
                    'storage_bays' => 4,
                    'tdp' => 0,
                ],
            ],
        ];

        // Storage
        $storages = [
            [
                'category_id' => $storage->id,
                'name' => '870 EVO 500GB',
                'brand' => 'Samsung',
                'price' => 59.99,
                'specs' => [
                    'type' => 'SSD',
                    'interface' => 'SATA',
                    'capacity' => 500,
                    'read_speed' => 560,
                    'write_speed' => 530,
                    'tdp' => 2,
                ],
            ],
            [
                'category_id' => $storage->id,
                'name' => '980 Pro 1TB',
                'brand' => 'Samsung',
                'price' => 109.99,
                'specs' => [
                    'type' => 'SSD',
                    'interface' => 'NVMe',
                    'capacity' => 1000,
                    'read_speed' => 7000,
                    'write_speed' => 5000,
                    'tdp' => 6,
                ],
            ],
            [
                'category_id' => $storage->id,
                'name' => 'SN770 1TB',
                'brand' => 'WD',
                'price' => 79.99,
                'specs' => [
                    'type' => 'SSD',
                    'interface' => 'NVMe',
                    'capacity' => 1000,
                    'read_speed' => 5150,
                    'write_speed' => 4900,
                    'tdp' => 5,
                ],
            ],
            [
                'category_id' => $storage->id,
                'name' => 'Barracuda 2TB',
                'brand' => 'Seagate',
                'price' => 54.99,
                'specs' => [
                    'type' => 'HDD',
                    'interface' => 'SATA',
                    'capacity' => 2000,
                    'read_speed' => 190,
                    'write_speed' => 190,
                    'tdp' => 8,
                ],
            ],
            [
                'category_id' => $storage->id,
                'name' => 'MP600 Pro 2TB',
                'brand' => 'Corsair',
                'price' => 189.99,
                'specs' => [
                    'type' => 'SSD',
                    'interface' => 'NVMe',
                    'capacity' => 2000,
                    'read_speed' => 7100,
                    'write_speed' => 6800,
                    'tdp' => 7,
                ],
            ],
        ];

        foreach (array_merge($cpus, $rams, $gpus, $cases, $storages) as $component) {
            Component::create($component);
        }
    }
}