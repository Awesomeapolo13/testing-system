<?php

declare(strict_types=1);

namespace App\Common\Service\Serializer;

use App\Common\Service\Serializer\Interface\NormalizerInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AnnotationSerializer implements NormalizerInterface
{
    private Serializer $serializer;

    public function __construct()
    {
        $classMetadataFactory = new ClassMetadataFactory(
            new AnnotationLoader()
        );

        $this->serializer = new Serializer([new ObjectNormalizer($classMetadataFactory)]);
    }

    /**
     * @throws ExceptionInterface
     */
    public function normalize(object|array $data, string $format = null, array $context = []): array
    {
        return (array)$this->serializer->normalize($data, $format, $context);
    }
}
