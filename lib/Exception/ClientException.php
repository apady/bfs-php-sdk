<?php



namespace BFS\Exception;


class ClientException extends IOException
{
    public function __construct($message = null, $code = 0, \Exception $previous = null, $path = null)
    {
        if (null === $message) {
            if (null === $path) {
                $message = 'Valid BFS flag file required.';
            } else {
                $message = sprintf('Can not access BFS using "%s".', $path);
            }
        }

        parent::__construct($message, $code, $previous, $path);
    }
}
