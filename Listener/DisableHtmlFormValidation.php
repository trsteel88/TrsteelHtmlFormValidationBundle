<?php

namespace Trsteel\HtmlFormValidationBundle\Listener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;


class DisableHtmlFormValidation
{
    protected $enabled;

    public function __construct($enabled = false)
    {
        $this->enabled = $enabled;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if ($this->enabled) {
            if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
                return;
            }

            $response = $event->getResponse();
            $request = $event->getRequest();

            // Ignore requests for non-HTML pages, redirections, or streamed responses
            if ('html' !== $request->getRequestFormat() || $response->isRedirect() || $response instanceof StreamedResponse) {
                return;
            }
            // Ignore ajax requests only if the data returned is not HTML
            if ($request->isXmlHttpRequest() && 'html' !== $request->getRequestFormat()) {
                return;
            }

            $content = $response->getContent();

            $content = preg_replace('/<form/is', '<form novalidate="novalidate"', $content);

            $response->setContent($content);
        }
    }
}