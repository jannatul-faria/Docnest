<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChamberSchedule extends Model
{
    protected $fillable = [
        'chamber_id',
        'day',
        'start_time',
        'end_time',
        'max_patients',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function chamber(): BelongsTo
    {
        return $this->belongsTo(Chamber::class);
    }
}
