<?php

namespace Rennokki\Larafy\Validators;

use Rennokki\Larafy\LarafyGenerator;

class LarafyValidator
{
    private $validTypes = ['album', 'artist', 'track'];

    private function validate($info, $type)
    {
        if (!$info) {
            return false;
        }

        if (in_array($type, $this->validTypes) && $info->type !== $type) {
            return false;
        }

        return true;
    }


    public function validateUri($attribute, $value, $parameters, $validator)
    {
        $parsedURI = LarafyGenerator::parseSpotifyURI($value);
        return $this->validate($parsedURI, $parameters[0]);
    }


    public function validateUrl($attribute, $value, $parameters, $validator)
    {
        $parsedURL = LarafyGenerator::parseSpotifyURL($value);
        return $this->validate($parsedURL, $parameters[0]);
    }
}
