<?php

/*
  Returns the base url of the website.
 */

function base_url() {
    return BASE_URL;
}

/*
  Gets the resulting URL for the website with a relative path.
  $relative is the path (URL) relative to the base path
 */

function site_url($relative) {
    return base_url() . $relative;
}

function db_date($date) {
    return date('d/m/Y', strtotime($date));
}

function frenchDays($day) {
    switch ($day) {
        case 1: return 'Lundi';
            break;
        case 2: return 'Mardi';
            break;
        case 3: return 'Mercredi';
            break;
        case 4: return 'Jeudi';
            break;
        case 5: return 'Vendredi';
            break;
        case 6: return 'Samedi';
            break;
        case 7: return 'Dimanche';
            break;
        default : '';
    }
}

function frenchMonth($month) {
    switch ($month) {
        case 1: return 'janvier';
            break;
        case 2: return 'février';
            break;
        case 3: return 'Mars';
            break;
        case 4: return 'Avril';
            break;
        case 5: return 'Mai';
            break;
        case 6: return 'Juin';
            break;
        case 7: return 'Juillet';
            break;
        case 8: return 'Août';
            break;
        case 9: return 'Septembre';
            break;
        case 10: return 'Octobre';
            break;
        case 11: return 'Novembre';
            break;
        case 12: return 'Décembre';
            break;
    }
}
