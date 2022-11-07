<?php

$filesInFolder = scandir('./imgs/');

for ($i = 2; $i < count($filesInFolder); $i++) {
    $fileName = $filesInFolder[$i];
    $size = filesize('./imgs/' . $filesInFolder[$i]) / 1024 . ' КБайт';
    $extension = new SplFileInfo('./imgs/' . $filesInFolder[$i]);

    echo 
    '<div class="file-list__item">

        <div class="item__icon"></div>
        <div class="item__desc">
            <p class="item__name">'. $fileName .'</p>
            <p class="item__size">'. $size .'</p>
            <p>'. $extension->getExtension() .'</p>
        </div>

    </div>';
}