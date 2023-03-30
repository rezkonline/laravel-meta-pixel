<?php

namespace Rezkonline\LaravelMetaPixel\Traits;

trait HasMetaPixelEvents
{
    /**
     * Determine whether the given key is meta pixel attribute.
     *
     * @param string $key
     * @return bool
     */
    public function isMetaPixelAttribute(string $key): bool
    {
        return $this->hasMetaPixelAttributes() && in_array($key, array_keys($this->pixelAttributes));
    }

    /**
     * @return bool
     */
    public function hasMetaPixelAttributes(): bool
    {
        return isset($this->pixelAttributes) && is_array($this->pixelAttributes) && !empty($this->pixelAttributes);
    }

    /**
     * Map pixel argument name to model attribute name.
     *
     * @param string $key
     * @return mixed
     */
    public function getMetaPixelAttribute(string $key)
    {
        return $this->pixelAttributes[$key];
    }

    /**
     * Get meta pixel event argument value.
     *
     * @param string $key
     * @return mixed
     */
    public function getMetaPixelEventArgument(string $key)
    {
        if ($this->isMetaPixelAttribute($key)) {
            return $this->getAttributeValue(
                $this->getMetaPixelAttribute($key)
            );
        }

        return null;
    }

    /**
     * @return array
     */
    public function getMetaPixelEventArgs(): array
    {
        if (! $this->hasMetaPixelAttributes()) {
            return [];
        }

        $attributes = $this->pixelAttributes;

        foreach (array_keys($attributes) as $key) {
            $attributes[$key] = $this->getMetaPixelEventArgument($key);
        }

        return $attributes;
    }
}