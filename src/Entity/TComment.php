<?php

namespace App\Entity;

use App\Entity\base\TraitEntity;
use App\Repository\TCommentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TCommentRepository::class)]
class TComment
{
    use TraitEntity;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1000)]
    private ?string $comment = null;

    #[ORM\ManyToOne(inversedBy: 'tComments')]
    private ?TUser $fk_user = null;

    #[ORM\ManyToOne(inversedBy: 'tComments')]
    private ?TArticle $fk_article = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

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

    public function getFkArticle(): ?TArticle
    {
        return $this->fk_article;
    }

    public function setFkArticle(?TArticle $fk_article): static
    {
        $this->fk_article = $fk_article;

        return $this;
    }
}
