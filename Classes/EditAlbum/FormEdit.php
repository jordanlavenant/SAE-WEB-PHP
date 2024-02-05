<?php
declare(strict_type=1);

namespace EditAlbum;

class FormEdit {

    private Object $singleData;

    function __construct(Object $data) {    
        $this->singleData = $data;
    }

    function render(): string {
        return sprintf("
        <div class='header'>
            <a href='index.php?action=home'>
                <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
            </a>
            <h1>détail</h1>
        </div>
         <form action='index.php?action=edit&id=%s' method='post'>
            <div class='modification-album'> 
                <input type='text' name='album_info' value='%s'>
            </div>
            <section class='album-container'>
                <div class='content'>
                    <div class='left-part'>
                        <img src='%s' alt='%s'>
                        <div class='album-info'>
                            <input type='text' name='album_title' value='%s'>
                            <textarea name='album_description'>%s</textarea>
                            <div>
                                <input type='text' name='album_detail1' value='%s'>
                            </div>
                        </div>
                    </div>
                    <div class='buttons'>
                        <input type='submit' value='Submit'>
                    </div>
                </div>
            </section>
        </form>
        </main>",
            $this->singleData->getEntryId(),
            $this->singleData->getImg(),
            $this->singleData->getTitle(),
            $this->singleData->getTitle(),
            $this->singleData->getNomGroupe(),
            $this->singleData->getReleaseYear(),
            $this->singleData->getGenreString(),
        );
    }
    /*
    private Object $editData; 

    function __construct(Object $data) {
        $this->editData = $data;
        print_r($this->editData.getEntryId());
    }

    function render(): string{
        return sprintf("
            <div class='header'>
                <a href='index.php?action=home'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
                </a>
                <h1>détail édition</h1>
            </div>
                 <form action='index.php?action=edit&id=%s' method='post'>
                    <div class='modification-album'> 
                        <input type='text' name='album_info' value='%s'>
                    </div>
                    <section class='album-container'>
                        <div class='content'>
                            <div class='left-part'>
                                <img src='%s' alt='%s'>
                                <div class='album-info'>
                                    <input type='text' name='album_title' value='%s'>
                                    <textarea name='album_description'>%s</textarea>
                                    <div>
                                        <input type='text' name='album_detail1' value='%s'>
                                        <input type='text' name='album_detail2' value='%s'>
                                    </div>
                                </div>
                            </div>
                            <div class='buttons'>
                                <input type='submit' value='Submit'>
                            </div>
                        </div>
                    </section>
                </form>
                </main>",
                $this->editData.getEntryId(),
                $this->editData.getImg(),
                $this->editData.getTitle(),
                $this->editData.getTitle(),
                $this->editData.getNomGroupe(),
                $this->editData.getReleaseYear(),
                $this->editData.getGenreString(),
        );
    }*/
}