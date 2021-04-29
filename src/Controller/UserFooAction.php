<?php

declare(strict_types=1);

namespace App\Controller;

use App\Component\User\FooDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class UserFooAction
{
    public function __invoke(Request $request,SerializerInterface $serializer): FooDto
    {
        /** @var FooDto $fooDto */
        $fooDto = $serializer->deserialize($request->getContent(), FooDto::class, 'json');

        return $fooDto;
    }
}