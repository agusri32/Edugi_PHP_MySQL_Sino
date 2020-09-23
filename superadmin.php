<?php  session_start();

//koneksi terpusat
include "conn.php";

if(isset($_SESSION['username'])){
	?><script language="javascript">document.location.href='home.php';</script><?php
}

//untuk registrasi
if($cek_register==0){
	?><script language="javascript">document.location.href='install.php';</script><?php
}else{
	if(file_exists("install.php")){
		unlink("install.php");
	}
}

if (isset($_POST['login'])){
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	$domain=$_POST['domain'];	
	
	$kode=trim($_POST['kode']);
	if(md5($kode)===$_SESSION['RandVal']){

		//dapatkan id user pesan
		$row=mysqli_fetch_array(mysqli_query($link,"select id_user from tbl_user_pesan where username='$username'"));
		$id_user=$row['id_user'];
	
		$query=mysqli_query($link,"select * from user_superadmin where username='$username' and password='$password'");
		$cek=mysqli_num_rows($query);
		$row=mysqli_fetch_array($query);
		$id_superadmin=$row['id_superadmin'];
		$nama_superadmin=$row['nama_superadmin'];
		
		if($cek){
			$_SESSION['id_user']=$id_user;
			$_SESSION['username']=$username;
			$_SESSION['id_superadmin']=$id_superadmin;
			$_SESSION['domain']=$domain;
			$_SESSION['nama_account']=$nama_superadmin;
			$_SESSION['waktu']=date("Y-m-d H:i:s");
			login_validate();
			user_online($username);
	
			?><script language="javascript">document.location.href="home.php";</script><?php
			
		}else{
			?><script language="javascript">document.location.href="superadmin.php?status=Gagal Login";</script><?php
		}	
	
	}else{
		?>
		<script language="javascript">alert('Maaf, Kode yang Anda masukan salah!')</script>
		<script language="javascript">document.location.href="superadmin.php";</script>
		<?php
	}
					
}else{
	unset($_POST['login']);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Superadmin - SINO</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--  jquery core -->
<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
	$(document).pngFix( );
	});
</script>
</head>
<body id="login-bg" onLoad="document.postform.elements['username'].focus();"> 
 
<!-- Start: login-holder -->
<div id="login-holder">

	<!-- start logo -->
	<div id="logo-login">
		<a href="index.php" title="Back to Homepage"><img src="images/shared/logo.png" width="156" height="40" alt="" /></a>
	</div>
	<!-- end logo -->
	
	<div class="clear"></div>
	
	<!--  start loginbox ................................................................................. -->
	<div id="loginbox">
	
	<!--  start login-inner -->
	<div id="login-inner">
    	<p align="center"><font face="verdana" size="2" color="#333333">
		<?php 
		if($link){
			//echo "Berhasil koneksi";
		}else{
			echo "<font face='Courier New, Courier, mono' color=yellow>Gagal Koneksi Database!</font> <br><br>";
		}
		?>		
		<noscript>
			<font face="Courier New, Courier, mono" color="#FFFF00">System needs JavaScript activated!</font>
		</noscript>

				
		<?php  if(isset($_GET['status'])){ echo "&laquo;".$_GET['status']."&raquo;"; }?>
		</font></p>
        <p>&nbsp;</p>
        <form action="superadmin.php" method="post" name="postform">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Username</th>
			<td><input type="text"  class="login-inp" name="username"/></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" value="************"  name="password" onFocus="this.value=''" class="login-inp" /></td>
		</tr>
        	
        <tr>
          <th><img src="chaptcha.php" border="0" title="Code Captcha"/></th>
          <th><input name="kode" type="text" id="kode" class="login-inp" title="Please Input Code Captcha" size="10"></th>
        </tr>
        
		<tr>
			<th></th>
			<td>
			<input type="hidden" name="domain" value="superadmin" />
			<input type="submit" class="submit-login" name="login"/></td>
		</tr>
		</table>
        </form>
	</div>
    
    
    
 	<!--  end login-inner -->
	<div class="clear"></div>
 </div>
 <!--  end loginbox -->

</div>
<!-- End: login-holder -->
</body>

</html>