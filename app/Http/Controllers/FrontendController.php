<?php

namespace App\Http\Controllers;

use App\Models\Campaign;

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

    private function detectPayLine(array $reels, array $symbolIds, $columns = 5, $rows = 3) 
    {
        $symblosCount = count($symbolIds);
        $drawPayLine = '';
        for ($i=0; $i < $symblosCount; $i++) { 
            $currentSymbol = $symbolIds[$i];
            if ($this->allRowsMatchSymbol($reels, $currentSymbol, $columns, $rows)) {
                return true;
            }
        }
    }

    private function allRowsMatchSymbol($reels, $symbolId, $columns, $rows) {
        $rowCount = count($rows);
        $columnCount = count($columns);
        for ($i=0; $i < $rowCount; $i++) { 
            $matchedSymbols = [];
            for ($j=0; $j < $columnCount; $j++) { 
                if ($reels[$i][$j]['id'] == $symbolId) {
                    array_push($matchedSymbols, $symbolId);
                }
            }
            if (count($matchedSymbols) == $columnCount) {
                return true;
            }
        }
        return false;
    }

    // private function getSymbolPaylines(int $symbolId, $reels, $columns = 5, $rows = 3) : string
    // {
    //     for ($i=0; $i < $rows; $i++) { 
    //         for ($j=0; $j < $columns; $j++) { 
    //             if () {
    //                 //
    //             }
    //         }
    //     }
    // 1-2-3-4-5 
    // 6-7-8-9-10
    //     // 11-12-13-14-15, 
    //    
    //     //1-7-13-9-5, 
    //     // 11-7-3-9-15, 6-2-3-4-10, 
    //     // 6-12-13-14-10, 1-2-8-14-15,
    //     // 11-12-8-4-5

    //     return '';
    // }

}
