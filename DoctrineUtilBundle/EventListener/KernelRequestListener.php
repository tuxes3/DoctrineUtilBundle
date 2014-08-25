<?php
/**
 * Created by PhpStorm.
 * User: nicolosinger
 * Date: 24.08.14
 * Time: 18:47
 */

namespace TX3\DoctrineUtilBundleEventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class KernelRequestListener
{
    private $decodeTranslationListener;
    private $encodeTranslationListener;

    public function __construct(DecodeTranslationListener $decodeTranslationListener, EncodeTranslationListener $encodeTranslationListener)
    {
        $this->decodeTranslationListener = $decodeTranslationListener;
        $this->encodeTranslationListener = $encodeTranslationListener;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $this->decodeTranslationListener->setRequest($event->getRequest());
        $this->encodeTranslationListener->setRequest($event->getRequest());
    }

} 