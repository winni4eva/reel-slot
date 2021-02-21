<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Campaign;

class Symbol extends Model
{
    use HasFactory;

    protected $fillable = ['campaign_id', 'image', 'options'];

    protected $casts = [
        'options' => 'array'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
