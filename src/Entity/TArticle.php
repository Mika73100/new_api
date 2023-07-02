<?php

namespace App\Entity;

use App\Entity\base\TraitEntity;
use App\Repository\TArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TArticleRepository::class)]
class TArticle
{
    use TraitEntity;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 1000)]
    private ?string $description = null;


    #[ORM\ManyToOne(inversedBy: 'tArticles')]
    private ?TUser $fk_user = null;

    #[ORM\OneToMany(mappedBy: 'fk_article', targetEntity: TComment::class)]
    private Collection $tComments;

    #[ORM\ManyToOne(inversedBy: 'tArticles')]
    private ?TCategorie $fk_categories = null;

    public function __construct()
    {
        $this->tComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }



    public function getFkUser(): ?TUser
    {
        return $this->fk_user;
    }

    public function setFkUser(?TUser $fk_user): static
    {
        $this->fk_user = $fk_user;

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
            $tComment->setFkArticle($this);
        }

        return $this;
    }

    public function removeTComment(TComment $tComment): static
    {
        if ($this->tComments->removeElement($tComment)) {
            // set the owning side to null (unless already changed)
            if ($tComment->getFkArticle() === $this) {
                $tComment->setFkArticle(null);
            }
        }

        return $this;
    }

    public function getFkCategories(): ?TCategorie
    {
        return $this->fk_categories;
    }

    public function setFkCategories(?TCategorie $fk_categories): static
    {
        $this->fk_categories = $fk_categories;

        return $this;
    }


    //////////////////////ici je crée une nouvelle fonction dans l'entité /////////////////
    ///qui va me permettre de voir ce qu'a été envoyer dans la BDD sous forme de json//////
    public function tojson(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'fk_user' => $this->fk_user ? $this->fk_user->tojson() : null,
            'fk_categories' => $this->fk_categories ? $this->fk_categories->tojson() : null,

            'active' => $this->active,
            'date_save' => $this->date_save ? $this->date_save->format(format: 'c') : null
        ];
    }



}
