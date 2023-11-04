<?php

declare(strict_types=1);

namespace App\Common\Service\Serializer\Interface;

interface NormalizerInterface
{
    public function normalize(object|array $data): array;
}
