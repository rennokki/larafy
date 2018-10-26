<?php

namespace Rennokki\Larafy\Exceptions;

class LarafyException extends \Exception
{
    protected $errorCode;

    public function __construct(string $message, string $errorCode = null)
    {
        parent::__construct($message);

        $this->errorCode = $errorCode;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }
}
