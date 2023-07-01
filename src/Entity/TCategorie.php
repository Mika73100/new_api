<?php

namespace App\Entity;

use App\Entity\base\TraitEntity;
use App\Repository\TCategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TCategorieRepository::class)]
class TCategorie
{
    use TraitEntity;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'fk_categories', targetEntity: TArticle::class)]
    private Collection $tArticles;


    public function __construct()
    {
        $this->tArticles = new ArrayCollection();
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

    public function setDescription(?string $description): static
    {
        $this->description = $description;

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
            $tArticle->setFkCategories($this);
        }

        return $this;
    }

    public function removeTArticle(TArticle $tArticle): static
    {
        if ($this->tArticles->removeElement($tArticle)) {
            // set the owning side to null (unless already changed)
            if ($tArticle->getFkCategories() === $this) {
                $tArticle->setFkCategories(null);
            }
        }

        return $this;
    }

}
