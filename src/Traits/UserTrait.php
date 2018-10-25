<?php

namespace Rennokki\Larafy\Traits;

use Rennokki\Larafy\Exceptions\SpotifyAPIException;
use Rennokki\Larafy\Exceptions\SpotifyAuthorizationException;

use Carbon\Carbon;

trait UserTrait
{
    public function getCurrentUserProfile() {
        return $this->get('me');
    }
}
