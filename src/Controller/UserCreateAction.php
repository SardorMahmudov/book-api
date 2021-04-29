<?php

declare(strict_types=1);

namespace App\Controller;

use App\Component\User\UserFactory;
use App\Component\User\UserManager;
use App\Entity\User;

class UserCreateAction
{
    public function __invoke(User $data, UserFactory $userFactory,UserManager $userManager): User
    {
        $user = $userFactory->create($data->getEmail(),$data->getPassword());
        $userManager->save($user, true);
        return $user;
    }
}