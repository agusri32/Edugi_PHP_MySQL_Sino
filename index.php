<?php  session_start();

//koneksi terpusat
include "conn.php";
?>

<?php
if(isset($_SESSION['username'])){
	?><script language="javascript">document.location.href='home.php';</script><?php
}

if (isset($_POST['login'])){
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	$domain=$_POST['domain'];
	
	//dapatkan id user pesan
	$row=mysqli_fetch_array(mysqli_query($link,"select id_user from tbl_user_pesan where username='$username'"));
	$id_user=$row['id_user'];
		
	if($domain=="admin"){
		$query=mysqli_query($link,"select * from user_admin where username='$username' and password='$password' and `locked`='no'");
		
		$data=mysqli_fetch_array(mysqli_query($link,"select * from user_admin where username='$username' and password='$password'"));
		$locked=$data['locked'];
		
		if($locked=='yes'){
			$ket=" - Locked";
		}else{
			$ket="";
		}
		
		$cek=mysqli_num_rows($query);
		$row=mysqli_fetch_array($query);
		$id_admin=$row['id_admin'];
		$nama_admin=$row['nama_admin'];
		$locked=$row['locked'];
		
		if($cek){
			$_SESSION['id_user']=$id_user;
			$_SESSION['username']=$username;
			$_SESSION['id_admin']=$id_admin;
			$_SESSION['domain']=$domain;
			$_SESSION['nama_account']=$nama_admin;
			$_SESSION['waktu']=date("Y-m-d H:i:s");
			
			//login_validate();
			user_online($link);;

			?><script language="javascript">document.location.href="home.php";</script><?php
			
		}else{
			?><script language="javascript">document.location.href="index.php?status=Gagal Login <?php echo $ket;?>";</script><?php
		}	
	}
	
	if($domain=="guru"){
		$query=mysqli_query($link,"select * from data_guru where username='$username' and password='$password' and `locked`='no'");
		
		$data=mysqli_fetch_array(mysqli_query($link,"select * from data_guru where username='$username' and password='$password'"));
		$locked=$data['locked'];
		
		if($locked=='yes'){
			$ket=" - Locked";
		}else{
			$ket="";
		}
		
		$cek=mysqli_num_rows($query);
		$row=mysqli_fetch_array($query);
		$id_guru=$row['id_guru'];
		$nama_guru=$row['nama_guru'];
		$photo=$row['photo'];
		
		if($cek){
			$_SESSION['id_user']=$id_user;
			$_SESSION['username']=$username;
			$_SESSION['id_guru']=$id_guru;
			$_SESSION['domain']=$domain;
			$_SESSION['nama_account']=$nama_guru;
			$_SESSION['waktu']=date("Y-m-d H:i:s");
			$_SESSION['photo']=$photo;
			
			//login_validate();
			user_online($link);;
			
			?><script language="javascript">document.location.href="home.php";</script><?php
			
		}else{
			?><script language="javascript">document.location.href="index.php?status=Gagal Login <?php echo $ket;?>";</script><?php
		}
	}
	
	if($domain=="siswa"){
		$query=mysqli_query($link,"select * from data_siswa where username='$username' and password='$password' and `locked`='no'");
		
		$data=mysqli_fetch_array(mysqli_query($link,"select * from data_siswa where username='$username' and password='$password'"));
		$locked=$data['locked'];
		
		if($locked=='yes'){
			$ket=" - Locked";
		}else{
			$ket="";
		}
		
		$cek=mysqli_num_rows($query);
		$row=mysqli_fetch_array($query);
		$id_siswa=$row['id_siswa'];
		$nama_siswa=$row['nama_siswa'];
		$nama_siswa=$row['nama_siswa'];
		$photo=$row['photo'];
		
		$siswa=mysqli_fetch_array(mysqli_query($link,"select siswa.nama_siswa, siswa.nis, kelas.nama_kelas, kelas.id_kelas from tbl_ruangan ruangan, data_siswa siswa, setup_kelas kelas where ruangan.id_siswa=siswa.id_siswa and ruangan.id_siswa='$id_siswa' and ruangan.id_kelas=kelas.id_kelas"));
		$nis=$siswa['nis'];
		$nama_kelas=$siswa['nama_kelas'];
		$id_kelas=$siswa['id_kelas'];
		
		if($cek){
			$_SESSION['id_user']=$id_user;
			$_SESSION['username']=$username;
			$_SESSION['id_siswa']=$id_siswa;
			$_SESSION['domain']=$domain;
			$_SESSION['nama_account']=$nama_siswa;
			
			$_SESSION['id_kelas']=$id_kelas;
			$_SESSION['nama_kelas']=$nama_kelas;
			$_SESSION['nis']=$nis;
			$_SESSION['waktu']=date("Y-m-d H:i:s");
			$_SESSION['photo']=$photo;
			
			//login_validate();
			user_online($link);;
			
			?><script language="javascript">document.location.href="home.php";</script><?php
			
		}else{
			?><script language="javascript">document.location.href="index.php?status=Gagal Login <?php echo $ket;?>";</script><?php
		}
	}
	
	if($domain=="ortu"){
		$query=mysqli_query($link,"select * from data_orangtua where username='$username' and password='$password'");
		
		$cek=mysqli_num_rows($query);
		$row=mysqli_fetch_array($query);
		$id_ortu=$row['id_orangtua'];
		$nama_orangtua=$row['nama_orangtua'];
		$photo=$row['photo'];
		
		if($cek){
			$_SESSION['id_user']=$id_user;
			$_SESSION['username']=$username;
			$_SESSION['id_ortu']=$id_ortu;
			$_SESSION['domain']=$domain;
			$_SESSION['nama_account']=$nama_orangtua;
			$_SESSION['waktu']=date("Y-m-d H:i:s");
			$_SESSION['photo']=$photo;
			
			//login_validate();
			user_online($link);;
			
			?><script language="javascript">document.location.href="home.php";</script><?php
			
		}else{
			?><script language="javascript">document.location.href="index.php?status=Gagal Login";</script><?php
		}
	}
}else{
	unset($_POST['login']);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<title><?php echo $title;?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Sistem Informasi Nilai Online (SINO) adalah sebuah sistem berbasis web yang menampilkan informasi nilai siswa dalam suatu instansi pendidikan. Terintegrasi antara Admin,Guru,Siswa,dan Orang Tua"/>
	<meta name="keywords" content="web,sistem,informasi,nilai,online,ri32,agus sumarna,full version,developer"/>
	<meta content="index,follow" name="robots"/>
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
		<a href="index.php"><img src="images/shared/logo.png" width="156" height="40" alt="" /></a>
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
		
		<?php  if(isset($_GET['status'])){ echo "&laquo;".$_GET['status']."&raquo;"; }?>
		
		<noscript>
		  <font face="Courier New, Courier, mono" color="#FFFF00">System needs JavaScript activated!</font>
		</noscript>
		
		</font></p>
        <p>&nbsp;</p>
        <form action="index.php" method="post" name="postform">
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
			<th>Akses</th>
			<td>
             <select name="domain" class="styledselect">
            	<option value="admin"> ADMIN </option>
                <option value="guru"> GURU </option>
                <option value="siswa"> SISWA </option>
				<option value="ortu"> ORANG TUA </option>
            </select>            
            </td>
		</tr>
		<tr>
			<th><a href="./superadmin.php" title="Login Superadmin"><img src="./images/superadmin.png" width="32" height="30" /></a></th>
			<td><input type="submit" class="submit-login" name="login"/>			
            </td>
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