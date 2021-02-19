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
      
      $data = [
        [1,2,3,4,5],
        [1,2,3,4,5],
        [1,2,3,4,5]
      ];

      return view('frontend.placeholder')
        ->with('reel', $data);
    }

}
