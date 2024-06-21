<?php

declare(strict_types=1);

namespace App\Actions\Network;

use App\Models\Network;
use App\Models\User;

class CreateNetwork
{
    public function execute(User $user, string $type = 'local'): Network
    {
        return $user->network()->create([
            'network' => Network::TYPES[$type],
            'network_id' => null
        ]);
    }
}
