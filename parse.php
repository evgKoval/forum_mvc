<?php

define('ROOT', dirname(__FILE__));

require_once ROOT . '/models/Post.php';
require_once ROOT . '/parser/simple_html_dom.php';

require_once 'db/db.php';
$db = $db->getConnection();

$html = new simple_html_dom();
$html = file_get_html('https://itc.ua/');

if ($html->innertext != '') {
    $parsedTitle = $html->find('.entry-title', 5)->plaintext;
    $parsedText = $html->find('.entry-excerpt', 0)->plaintext;

    Post::createPost($parsedTitle, $parsedText, '0', '0');
}