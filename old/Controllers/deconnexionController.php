<?php
session_destroy();

header("refresh:1; url=index.php?page=index");
exit();
