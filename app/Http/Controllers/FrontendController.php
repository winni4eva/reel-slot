<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Game;
use App\Models\Symbol;
use Facades\App\Services\Payline\PaylineService;
use Facades\App\Services\ReelSlotGenerator\ReelSlotGeneratorService;

class FrontendController extends Controller
{
    public function loadCampaign(Campaign $campaign)
    {
        $symbols = $campaign->load('symbols')->symbols()->get()->toArray();
        $game = ReelSlotGeneratorService::generate($symbols);
        
        return view('frontend.index')
            ->with('data', $game);
    }

    public function placeholder()
    {
      return view('frontend.placeholder');
    }

    public function store() 
    {
        $reels = unserialize(request()->get('reels'));
        $campaignId = collect($reels)->first()[0]['campaign_id'] ?? false;
        $message = '';

        if ($campaignId) {
            $campaignSymbols = Symbol::where('campaign_id', $campaignId)->get('id')->toArray();
            $flattennedSymbols = collect($campaignSymbols)->flatten()->all();

            $matchedPayline = PaylineService::detectPayLine($reels, $flattennedSymbols);

            if ($matchedPayline) {
                $message .= 'Congratulation you won';
            } else {
                $message .= 'Sorry better luck next time';
            }
        } else {
            $message .= 'Sorry better luck next time';
        }

        return view('frontend.placeholder')->with(compact('message'));
    }

}
