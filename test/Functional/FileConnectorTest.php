<?php
namespace ScriptFUSIONTest\Functional;

use ScriptFUSION\Porter\Connector\File\FileConnector;
use ScriptFUSION\Porter\Connector\File\InvalidFilePathException;
use ScriptFUSION\Retry\FailingTooHardException;
use ScriptFUSIONTest\FixtureFactory;

/**
 * @see FileConnector
 */
final class FileConnectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FileConnector
     */
    private $connector;

    protected function setUp()
    {
        $this->connector = new FileConnector;
    }

    /**
     * Tests that an empty path fails.
     */
    public function testEmpty()
    {
        $this->expectException(FailingTooHardException::class);

        $this->fetch('');
    }

    /**
     * Tests that absolute paths succeed.
     */
    public function testAbsolutePath()
    {
        self::assertStringEqualsFile(__FILE__, $this->fetch(__FILE__));
    }

    /**
     * Tests that relative paths succeed.
     */
    public function testRelativePath()
    {
        chdir(__DIR__);

        self::assertStringEqualsFile(__FILE__, $this->fetch(basename(__FILE__)));
    }

    /**
     * Tests that accessing the file:// protocol, with any capitalization, succeeds.
     */
    public function testFileProtocol()
    {
        self::assertStringEqualsFile(__FILE__, $this->fetch('file://' . __FILE__));
        self::assertStringEqualsFile(__FILE__, $this->fetch('FILE://' . __FILE__));
    }

    /**
     * Tests that accessing any protocol other than file:// throws an exception.
     */
    public function testHttpProtocol()
    {
        $this->expectException(InvalidFilePathException::class);

        $this->fetch('http://example.com');
    }

    private function fetch($file)
    {
        return $this->connector->fetch(FixtureFactory::createConnectionContext(), $file);
    }
}
