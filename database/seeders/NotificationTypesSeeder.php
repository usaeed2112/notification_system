<?php

namespace Database\Seeders;

use App\Models\NotificationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['alert', 'news', 'update'];
        foreach ($types as $type) {
            NotificationType::firstOrCreate(['type' => $type]);
        }
    }
}
