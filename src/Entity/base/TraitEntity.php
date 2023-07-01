<?php 


namespace App\Entity\base;


use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;

trait TraitEntity
{
    #[Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $date_save = null;

    #[ORM\Column]
    private ?bool $active = true;

    public function getDateSave(): ?DateTimeInterface
    {
        return $this->date_save;
    }

    public function setDateSave(DateTimeInterface $date_save): static
    {
        $this->date_save = $date_save;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }
}