<?php

include_once('istorage.php');
include_once('article.php');
include_once('filestorage.php');

$ms1 = FileStorage::getInstance('articles.txt');
$ms2 = FileStorage::getInstance('articles.txt');
$ms3 = FileStorage::getInstance('articles.txt');
$ms4 = FileStorage::getInstance('articles.txt');
echo '<pre>';
print_r($ms1);
echo '<hr>';
print_r($ms2);
echo '<hr>';
print_r($ms3);
echo '<hr>';
print_r($ms4);
echo '<hr>';

echo '</pre>';

//$art1 = new Article($ms);
//$art1->create(['title' => 'New art', 'content' => 'Content new art']);
//$art1->save();
//
//$art2 = new Article($ms);
//$art2->load(1);
//echo '<pre>';
//print_r($art2);
//echo '</pre>';
//
//$art2->title = 'NZ';
//$art2->save();
//
//$art3 = new Article($ms);
//$art3->load(2);
//echo '<pre>';
//print_r($art3);
//echo '</pre>';