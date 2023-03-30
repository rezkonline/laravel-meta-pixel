<?php

namespace Laraeast\LaravelBootstrapForms\Tests\Unit;

use Laraeast\LaravelBootstrapForms\Tests\TestCase;
use Rezkonline\LaravelMetaPixel\Tests\Models\Product;
use Rezkonline\LaravelMetaPixel\Facades\MetaPixelFacade;

class MetaPixelEventsTest extends TestCase
{
    /** @test */
    public function it_has_pixel_attributes()
    {
        $this->assertTrue((new Product())->hasMetaPixelAttributes());
    }

    /** @test */
    public function it_has_correct_pixel_attribute()
    {
        $this->assertEquals(
            'title',
            (new Product())->getMetaPixelAttribute('contents')
        );
    }

    /** @test */
    public function it_has_correct_mapping()
    {
        $product = factory(Product::class)->create([
            'title' => 'Product1',
        ]);

        $this->assertEquals([
            'content_ids' => $product->getKey(),
            'contents' => $product->title,
            'content_category' => $product->category,
            'value' => $product->price,
            'currency' => $product->currency
        ], $product->getMetaPixelEventArgs());
    }
}
