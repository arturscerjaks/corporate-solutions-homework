<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;

class VatTest extends TestCase
{
    public function test_price_with_vat_is_calculated_correctly()
    {
        config(['tax.vat_rate' => 20]);

        $product = Product::factory()->make([
            'price' => 100,
        ]);

        $this->assertEquals(120, $product->price_with_vat);
    }
}
