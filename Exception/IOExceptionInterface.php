<?php


namespace BFS\Exception;

interface IOExceptionInterface extends ExceptionInterface
{
    /**
     * Returns the associated path for the exception.
     *
     * @return string The path
     */
    public function getPath();
}
