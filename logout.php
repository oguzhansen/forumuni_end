<?php

session_start();

setcookie("kadi", "", time() - (60*60*24*365));

session_destroy();

header("Location: anasayfa");

?>