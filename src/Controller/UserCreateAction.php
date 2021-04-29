<?php

declare(strict_types=1);

namespace App\Controller;


use App\Component\User\UserFactory;
use App\Entity\User;

class UserCreateAction
{
    public function __invoke(User $data, UserFactory $userFactory): void
    {
        $user = $userFactory->create($data->getEmail(),$data->getPassword());
        print_r($user);
        exit();
    }
}