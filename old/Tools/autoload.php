<?php
function chargerPage($page) {
    $path = __DIR__;
    $path = substr($path,-30,25);
    require $path . "Controllers\\" . $page . 'Controller.php';
}

spl_autoload_register('chargerPage');
