<?php

declare(strict_types=1);

namespace App\TestingSys\Exception;

use App\Common\Dictionary\HttpStatusCodeDictionary;
use App\TestingSys\Dictionary\TestDictionary;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class TestNotFoundException extends HttpException
{
    public function __construct(Throwable $previous = null, array $headers = [], int $code = 0)
    {
        parent::__construct(
            HttpStatusCodeDictionary::BAD_REQUEST_CODE,
            TestDictionary::TEST_RESULT_NOT_FOUND_MSG,
            $previous,
            $headers,
            $code
        );
    }
}
