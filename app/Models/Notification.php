<?php

namespace App\Models;

use App\Enums\NotificationChannel;
use App\Enums\NotificationLevel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder latest(int $limt = 5)
 * @method static \Illuminate\Database\Eloquent\Builder unread()
 */
class Notification extends Model
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
        'is_sent',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'level' => NotificationLevel::class,
            'channel' => NotificationChannel::class,
            'additional' => 'array',
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

    public function isChannel(NotificationChannel $channel): bool
    {
        return $this->channel === $channel;
    }

    public function queryLatest(int $limit, Builder $query): Builder
    {
        return $this->limit(5)->orderBy('created_at', 'desc');
    }

    public function scopeUnread(Builder $builder): Builder
    {
        return $this->whereNull('read_at')->orderBy('created_at', 'desc');
    }
}
