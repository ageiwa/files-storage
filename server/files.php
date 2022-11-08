<?php

if (isset($_FILES['img'])) loadingFile($_FILES['img']);
else if (isset($_GET['get'])) getFiles();

function loadingFile($uploadFile) {
    $uploadDir = './files/';
    copy($uploadFile['tmp_name'], $uploadDir . $uploadFile['name']);
}

function getFiles() {
    $filesInFolder = scandir('./files/');

    for ($i = 2; $i < count($filesInFolder); $i++) {
        $fileName = $filesInFolder[$i];
        $size = filesize('./files/' . $filesInFolder[$i]) / 1024 . ' КБайт';
        $extension = new SplFileInfo('./files/' . $filesInFolder[$i]);
        $iconClass = '';

        if ($extension->getExtension() === 'docx' || $extension->getExtension() === 'txt') {
            $iconClass = 'docs';
        }
        else if ($extension->getExtension() === 'xlsx') {
            $iconClass = 'sheets';
        }
        else if ($extension->getExtension() === 'png') {
            $iconClass = 'img';
        }
        else {
            $iconClass = 'unk-file';
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