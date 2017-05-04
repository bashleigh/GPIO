<?php

namespace ChickenTikkaMasala\GPIO\Exception;

use Throwable;

/**
 * Class GPIOCommandNotFoundException
 * @package ChickenTikkaMasala\GPIO\Exception
 */
class GPIOCommandNotFoundException extends \Exception
{
    /**
     * GPIOModeNotFound constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "gpio command was not found", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}