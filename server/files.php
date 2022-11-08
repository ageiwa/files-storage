<?php

if (isset($_FILES['img'])) loadingFile();
else if (isset($_GET['get'])) getFiles();

function loadingFile() {
    $uploadDir = './imgs/';
    $uploadFile = $_FILES['img'];

    copy($uploadFile['tmp_name'], $uploadDir . $uploadFile['name']);
}

function getFiles() {
    $filesInFolder = scandir('./imgs/');

    for ($i = 2; $i < count($filesInFolder); $i++) {
        $fileName = $filesInFolder[$i];
        $size = filesize('./imgs/' . $filesInFolder[$i]) / 1024 . ' КБайт';
        $extension = new SplFileInfo('./imgs/' . $filesInFolder[$i]);
        $iconClass = '';

        if ($extension->getExtension() === 'docx' || $extension->getExtension() === 'txt' || $extension->getExtension() === 'xlsx') {
            $iconClass = 'doc';
        }

        echo 
        '<div class="file-list__item">

            <div class="item__group">
                <div class="item__icon '. $iconClass .'"></div>
                <div class="item__desc">
                    <p class="item__name">'. $fileName .'</p>
                    <p class="item__size">'. $size .'</p>
                </div>
            </div>
            <button class="item__btn-delete"></button>

        </div>';
    }
}