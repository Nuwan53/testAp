<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 15 members: mix of statuses and types
        Member::factory(10)->active()->create();
        Member::factory(3)->inactive()->create();
        Member::factory(5)->premium()->active()->create();
        Member::factory(2)->vip()->active()->create();
    }
}
