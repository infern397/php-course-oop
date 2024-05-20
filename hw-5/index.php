<?php

const DB_HOST = 'localhost';
const DB_NAME = 'php1simple';
const DB_USER = 'root';
const DB_PASS = '';

include_once('DBHelper.php');
include_once('SelectBuilder.php');

$db = new DBHelper();

//niceDump($db->select('SELECT * FROM messages WHERE id_message = :id', [ 'id' => 5 ]));
/* 
var_dump(
	$db->select(
		new SelectBuilder('messages')
	)
); */

echo new SelectBuilder('messages');

function niceDump($any){
	echo '<pre>';
	var_dump($any);
	echo '</pre>';
}

/* (new SelectBuilder('messages'))->order_by('id_messages DESC')->where
 */