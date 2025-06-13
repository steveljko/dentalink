<?php

namespace App\Models;

use App\Enums\LogChannel;
use App\Enums\LogLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
* @method static \Illuminate\Database\Eloquent\Builder latest(int $limti = 5)
*/
class Log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'level',
        'channel',
        'message',
        'translation_key',
        'additional',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'level' => LogLevel::class,
            'channel' => LogChannel::class,
        ];
    }

    /**
     * Get hardcoded message or translated message based on the translation key.
     */
    public function getMessage(): string
    {
        if (! empty($this->translation_key)) {
            return __($this->translation_key);
        }

        return $this->message;
    }

    public function queryLatest(int $limit = 5, Builder $query): Builder
    {
        return $this->limit(5)->orderBy('created_at', 'desc');
    }
}
