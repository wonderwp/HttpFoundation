<?php

namespace WonderWp\Component\HttpFoundation;

use Symfony\Component\HttpFoundation\Request as BaseRequest;
use Symfony\Component\HttpFoundation\Session\Session;
use WonderWp\Component\DependencyInjection\SingletonInterface;
use WonderWp\Component\DependencyInjection\SingletonTrait;

class Request extends BaseRequest implements SingletonInterface
{
    use SingletonTrait;

    /**
     * Build the single shared Request with one Session instance.
     * Previously getInstance() called createFromGlobals() on every access,
     * which broke ensureSession() and caused "headers already sent" fatals.
     */
    public static function buildInstance()
    {
        $instance = static::createFromGlobals();
        if (!$instance->hasSession()) {
            $instance->setSession(new Session());
        }

        return $instance;
    }
}
