<?php

namespace ChickenTikkaMasla\GPIO\Exception;

use Throwable;

class GPIOModeNotFound extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message.' is not a valid mode', $code, $previous);
    }
}