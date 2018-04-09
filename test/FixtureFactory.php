<?php
namespace ScriptFUSIONTest;

use ScriptFUSION\Porter\Connector\ConnectionContext;
use ScriptFUSION\Porter\Connector\FetchExceptionHandler\FetchExceptionHandler;
use ScriptFUSION\StaticClass;

final class FixtureFactory
{
    use StaticClass;

    public static function createConnectionContext()
    {
        return new ConnectionContext(
            false,
            \Mockery::mock(FetchExceptionHandler::class),
            1
        );
    }
}
