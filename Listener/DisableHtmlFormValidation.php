<?php

namespace Trsteel\HtmlFormValidationBundle\Listener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\KernelEvent;

class DisableHtmlFormValidation
{
    protected $enabled;

    public function __construct($enabled = false)
    {
        $this->enabled = $enabled;
    }

    public function onKernelResponse(KernelEvent $event)
    {
        if ($this->enabled) {
            if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
                return;
            }

            $response = $event->getResponse();
            $request = $event->getRequest();

            if ($request->isXmlHttpRequest() || 'html' !== $request->getRequestFormat() || $response->isRedirect()) {
                return;
            }

            try {
                $content = $response->getContent();

                $content = preg_replace('/<form/is', '<form novalidate="novalidate"', $content);

                $response->setContent($content);
            } catch (\Exception $e) {
                
            }
        }
    }
}
