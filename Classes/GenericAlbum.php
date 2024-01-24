<?php

declare(strict_types=1);

abstract class GenericAlbum implements RenderAlbumInterface
{
    protected string $nomGroupe;
    protected int $entryId;
    protected array $genre;
    protected string $img = "data/images/";
    protected string $parent;
    protected int $releaseYear;
    protected string $title;

    function __construct(
        string $nomGroupe, 
        int $entryId, 
        array $genre, 
        string $img,
        string $parent, 
        int $releaseYear,
        string $title
    )
    {
        $this->nomGroupe = $nomGroupe;
        $this->entryId = $entryId;
        $this->genre = $genre;
        $this->img .= $img;
        $this->parent = $parent;
        $this->releaseYear = $releaseYear;
        $this->title = $title;
    }

    function __toString(): string {
        return $this->render();
    }

    function getNomGroupe(): string {
        return $this->nomGroupe;
    }

    function getEntryId(): int {
        return $this->entryId;
    }

    function getGenre(): array {
        return $this->genre;
    }

    function getImg(): string {
        return $this->img;
    }

    function getParent(): string {
        return $this->parent;
    }

    function getReleaseYear(): int {
        return $this->releaseYear;
    }

    function getTitle(): string {
        return $this->title;
    }
}
