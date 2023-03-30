<?php

namespace Rezkonline\LaravelMetaPixel\Contracts;

interface MetaPixelContract
{
    public function isMetaPixelAttribute(string $key): bool;

    public function hasMetaPixelAttributes(): bool;

    public function getMetaPixelAttribute(string $key);

    public function getMetaPixelEventArgument(string $key);

    public function getMetaPixelEventArgs(): array;
}