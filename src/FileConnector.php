<?php
namespace ScriptFUSION\Porter\Connector\File;

use ScriptFUSION\Porter\Connector\ConnectionContext;
use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Options\EncapsulatedOptions;

class FileConnector implements Connector
{
    public function fetch(ConnectionContext $context, $source, EncapsulatedOptions $options = null)
    {
        if (preg_match('[^(\w+)://]', $source, $matches) && strtolower($matches[1]) !== 'file') {
            throw new InvalidFilePathException($source);
        }

        return $context->retry(function () use ($source) {
            return file_get_contents($source);
        });
    }
}
