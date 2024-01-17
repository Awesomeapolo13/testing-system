<?php

declare(strict_types=1);

namespace App\Common\EventListener;

use App\Common\Dictionary\DefaultDictionary;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Throwable;
use Twig\Environment;

class ExceptionListener
{
    public function __construct(
        private readonly string $env,
        private readonly Environment $twig,
        private readonly LoggerInterface $logger,
    ) {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $this->logError($exception);
        if ($this->env === 'dev') {
            return;
        }

        $event->setResponse($this->getResponse());
    }

    private function logError(Throwable $error): void
    {
        $this->logger->error('[Ошибка]: ' . $error->getMessage());
    }

    private function getResponse(): Response
    {
        $response = new Response();
        $content = $this->twig->render('components/default.error.html.twig', [
            'errMessage' => DefaultDictionary::DEFAULT_ERROR_MSG,
        ]);
        $response->setContent($content);

        return $response;
    }
}
