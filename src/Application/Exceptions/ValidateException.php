<?php declare(strict_types=1);

namespace App\Application\Exceptions;


final class ValidateException extends \Exception 
{
    private const BASE_MESSAGE = "Validation error occured!";

    private const BASE_FORMAT = '%s; %s';

    public function __construct(string $message = "", int $code = 401, \Throwable $previous = null)
    {

        parent::__construct(sprintf(self::BASE_FORMAT, self::BASE_MESSAGE, $message), $code, $previous);
    }
}
