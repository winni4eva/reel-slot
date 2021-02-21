<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['campaign_id', 'prizeId', 'account', 'revealed_at', 'allowed_spins'];

    protected $dates = [
        'revealed_at',
    ];

    public static function filter($search)
    {
        $query = self::query();
        $campaign = Campaign::find(session('activeCampaign'));
        if ($search) {
            $query = $query->where('account', 'LIKE', "%$search%")
                        ->orWhere('prizeId', '=', "%$search%");
            if (self::verifyDate($search)) {
                $query = $query->orWhereRaw('HOUR(revealed_at) >= '."%$search%");
            }
        }
        if ($campaign) {
            //self::filterDates($query, $campaign);
            $query = $query->leftJoin('prizes', 'prizes.id', '=', 'games.prizeId')
                ->select('games.id', 'account', 'prizeId', 'revealed_at', 'prizes.title')
                ->where('games.campaign_id', $campaign->id);
        }
        return $query;
    }

    private static function filterDates($query, $campaign): void
    {
        if (($data = request('date_start')) || ($data = Carbon::now()->subDays(6))) {
            $data = Carbon::parse($data)->setTimezone($campaign->timezone)->toDateTimeString();
            $query->where('games.revealed_at', '>=', $data);
        }
        if (($data = request('date_end')) || ($data = Carbon::now())) {
            $data = Carbon::parse($data)->setTimezone($campaign->timezone)->toDateTimeString();
            $query->where('games.revealed_at', '<=', $data);
        }
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function prize()
    {
        return $this->belongsTo(Prize::class);
    }

    // Needs to be moved to a utility class
    private static function verifyDate($date, $strict = true)
    {
        $dateTime = \DateTime::createFromFormat('m/d/Y', $date);
        if ($strict) {
            $errors = \DateTime::getLastErrors();
            if (!empty($errors['warning_count'])) {
                return false;
            }
        }
        return $dateTime !== false;
    }


}
