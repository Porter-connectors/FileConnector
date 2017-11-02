<?php
namespace ScriptFUSIONTest;

use ScriptFUSION\Porter\Connector\ConnectionContext;
use ScriptFUSION\StaticClass;

final class FixtureFactory
{
    use StaticClass;

    public static function createConnectionContext()
    {
        return new ConnectionContext(
            false,
            function () {
                // Intentionally empty.
            },
            1
        );
    }
}
