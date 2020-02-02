
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    include './Tools/header.php';
    include './Controllers/' . $page . 'Controller.php';
    include './pages/' . $page . '.php';
    include './Tools/footer.php';
} else {
    include './Tools/header.php';
    include './pages/index.php';
    include './Tools/footer.php';
}
?>