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

    //////////////////////ici je crée une nouvelle fonction dans l'entité /////////////////
    ///qui va me permettre de voir ce qu'a été envoyer dans la BDD sous forme de json//////
    public function tojson(): array
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'fk_user' => $this->fk_user ? $this->fk_user->tojson() : null,
            'fk_article' => $this->fk_article ? $this->fk_article->tojson() : null,

                        
            'active' => $this->active,
            'date_save' => $this->date_save ? $this->date_save->format(format: 'c') : null
        ];
    }
}
