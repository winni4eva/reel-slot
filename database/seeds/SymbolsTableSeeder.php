<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Illuminate\Database\Seeder;
use App\Models\Symbol;

class SymbolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campaign = Campaign::orderBy('id', 'desc')->limit(2)->first();

        Symbol::factory()->count(6)->create([
            'campaign_id' => $campaign->id
        ]);
    }
}
