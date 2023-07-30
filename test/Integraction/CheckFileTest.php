<?php

namespace Test\Integraction;

use AllowDynamicProperties;
use App\Exception\FileNotExistException;
use App\Service\CheckFile\CheckFile;
use PHPUnit\Framework\TestCase;

#[AllowDynamicProperties]
final class CheckFileTest extends TestCase
{
    public function setUp(): void
    {
        $this->checkFile = new CheckFile();
    }

    /**
     * @throws \Exception
     */
    public function testCheckDefaultFileName(): void
    {
        $this->expectException(FileNotExistException::class);
        $fileFullPath = dirname(__DIR__).'/file/test_short.txt';
        $result = $this->checkFile->check($fileFullPath);
        $this->assertSame(true, $result);
    }

    /**
     * @throws \Exception
     */
    public function testCheckFileNotExistException(): void
    {
        $this->expectException(FileNotExistException::class);
        $this->checkFile->check('test');
    }
}