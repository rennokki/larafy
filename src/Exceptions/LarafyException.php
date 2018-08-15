<?php

namespace Rennokki\Larafy\Exceptions;

class LarafyException extends \Exception
{
    protected $apiResponse;

    public function __construct($message = null, $apiResponse = null, $code = 0, \EXception $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->apiResponse = $apiResponse;
    }

    public function getAPIResponse()
    {
        return $this->apiResponse;
    }
}
