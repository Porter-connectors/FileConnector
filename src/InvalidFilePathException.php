<?php
namespace ScriptFUSION\Porter\Connector\File;

final class InvalidFilePathException extends \RuntimeException
{
    public function __construct($path)
    {
        parent::__construct("The specified file path was invalid: \"$path\".");
    }
}
