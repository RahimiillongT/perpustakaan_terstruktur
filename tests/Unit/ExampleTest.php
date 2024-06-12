<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../cari.php';
require_once __DIR__ . '/../../pinjam/pinjam.php';

class ExampleTest extends TestCase
{

    public function testArrayHasKey()
    {
        $array = ['key' => 'value'];
        $this->assertArrayHasKey('key', $array);
    }

    public function testCari()
    {
        // Mocking mysqli connection and query
        $mysqli = $this->createMock(mysqli::class);
        $result = $this->createMock(mysqli_result::class);

        $mysqli->method('query')->willReturn($result);
        $result->method('fetch_array')->willReturn(['id' => 1, 'judul' => 'Test Buku']);

        $this->assertTrue(is_array(cari('Test')));
    }

    public function testDisplay()
    {
        ob_start();
        display([['id' => 1, 'judul' => 'Test Buku']]);
        $output = ob_get_clean();

        $this->assertStringContainsString('Test Buku', $output);
    }
}
