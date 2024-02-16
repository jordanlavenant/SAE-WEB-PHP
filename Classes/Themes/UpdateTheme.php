<?php

function getThemeHexa($theme) {
    switch ($theme) {
        case 'bleu':
            return '#0066ff';
            break;
        case 'violet':
            return '#d032e6';
            break;
        case 'rose':
            return '#d2335c';
            break;
        case 'vert':
            return '#44cbc3';
            break;
        case 'mauve':
            return '#0031d1';
            break;
        case 'saumon':
            return '#d27972';
            break;
        case 'vintage':
            return '#9e9cd8';
            break;
        default:
            return '#0066ff';
            break;
    }
}