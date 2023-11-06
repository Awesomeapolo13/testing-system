<?php

declare(strict_types=1);

namespace App\TestingSys\Controller;

use App\Common\Service\Serializer\Interface\NormalizerInterface;
use App\TestingSys\DTO\ShowTestResultDto;
use App\TestingSys\DTO\TestResultDto;
use App\TestingSys\Services\TestGet;
use App\TestingSys\Services\TestResultGet;
use App\TestingSys\Services\TestResultHandle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    public function __construct(
        private readonly NormalizerInterface $normalizer,
    ) {
    }

    #[Route(path: '/', methods: 'GET', name: 'app_testing_list_page')]
    public function getTestListAction(TestGet $testGet): Response
    {
        return $this->render(
            'testing_sys/main.html.twig',
            [
                'testList' => $testGet->getTestList(),
            ]
        );
    }

    #[Route(path: '/test/detail/{testId}/', methods: 'GET', name: 'app_test_page')]
    public function getTestDetailAction(int $testId, TestGet $testGet): Response
    {
        return $this->render(
            'testing_sys/test.html.twig',
            [
                'test' => $this->normalizer->normalize(
                    $testGet->getTest($testId)
                ),
            ]
        );
    }

    #[Route(path: '/test/handle/', methods: 'POST', name: 'app_test_handle_result')]
    public function handleTestResultAction(
        #[MapRequestPayload] TestResultDto $resultDto,
        TestResultHandle $resultHandle
    ): Response {
        return $this->redirectToRoute(
            'app_test_get_result',
            [
                'testId' => $resultDto->testId,
                'result' => $resultHandle->handleResult($resultDto),
            ]
        );
    }

    #[Route(path: '/test/result/', methods: 'GET', name: 'app_test_get_result')]
    public function getTestResult(
        #[MapQueryString] ShowTestResultDto $resultDto,
        TestResultGet $resultGet
    ): Response {
        return $this->render(
            'testing_sys/test_result.html.twig',
            [
                'result' => $this->normalizer->normalize(
                    $resultGet->getTestResult($resultDto),
                    null,
                    ['groups' => ['result']]
                ),
            ]
        );
    }
}
