<?php
use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase {
    public function testAddition() {
        $this->assertEquals(2, 1 + 1);
    }

    public function testIsString() {
        $this->assertIsString("hello");
    }
}
