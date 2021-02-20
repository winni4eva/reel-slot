<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Facade\App\Services\Payline\PaylineService;

class FrontendController extends Controller
{
    public function loadCampaign(Campaign $campaign)
    {
        $game = null;

        return view('frontend.index')
            ->with('data', $game);
    }

    public function placeholder()
    {
      //symbol, point, weight
      $symbols = [
        [
          'id' => 1,
          'name' => 'Mango',
          'image_url' => '/public/images/mango.jpg'
        ],
        [
          'id' => 2,
          'name' => 'Banana',
          'image_url' => '/public/images/mango.jpg'
        ],
        [
          'id' => 3,
          'name' => 'Pawpaw',
          'image_url' => '/public/images/mango.jpg'
        ],
        [
          'id' => 4,
          'name' => 'Apple',
          'image_url' => '/public/images/mango.jpg'
        ],
        [
          'id' => 5,
          'name' => 'Orange',
          'image_url' => '/public/images/mango.jpg'
        ]
      ];

      return view('frontend.placeholder')
        ->with('reel', $this->generate($symbols));
    }

    private function generate(array $symbols, $columns = 5, $rows = 3): array 
    {
        $reel = [];
        for ($i=0; $i < $rows; $i++) { 
            $myRowArray = [];
            for ($j=0; $j < $columns; $j++) { 
                array_push($myRowArray, $symbols[rand(0, $columns - 1)]);
            }
            array_push($reel, $myRowArray);
        }
        return $reel;
    }

}
