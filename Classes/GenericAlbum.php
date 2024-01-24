<?php

declare(strict_types=1);

abstract class GenericAlbum implements RenderAlbumInterface
{
    protected string $nomGroupe;
    protected int $entryId;
    protected string $genre;
    protected string $img;
    protected string $parent;
    protected int $releaseYear;
    protected string $title;

    function __construct(
        string $nomGroupe, 
        int $entryId, 
        string $genre, 
        string $img,
        string $parent, 
        int $releaseYear,
    )
    {
        $this->nomGroupe = $nomGroupe;
        $this->entryId = $entryId;
        $this->genre = $genre;
        $this->img = $img;
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

    function getGenre(): string {
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
