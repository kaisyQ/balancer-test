<?php declare(strict_types=1);

namespace App\Application\Exceptions;


final class ValidateException extends \Exception 
{
    private const BASE_MESSAGE = "Validation error occured!";

    private const BASE_FORMAT = '%s; %s';

    private const BASE_CODE = 400;

    public function __construct(string $message = "", \Throwable $previous = null)
    {
        parent::__construct(sprintf(self::BASE_FORMAT, self::BASE_MESSAGE, $message), self::BASE_CODE, $previous);
    }
}
