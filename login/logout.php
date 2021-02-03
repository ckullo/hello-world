<?php 
	require_once("../include/config.php"); 
	require_once("../include/fix_session.php"); ?>
<?php
	session_unregister("userid");
	session_unregister("user_id");
	session_unregister("user_name");
	session_unregister("username");
	session_unregister($pesan);
    session_destroy();
	//header("Location: ../include/session.php");
	header("Location: login.php");
?>
