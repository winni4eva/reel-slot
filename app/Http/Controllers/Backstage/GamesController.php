<?php

namespace App\Http\Controllers\Backstage;

use App\Http\Requests\Backstage\Campaigns\StoreRequest;
use App\Http\Requests\Backstage\Campaigns\UpdateRequest;
use App\Models\Artwork;
use App\Models\Campaign;
use App\Models\Game;
use App\Models\Prize;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;

class GamesController extends BackstageController
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backstage.games.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campaign = Campaign::find(session('activeCampaign'));
        $prize = Prize::where(['campaign_id' => $campaign->id])
            ->orderByRaw('RAND()')
            ->first();
        
        Game::firstOrCreate([
            'campaign_id' => $campaign->id, 
            'prizeId' => $prize->id, 
            'account' => $request->get('a'),
            'revealed_at' => Carbon::now($campaign->timezone)->toDayDateTimeString(),
            'allowed_spins' => $request->get('spins')
        ]);

        return view('backstage.games.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Campaign $campaign
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Campaign $campaign
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Campaign $campaign
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Campaign $campaign)
    {
        //
    }


}
