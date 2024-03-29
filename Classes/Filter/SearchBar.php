<?php 
declare(strict_types=1);

namespace Filter;

class SearchBar {

    function __construct() {}

    function render() {
        return sprintf(
            '<form action="index.php?action=home" id="searchbar" method="post">
                <input type="text" name="search" placeholder="groupe, album, genre, compositeur, année, titre">
                <input type="submit" value="rechercher">
            </form>'
        );
    }
}