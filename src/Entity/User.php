<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

use function PHPUnit\Framework\returnSelf;
use function PHPUnit\Framework\stringContains;

#[UniqueEntity('Email')]
#[ORM\EntityListeners(['App\EntityListener\UserListener'])]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $Lastname = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email()]
    private ?string $Email;

    #[ORM\Column]
    private ?string $Phone = null;

    private ?string $plainPassword = null;

    #[ORM\Column(length: 255)]
    private ?string $Password = 'password';

    #[ORM\Column]
    public array $Role = [];

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true, onDelete:"CASCADE")]
    public ?Company $CompanyId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->Firstname;
    }

    public function setFirstname(string $Firstname): self
    {
        $this->Firstname = $Firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->Lastname;
    }

    public function setLastname(string $Lastname): self
    {
        $this->Lastname = $Lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->Phone;
    }

    public function setPhone(int $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getRoles(): array
    {
        $Role = $this->Role;
        $Role[] = 'ROLE_USER';

        return array_unique($Role);
    }

    public function setRole(?array $Role): self
    {
        $this->Role = $Role;

        return $this;
    }

    public function getCompanyId(): ?Company
    {
        return $this->CompanyId;
    }

    public function setCompanyId(?Company $CompanyId): self
    {
        $this->CompanyId = $CompanyId;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->Email;
    }

    public function eraseCredentials()
    {
        
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

}
