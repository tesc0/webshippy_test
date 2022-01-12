<?php
use PHPUnit\Framework\TestCase;

final class OrdersTest extends TestCase
{
    public function testStockInputJson(): void
    {
        $jsonR = [
            '{"1":8,"2":4,"3":5}',
            '{"1":2,"2":3,"3":1}'
        ];

        foreach($jsonR as $json) {
            $this->assertNotNull(json_decode($json));
        }
    }

    public function testDBFile() {
        $this->assertFileExists('/orders.csv');
    }
}