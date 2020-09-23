<?php
//untuk rincian
$mode=$_GET['mode'];
include "conn.php";

//untuk menampilkan nama_user
if($mode=='nama_user_view'){
	$domain=$_GET['domain'];
	$view_user=mysqli_query($link,"select * from tbl_user_pesan where domain='$domain' order by nama_user asc");
	$cek=mysqli_num_rows($view_user);
	
	if($cek){
		?>	
		<select name="id_teman">
		<?php
		while($row=mysqli_fetch_array($view_user)){
			?><option value="<?php echo $row['id_user'];?>"><?php echo $row['nama_user'];?></option><?php
		}
		?>
		</select>
		<?php
	}else{
		echo "Silahkan pilih nama nama_user";
	}
}
?>



