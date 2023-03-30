<?php

namespace Rezkonline\LaravelMetaPixel;

use Illuminate\Support\Str;
use Rezkonline\LaravelMetaPixel\Contracts\MetaPixelContract;

class MetaPixel
{
    /**
     * @var \Rezkonline\LaravelMetaPixel\MetaPixel
     */
    protected static $instance;

    protected $events = [
        'AddPaymentInfo',
        'AddToCart',
        'AddToWishlist',
        'CompleteRegistration',
        'Contact',
        'CustomizeProduct',
        'Donate',
        'FindLocation',
        'InitiateCheckout',
        'Lead',
        'Purchase',
        'Schedule',
        'Search',
        'StartTrial',
        'SubmitApplication',
        'Subscribe',
        'ViewContent',
    ];

    /**
     * MetaPixel constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param $eventName
     * @param array $parameters
     */
    public function createEvent($eventName, $parameters = [])
    {
        $metaPixelSession = session('metaPixelSession');
        $metaPixelSession = !$metaPixelSession ? [] : $metaPixelSession;

        $metaPixel = [
            'name'       => $eventName,
            'parameters' => $parameters,
        ];

        array_push($metaPixelSession, $metaPixel);

        session(['metaPixelSession' => $metaPixelSession]);
    }

    /**
     * @return string
     */
    public function bodyContent()
    {
        $metaPixelSession = session()->pull('metaPixelSession', []);

        $pixelCode = '';
        if (count($metaPixelSession) > 0) {
            foreach ($metaPixelSession as $key => $metaPixel) {
                $pixelCode .= "fbq('track', '" . $metaPixel['name'] . "', " . json_encode($metaPixel['parameters']) . ");";
            }

            session()->forget('metaPixelSession');
            return "<script>" . $pixelCode . "</script>";
        }

        return '';
    }

    /**
     * @return array
     */
    public function supportedEvents()
    {
        return array_map([$this, 'toMethodFormat'], $this->events);
    }

    /**
     * @param string $method
     * @param array  $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        $event = $this->toEventFormat($method);

        if (! in_array($event, $this->events)) {
            throw new \InvalidArgumentException("'{$event}' event doean't exist in supported Meta Pixel Events");
        }

        if (count($args) == 1 && $args[0] instanceof MetaPixelContract) {
            $model = $args[0]; // Instance of Laravel model

            return $this->createEvent(
                $event,
                $model->getMetaPixelEventArgs()
            );
        }

        return $this->createEvent($event, $args);
    }

    /**
     * @return static
     */
    public static function getInstance()
    {
        if ($instance = self::$instance) {
            return $instance;
        }

        return static::$instance = new static();
    }

    /**
     * @param string $string
     * @return string
     */
    protected function toEventFormat(string $string)
    {
        return Str::studly(Str::replaceLast('Event', '', $string));
    }

    /**
     * @param string $string
     * @return string
     */
    protected function toMethodFormat(string $string)
    {
        return Str::camel($string).'Event';
    }
}