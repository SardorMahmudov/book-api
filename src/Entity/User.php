<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\User\FooDto;
use App\Controller\UserCreateAction;
use App\Controller\UserFooAction;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */

#[ApiResource(
    collectionOperations: [
        'get',
        'createUser' => [
            'method' => 'post',
            'path' => 'users/my/',
            'controller' => UserCreateAction::class
        ],
        'foo'=> [
            'method' => 'post',
            'path' => 'users/foo',
            'controller' => UserFooAction::class,
            'input' => FooDto::class
        ],
        'auth' => [
            'method' => 'post',
            'path' => 'authentication_token'
        ]
    ],
    itemOperations: ['delete','get'],
    denormalizationContext: ['groups' => ['user:write']],
    normalizationContext: ['groups' => ['user:read']]

)]
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['user:read'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     * @Assert\NotBlank()
     */
    #[Groups(['user:read','user:write'])]
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['user:write'])]
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getSalt(): string
    {
        return '';
    }

    public function getUsername():string
    {
        return $this->getEmail();
    }

    public function eraseCredentials()
    {
    }
}
