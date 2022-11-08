<?php

if (isset($_FILES['img'])) loadingFile($_FILES['img']);
else if (isset($_GET['get'])) getFiles();
else if (isset($_POST['id'])) deleteFile($_POST['id']);

function loadingFile($uploadFile) {
    $uploadDir = './files/';
    copy($uploadFile['tmp_name'], $uploadDir . $uploadFile['name']);
}

function getFiles() {
    $filesInFolder = array_diff(scandir('./files/'), array('..', '.'));

    foreach ($filesInFolder as $key=>$file) {
        $data[] = [$key => './files/' . $file];
        file_put_contents('file-list.txt', json_encode($data, JSON_UNESCAPED_UNICODE));

        $size = filesize('./files/' . $file) / 1024 . ' КБайт';
        $extension = new SplFileInfo('./files/' . $file);
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
        '<div class="file-list__item" idAttr="'. $key .'">

            <div class="item__group">
                <div class="item__icon '. $iconClass .'"></div>
                <div class="item__desc">
                    <p class="item__name">'. $file .'</p>
                    <p class="item__size">'. $size .'</p>
                </div>
            </div>
            <button class="item__btn-delete"></button>

        </div>';
    }
}

function deleteFile($id) {
    $files = json_decode(file_get_contents('file-list.txt'), JSON_UNESCAPED_UNICODE);

    foreach($files as $file) {
        unlink($file[$id]);
    }
}