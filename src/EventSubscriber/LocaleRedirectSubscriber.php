<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LocaleRedirectSubscriber implements EventSubscriberInterface
{
    private array $supportedLocales = ['en_US', 'pl_PL'];
    private string $defaultLocale = 'en_US';

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $path = $request->getPathInfo();

        if (preg_match('/(^\/(en_US|pl_PL)(\/|$))/', $path)) {
            return;
        }

        if (preg_match('/^\/([a-z]{2}_[A-Z]{2})(\/|$)/', $path)) {
            $path = substr($path, 6);
        }

        $locale = $request->getPreferredLanguage($this->supportedLocales) ?? $this->defaultLocale;

        $redirectUrl = '/' . $locale . $path;
        $event->setResponse(new RedirectResponse($redirectUrl));
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => [['onKernelRequest', 20]],
        ];
    }
}
