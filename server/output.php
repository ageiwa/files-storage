<?php

$filesInFolder = scandir('./imgs/');

for ($i = 2; $i < count($filesInFolder); $i++) {
    echo 
    '<div class="file-list__item">
        <img class="item__img" src="server/imgs/'. $filesInFolder[$i] .'">
        <p class="item__name">'. $filesInFolder[$i] .'</p>
    </div>';
}