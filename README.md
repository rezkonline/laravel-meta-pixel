# Meta Pixel Integration for Laravel Framework

## Install

```bash
composer require rezkonline/laravel-meta-pixel
```

### In Laravel 5.5 and up

The package will be automatically registered it's Service Provider and Facade

### In Laravel 5.4 or below

```php
// config/app.php

'providers' => [
    //
    \Rezkonline\LaravelMetaPixel\Providers\MetaPixelServiceProvider::class,
    //
],

'facades' => [
    //
    'LaravelMetaPixel' => \Rezkonline\LaravelMetaPixel\Facades\MetaPixelFacade::class,
    //
],
```

Next, publish the config file:

```bash
php artisan vendor:publish --provider="Rezkonline\LaravelMetaPixel\Providers\MetaPixelServiceProvider"
```

## Configuration

```php
return [
    /*
     * The Facebook Meta ID.
     */
    'meta_pixel_id' => env('META_PIXEL_ID', ''),
];
```

## Usage

### Basic Usage

```blade
{{-- layout.blade.php --}}
<html>
  <head>
    @include('meta-pixel::script')
    {{-- !!! --}}
  </head>
  <body>
    {{-- !!! --}}
  </body>
</html>
```

### Send Event

Call a function based on Meta Pixel standarted events [Standard Event](https://developers.facebook.com/docs/facebook-pixel/reference#events) according to the following table:

| Event                | Method                    |
|----------------------|---------------------------|
| AddPaymentInfo       | addPaymentInfoEvent       |
| AddToCart            | addToCartEvent            |
| AddToWishlist        | addToWishlistEvent        |
| CompleteRegistration | completeRegistrationEvent |
| Contact              | contactEvent              |
| CustomizeProduct     | customizeProductEvent     |
| Donate               | donateEvent               |
| FindLocation         | findLocationEvent         |
| Lead                 | leadEvent                 |
| InitiateCheckout     | initiateCheckoutEvent     |
| Purchase             | purchaseEvent             |
| Schedule             | scheduleEvent             |
| Search               | searchEvent               |
| StartTrial           | startTrialEvent           |
| SubmitApplication    | submitApplicationEvent    |
| Subscribe            | subscribeEvent            |
| ViewContent          | viewContentEvent          |

#### Example

```php
\LaravelMetaPixel::addToCartEvent([
    // List of event parameters
])
```

## License

The MIT License (MIT). Please head to [License File](LICENSE.md) for more information.