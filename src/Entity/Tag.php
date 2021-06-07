<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 * @ORM\Table(name="tags")
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=ArticleTag::class, mappedBy="tag")
     */
    private $article_tags;

    public function __construct()
    {
        $this->article_tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|ArticleTag[]
     */
    public function getArticleTags(): Collection
    {
        return $this->article_tags;
    }

    public function addArticleTag(ArticleTag $articleTag): self
    {
        if (!$this->article_tags->contains($articleTag)) {
            $this->article_tags[] = $articleTag;
            $articleTag->setTag($this);
        }

        return $this;
    }

    public function removeArticleTag(ArticleTag $articleTag): self
    {
        if ($this->article_tags->removeElement($articleTag)) {
            // set the owning side to null (unless already changed)
            if ($articleTag->getTag() === $this) {
                $articleTag->setTag(null);
            }
        }

        return $this;
    }
}
