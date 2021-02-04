<?php

define('IN_SITE', 	true);
define('IN_ADMIN', 	true);
include_once("../includes/common.php");

if ( $admins->Admins_Id != ANONYMOUS )
{
    $admins->DestroyAdmin();
}

header("location: ./login.php");

?>

