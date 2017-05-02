<?php

namespace ChickenTikkaMasla\GPIO\Exception;

use Throwable;

/**
 * Class GPIOModeNotFound
 * @package ChickenTikkaMasla\GPIO\Exception
 */
class GPIOModeNotFound extends \Exception
{
    /**
     * GPIOModeNotFound constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message.' is not a valid mode', $code, $previous);
    }
}