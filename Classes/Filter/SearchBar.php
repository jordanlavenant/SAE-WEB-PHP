<?php 
declare(strict_types=1);

namespace Filter;

class SearchBar {

    function __construct() {}

    function render() {
        return sprintf(
            '<form action="" id="searchbar" method="post">
            <input type="text" name="search" placeholder="artiste, album, genre">
            <input type="submit" value="rechercher">
            </form>'
        );
    }
}