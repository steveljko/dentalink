<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
* @method static \Illuminate\Database\Eloquent\Builder today()
* @method static \Illuminate\Database\Eloquent\Builder whereStatus(string $status)
*/
class Appointment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'dentist_id',
        'scheduled_start',
        'duration',
        'notes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'scheduled_start' => 'datetime',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    // get appointments based on timestamp
    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('scheduled_start', Carbon::today())
            ->whereStatus('scheduled')
            ->orderBy('scheduled_start', 'desc');
    }

    public static function scopeThisYear($query)
    {
        return $query->whereYear('created_at', Carbon::now()->year);
    }
}
