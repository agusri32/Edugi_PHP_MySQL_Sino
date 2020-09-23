<?php
if(!isset($_SESSION['domain'])){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<?php
/*
green > input
yellow > delete
blue > edit
red > error
*/

if($_GET['status']=='0'){
?>
<div id="message-red">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="red-left">Terdapat Kesalahan! <?php echo mysqli_error();?></td>
	<td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
</tr>
</table>
</div>
<?php
}

if($_GET['status']=='1'){
?>
<div id="message-green">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="green-left">Data berhasil disimpan</td>
	<td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
</tr>
</table>
</div> 
<?php
}

if($_GET['status']=='2'){
?>
<div id="message-yellow">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="yellow-left">Data berhasil dihapus</td>
	<td class="yellow-right"><a class="close-yellow"><img src="images/table/icon_close_yellow.gif"   alt="" /></a></td>
</tr>
</table>
</div> 
<?php
}

if($_GET['status']=='3'){
?>
<div id="message-blue">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="blue-left">Data berhasil diupdate</td>
	<td class="blue-right"><a class="close-blue"><img src="images/table/icon_close_blue.gif"   alt="" /></a></td>
</tr>
</table>
</div> 
<?php
}

if($_GET['status']=='4'){
?>
<div id="message-red">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="red-left">Data yang Anda masukan sudah ada! <?php echo mysqli_error();?></td>
	<td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
</tr>
</table>
</div>
<?php
}

if($_GET['status']=='5'){
?>
<div id="message-red">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="red-left">Username sudah terpakai!<?php echo mysqli_error();?></td>
	<td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
</tr>
</table>
</div>
<?php
}

if($_GET['status']=='6'){
?>
<div id="message-green">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="green-left">File Berhasil diupload</td>
	<td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
</tr>
</table>
</div>
<?php
}

if($_GET['status']=='7'){
?>
<div id="message-green">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="green-left">Pesan Berhasil dikirim</td>
	<td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
</tr>
</table>
</div>
<?php
}

if($_GET['status']=='8'){
?>
<div id="message-red">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="red-left">Photo Belum diisi</td>
	<td class="red-right"><a class="close-red"><img src="images/table/icon_close_red.gif"   alt="" /></a></td>
</tr>
</table>
</div>
<?php
}

if($_GET['status']=='9'){
?>
<div id="message-green">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td class="green-left">Terimakasih telah mengisi kuesioner.</td>
	<td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
</tr>
</table>
</div>
<?php
}

?>