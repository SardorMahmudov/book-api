<?php


namespace App\Component\User;


use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFactory
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function create(string $email, string $password):User
    {
        $user = new User();
        $user->setEmail($email);
        $hash = $this->encoder->encodePassword($user, $password);
        $user->setPassword($hash);

        return $user;
    }
}