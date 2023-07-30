<?php

namespace Test\Functional;

use App\Exception\FileNotExistException;
use App\Service\File\File;
use Exception;
use PHPUnit\Framework\TestCase;

final class FileTest extends TestCase
{
    private File $file;
    public function setUp(): void
    {
        $this->file = new File();
    }

    /**
     * @throws Exception
     */
    public function testValidReadExistFile(): void
    {
        $result = $this->file->read();
        $this->assertSame(true, $result);
    }

    /**
     * @throws Exception
     */
    public function testFileNotExistException(): void
    {
        $this->expectException(FileNotExistException::class);

        $this->file->read('test');
    }
}