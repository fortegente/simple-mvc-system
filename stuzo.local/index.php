<?php
/*uncomment in development process*/

error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

include "application/Init.php";
Init::run();