<?php 
	require_once("../include/config.php"); 
	require_once("../include/fix_session.php");
	$user_login = trim($_POST["user_login"]);
	$pass_login =  trim($_POST["pass_login"]);
	if (($user_login =="") and ($pass_login ==""))
	{
			$msg = "Logout";
	}
	else
	{
		$msg = "";
		//$con = pg_connect($connection);
		$sql = "SELECT a.*";
		$sql .= " FROM user1 a ";
		$sql .= " WHERE upper(userid) = upper('$user_login') and upper(pass)  = upper('$pass_login') and a.status ='t' ";
		
		//echo($sql);
		
		$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
		
		
		if ($row = mysql_fetch_assoc($result)) 
		{
			$userid = $row["userid"];
			$username = $row["nama_user"];
			$id_m_departemen = $row["id_m_departemen"];
			$nama_departemen = strtoupper (!empty($row["nama_departemen"]));
			
		}
		else
		{
			$msg = "Maaf, USER ID atau PASSWORD Anda salah!";
		}
	}
	
	if ($msg == "")
	{
		session_register("userid");
		session_register("username");
		session_register("nama_departemen");
				
		$_SESSION["userid"] = $userid;
		$_SESSION["user_id"] = $userid;
		$_SESSION["username"] = $username;
		$_SESSION["nama_departemen"] = $nama_departemen;
		
		$header_location = "../home/";
	}
	
	else
	{
		session_register($pesan);
		if($msg != "Logout")
		{
		$_SESSION[$pesan] = $msg;
		}
		$header_location = "index.php";
	}

	header("Location: $header_location");
