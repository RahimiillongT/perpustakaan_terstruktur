<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../cari.php';
require_once __DIR__ . '/../../pinjam/pinjam.php';

class DatabaseTest extends TestCase
{
    protected $mysqli;

    protected function setUp(): void
    {
        $this->mysqli = new mysqli("127.0.0.1", "root", "", "perpustakaan");
        $this->mysqli->query("DELETE FROM peminjaman"); // Clear peminjaman table
    }

    public function testCari()
    {
        // Make sure the table is cleared before inserting
        $this->mysqli->query("DELETE FROM buku WHERE id = 1");
        // Make sure there is a book in the database
        $this->mysqli->query("INSERT INTO buku (id, judul) VALUES (1, 'Test Buku')");

        $keyword = "Test";
        $result = cari($keyword);

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function testSave()
    {
        // Simulate data in the cart
        $_COOKIE['cart'] = json_encode([[1, 'Test Buku']]);

        ob_start(); // Start output buffering to avoid header errors
        save();
        ob_end_clean(); // Clean (erase) the output buffer and turn off output buffering

        $result = $this->mysqli->query("SELECT * FROM peminjaman WHERE peminjaman_id = (SELECT MAX(peminjaman_id) FROM peminjaman)");
        $this->assertTrue($result->num_rows > 0);
    }

    protected function tearDown(): void
    {
        $this->mysqli->close();
    }
}
