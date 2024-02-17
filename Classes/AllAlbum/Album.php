<?php
declare(strict_types=1);


namespace AllAlbum;

require_once('BD/getBd.php');
use AllAlbum\GenericAlbum;

class Album extends GenericAlbum
{
    function renderCard(): string {
        return sprintf(
            "<a href='index.php?action=album&id=" . trim(strval($this->getEntryId())) . "' class='album'>
                <img src='%s' alt='%s'>
                <div class='album-info'>
                    <h3>%s</h3>
                    <p>%s</p>
                </div>
            </a>",
            $this->getImg(),
            $this->getTitle(),
            $this->getTitle(),
            $this->getNomGroupe()  
        );
    }


    function calcNote() {   
        $note = getNoteAlbum($_SESSION['idU'], $this->getEntryId())['note'];
        $starEmpty = "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' style='fill:" . $_SESSION['hexa'] . ";transform: ;msFilter:;'><path d='m6.516 14.323-1.49 6.452a.998.998 0 0 0 1.529 1.057L12 18.202l5.445 3.63a1.001 1.001 0 0 0 1.517-1.106l-1.829-6.4 4.536-4.082a1 1 0 0 0-.59-1.74l-5.701-.454-2.467-5.461a.998.998 0 0 0-1.822 0L8.622 8.05l-5.701.453a1 1 0 0 0-.619 1.713l4.214 4.107zm2.853-4.326a.998.998 0 0 0 .832-.586L12 5.43l1.799 3.981a.998.998 0 0 0 .832.586l3.972.315-3.271 2.944c-.284.256-.397.65-.293 1.018l1.253 4.385-3.736-2.491a.995.995 0 0 0-1.109 0l-3.904 2.603 1.05-4.546a1 1 0 0 0-.276-.94l-3.038-2.962 4.09-.326z'></path></svg>";
        $starFull = "<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' style='fill:" . $_SESSION['hexa'] . ";transform: ;msFilter:;'><path d='M21.947 9.179a1.001 1.001 0 0 0-.868-.676l-5.701-.453-2.467-5.461a.998.998 0 0 0-1.822-.001L8.622 8.05l-5.701.453a1 1 0 0 0-.619 1.713l4.213 4.107-1.49 6.452a1 1 0 0 0 1.53 1.057L12 18.202l5.445 3.63a1.001 1.001 0 0 0 1.517-1.106l-1.829-6.4 4.536-4.082c.297-.268.406-.686.278-1.065z'></path></svg>";
        
        $notation = $note;
        $starsFilled = '';
        $starsEmpty = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $notation) {
                $starsFilled .= sprintf($starFull);
            } else {
                $starsEmpty .= sprintf($starEmpty);
            }
        }        
        return $starsFilled . $starsEmpty;
    }


    function renderCompact(): string {
        return sprintf(
            "<tr onclick='document.location = `index.php?action=album&id=" . trim(strval($this->getEntryId())) . "`';>
                <td><img src='%s' alt='%s'>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td><div>%s</div></td>
            </tr>",
            $this->getImg(),
            $this->getTitle(),
            $this->getTitle(),
            $this->getNomGroupe(),
            $this->getParent(),
            $this->getReleaseYear(),
            $this->calcNote()
        );
    }
}