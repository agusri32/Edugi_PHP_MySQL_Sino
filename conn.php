<?php
////////////////////// VARIABLE ////////////////////
$host="localhost";
$user="root";
$pass="";
$db="proj_sinodb";

////////////////////// KONEKSI ////////////////////
$link=mysqli_connect($host,$user,$pass,$db);

///////////////////// SETUP ///////////////////////
//ini_set('display_errors',FALSE); //production
//error_reporting(E_ALL ^ E_NOTICE); //sandbox

$waktu=date("Y-m-d H:i:s");
$setup1=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='paging_halaman'"));
$setup2=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='pesan_siswa'"));
$setup3=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='title_web'"));
$setup4=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='akses_kuesioner'"));
$setup5=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='pesan_ortu'"));

$entries=$setup1['nilai_setup'];
$pesan_siswa=$setup2['nilai_setup'];
$title=$setup3['nilai_setup'];
$kuesioner=$setup4['nilai_setup'];	
$pesan_ortu=$setup5['nilai_setup'];

$periode=mysqli_fetch_array(mysqli_query($link,"select * from setup_periode where status_aktif='yes'"));
$id_periode=$periode['id_periode'];
$semester=$periode['semester'];
$tahun_ajaran=$periode['tahun_ajaran'];

$query_register=mysqli_query($link,"select * from user_superadmin");
$cek_register=mysqli_num_rows($query_register);

$data=mysqli_fetch_array(mysqli_query($link,"select photo from setup_kontak_kami"));
$logo=$data['photo'];

///////////////////// FUNGSI //////////////////////
function formatBytes($size, $precision = 2){
    $base = log($size) / log(1024);
    $suffixes = array('', 'KB', 'MB', 'GB', 'TB');   
    return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
}

function insert_user($username,$nama_user,$domain){
	mysqli_query($link,"insert into tbl_user_pesan(username,nama_user,domain) values('$username','$nama_user','$domain')");
}

function update_user($username,$username_lama,$nama_user,$domain){
	mysqli_query($link,"update tbl_user_pesan set username='$username', nama_user='$nama_user',domain='$domain' where username='$username_lama'");
}

function delete_user($username){
	mysqli_query($link,"delete from tbl_user_pesan where username='$username'");
}

function login_validate($link) {
	$setup3=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='logout_otomatis'"));
	$logout_otomatis=$setup3['nilai_setup'];
	$_SESSION["expires_by"] = time() + $logout_otomatis;
}

function login_check() {
	$exp_time = $_SESSION["expires_by"];
	if (time() < $exp_time) {
		login_validate();
		return true; 
	}else{
		unset($_SESSION["expires_by"]);
		return false; 
	}
}

function user_online($link) {
	$username=$_SESSION['username'];
	mysqli_query($link,"update tbl_user_pesan set `online`='yes' where username='$username'");
}

function user_offline($link) {
	$username=$_SESSION['username'];
	mysqli_query($link,"update tbl_user_pesan set `online`='no' where username='$username'");
}
?>