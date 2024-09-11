<?php
function escape($string){
    return htmlentities($string, EN_QUOTES, 'UTF-8');
}