<?php
require_once './helpers.php';

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'lessons';

$connection = sqlConnect($host, $user, $password, $db);

/*$res = sqlSelect($connection, 'books', ['id', 'title'], ["title like 'Harry%'"]);
$res2 = sqlSelect($connection, 'books', 'author');*/

// Homework 6 TASKS:

//mysqlInsert($connection, 'books', ['title' => 'Война и Мир'/*, 'author' => 'Лев Толстой'*/]);
//mysqlInsert($connection, 'books', ['title' => 'Progress and Poverty', 'author' => 'Henry George', 'year' => 1910]);

# !Тип [year] работает только с годами 1901-2155 в  MariaDB
//mysqlUpdate($connection, 'books', ['id' => 3], ['title' => 'Война и Мир', 'author' => 'Лев Толстой']);
//mysqlUpdate($connection, 'books', ['title' => 'Война и Мир'], ['title' => 'Война и Мир, Лев Толстой']);
//mysqlUpdate($connection, 'books', ['id' => 1, 'title' => 'Война и Мир'], ['title' => 'Война и Мир, Лев Толстой']);

//mysqlDelete($connection, 'books', ['id' => 4]);
//mysqlDelete($connection, 'books', ['title' => 'Harry Potter']);
//mysqlDelete($connection, 'books', ['id' => 1, 'title' => 'Harry Potter']);

sqlClose($connection);
