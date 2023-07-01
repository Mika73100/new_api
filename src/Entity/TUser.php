<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use App\Entity\base\TraitEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TUserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: TUserRepository::class)]
#[UniqueEntity(fields:"username", message:"username already used")]

class TUser 
{
    use TraitEntity;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique:true)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?DateTimeInterface $naissance = null;

    #[ORM\ManyToOne(inversedBy: 'tUsers')]
    private ?TPays $fk_pays = null;

    #[ORM\OneToMany(mappedBy: 'fk_user', targetEntity: TArticle::class)]
    private Collection $tArticles;

    #[ORM\OneToMany(mappedBy: 'fk_user', targetEntity: TComment::class)]
    private Collection $tComments;

    #[ORM\OneToMany(mappedBy: 'fk_User', targetEntity: TCourrier::class)]
    private Collection $tCourriers;

    #[ORM\Column(length: 3000, nullable: true)]
    private ?string $password = null;

    #[ORM\Column]
    private array $roles = [];


    public function __construct()
    {
        $this->date_save = new DateTime();
        $this->tArticles = new ArrayCollection();
        $this->tComments = new ArrayCollection();
        $this->tCourriers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getNaissance(): ?DateTimeInterface
    {
        return $this->naissance;
    }

    public function setNaissance(?DateTimeInterface $naissance): static
    {
        $this->naissance = $naissance;

        return $this;
    }

    public function getFkPays(): ?TPays
    {
        return $this->fk_pays;
    }

    public function setFkPays(?TPays $fk_pays): static
    {
        $this->fk_pays = $fk_pays;

        return $this;
    }

    /**
     * @return Collection<int, TArticle>
     */
    public function getTArticles(): Collection
    {
        return $this->tArticles;
    }

    public function addTArticle(TArticle $tArticle): static
    {
        if (!$this->tArticles->contains($tArticle)) {
            $this->tArticles->add($tArticle);
            $tArticle->setFkUser($this);
        }

        return $this;
    }

    public function removeTArticle(TArticle $tArticle): static
    {
        if ($this->tArticles->removeElement($tArticle)) {
            // set the owning side to null (unless already changed)
            if ($tArticle->getFkUser() === $this) {
                $tArticle->setFkUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TComment>
     */
    public function getTComments(): Collection
    {
        return $this->tComments;
    }

    public function addTComment(TComment $tComment): static
    {
        if (!$this->tComments->contains($tComment)) {
            $this->tComments->add($tComment);
            $tComment->setFkUser($this);
        }

        return $this;
    }

    public function removeTComment(TComment $tComment): static
    {
        if ($this->tComments->removeElement($tComment)) {
            // set the owning side to null (unless already changed)
            if ($tComment->getFkUser() === $this) {
                $tComment->setFkUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TCourrier>
     */
    public function getTCourriers(): Collection
    {
        return $this->tCourriers;
    }

    public function addTCourrier(TCourrier $tCourrier): static
    {
        if (!$this->tCourriers->contains($tCourrier)) {
            $this->tCourriers->add($tCourrier);
            $tCourrier->setFkUser($this);
        }

        return $this;
    }

    public function removeTCourrier(TCourrier $tCourrier): static
    {
        if ($this->tCourriers->removeElement($tCourrier)) {
            // set the owning side to null (unless already changed)
            if ($tCourrier->getFkUser() === $this) {
                $tCourrier->setFkUser(null);
            }
        }

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

}
