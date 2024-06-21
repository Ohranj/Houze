<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    /**
     *
     */
    public const TYPES = [
        'local' => 1,
    ];

    /**
     *
     */
    protected $fillable = ['network', 'network_id'];

    /**
     * Relations
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
