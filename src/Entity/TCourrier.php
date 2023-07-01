<?php

namespace App\Entity;

use App\Repository\TCourrierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TCourrierRepository::class)]
class TCourrier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1000)]
    private ?string $message = null;

    #[ORM\ManyToOne(inversedBy: 'tCourriers')]
    private ?TUser $fk_User = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getFkUser(): ?TUser
    {
        return $this->fk_User;
    }

    public function setFkUser(?TUser $fk_User): static
    {
        $this->fk_User = $fk_User;

        return $this;
    }
}
