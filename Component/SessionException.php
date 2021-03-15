<?php

namespace Component;


class SessionException extends \Exception
{
    private $key;

    public function __construct(string $message, string $key)
    {
        $this->key = $key;
        parent::__construct($message, 1234);
    }

    public function getKey(): string
    {
        return $this->key;
    }
}