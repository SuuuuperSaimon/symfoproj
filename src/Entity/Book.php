<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bookName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bookAuthor;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $bookPrice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bookGenre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bookDesc;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookName(): ?string
    {
        return $this->bookName;
    }

    public function setBookName(string $bookName): self
    {
        $this->bookName = $bookName;

        return $this;
    }

    public function getBookAuthor(): ?string
    {
        return $this->bookAuthor;
    }

    public function setBookAuthor(string $bookAuthor): self
    {
        $this->bookAuthor = $bookAuthor;

        return $this;
    }

    public function getBookPrice(): ?string
    {
        return $this->bookPrice;
    }

    public function setBookPrice(string $bookPrice): self
    {
        $this->bookPrice = $bookPrice;

        return $this;
    }

    public function getBookGenre(): ?string
    {
        return $this->bookGenre;
    }

    public function setBookGenre(string $bookGenre): self
    {
        $this->bookGenre = $bookGenre;

        return $this;
    }

    public function getBookDesc(): ?string
    {
        return $this->bookDesc;
    }

    public function setBookDesc(?string $bookDesc): self
    {
        $this->bookDesc = $bookDesc;

        return $this;
    }
}
