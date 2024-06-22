<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'complete', 'completed', 'order'];

    protected $appends = ['human_completed', 'human_created'];

    /**
     * Appends
     */
    protected function humanCompleted(): Attribute
    {
        return new Attribute(
            get: fn () => $this->completed ? Carbon::parse($this->completed)->format('l jS M Y') : null,
        );
    }

    protected function humanCreated(): Attribute
    {
        return new Attribute(
            get: fn () => $this->created_at ? Carbon::parse($this->created_at)->format('l jS M Y') : null,
        );
    }

    /**
     * Relations
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
