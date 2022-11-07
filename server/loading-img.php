<?php

$uploadDir = './imgs/';
$uploadFile = $_FILES['img'];

copy($uploadFile['tmp_name'], $uploadDir . $uploadFile['name']);