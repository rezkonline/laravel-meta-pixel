<?php

namespace Rezkonline\LaravelMetaPixel\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Rezkonline\LaravelMetaPixel\Traits\HasMetaPixelEvents;
use Rezkonline\LaravelMetaPixel\Contracts\MetaPixelContract;

class Product extends Model implements MetaPixelContract
{
    use HasMetaPixelEvents;

    /**
     * Array with the pixel fields.
     *
     * @var array
     */
    public $pixelAttributes = [
        'content_ids' => 'id',
        'contents' => 'title',
        'content_category' => 'category',
        'value' => 'price',
        'currency' => 'currency',
    ];
}