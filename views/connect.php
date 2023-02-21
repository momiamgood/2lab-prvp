<?php

$mysqli = mysqli_connect('localhost', 'root', '', 'cards');
if (mysqli_errno($mysqli)) echo 'Проверьте подключение БД';
