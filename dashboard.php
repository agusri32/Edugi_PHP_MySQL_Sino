<?php
if(!isset($_SESSION['domain'])){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<?php
if($_SESSION['domain']=='guru'){
	$id_guru=$_SESSION['id_guru'];
	$username=ucwords($_SESSION['username']);
	
	$data=mysqli_fetch_array(mysqli_query($link,"select * from data_guru where id_guru='$id_guru'"));

	$kelamin=$data['kelamin'];
	
	if($kelamin=='laki-laki'){
		$sapaan='Pak ';
	}else{
		$sapaan='Ibu ';
	}
	
	$pengguna=$sapaan.$username;
	
}else{

	if($_SESSION['domain']=='ortu'){
		$id_ortu=$_SESSION['id_ortu'];
		$username=ucwords($_SESSION['username']);
		
		$data=mysqli_fetch_array(mysqli_query($link,"select * from data_orangtua where id_orangtua='$id_ortu'"));
	
		$kelamin=$data['kelamin'];
		
		if($kelamin=='laki-laki'){
			$sapaan='Pak ';
		}else{
			$sapaan='Ibu ';
		}
		
		$pengguna=$sapaan.$username;
	}else{
		$pengguna=ucwords($_SESSION['nama_account']);
	}
}
?>

<div id="page-heading">
<table>
<tr>
	<td>
	<h2>
	<?php include "ucapan.php";?>, <?php echo $pengguna;?>    
	</h2>	
	</td>
	<td>
	
	</td>
</tr>
</table>
</div>

<!-- end page-heading -->

<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
    <th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
    <th class="topleft"></th>
    <td id="tbl-border-top">&nbsp;</td>
    <th class="topright"></th>
    <th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>

<tr>
    <td id="tbl-border-left">
	</td>
    <td>
	<!--  start content-table-inner ...................................................................... START -->
				
    <div id="content-table-inner">		
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top"></tr>
			<tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
				
				<?php
				$query=mysqli_query($link,"select * from tbl_pesan where id_reply=0 and id_user='$id_user' or id_teman='$id_user'  order by tanggal desc");
				
				while($row=mysqli_fetch_array($query)){
					$id_inbox=$row['id_inbox'];
				
					if($row['id_user']==$id_user){
						$status_in="To";
						$user_inbox=$row['id_teman'];
					}else{
						$status_in="From";
						$user_inbox=$row['id_user'];
					}
				
					$query_cek1=mysqli_query($link,"select id_user from tbl_pesan where id_inbox='$id_inbox' and dibaca='no' and id_user!='$id_user' order by tanggal desc");
					$cek1=mysqli_num_rows($query_cek1);
					
					$query_cek2=mysqli_query($link,"select id_user from tbl_pesan where id_reply='$id_inbox' and dibaca='no' and id_user!='$id_user' order by tanggal desc");
					$cek2=mysqli_num_rows($query_cek2);
						
					if($cek1!==0 || $cek2!==0){
						$baru=true;
					}else{
						$baru=false;
					}
				}
				?>
				
				
				<table width="100%" align="left">
				<tr>
					<td>&nbsp;</td>
					<td>
					
						<?php
						if($baru==true){
						?>
							<div id="message-green">
							<table border="0" width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td class="green-left">Ada Pesan masuk untuk Anda <a href="?page=pesan_masuk" style="text-decoration:none "> <b><font color="#0099FF">[Klik disini]</font></b></a></td>
								<td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
							</tr>
							</table>
							</div>					
						<?php
						}
						?>
					</td>
				</tr>
				<tr>
				<td></td>
				<td>
					<div id="table-content"> 
					<br><br>
					<p align="center"><img src="images/peduli-pendidikan.jpg"></p>
					<br><br><br><br><br><br>
					<p align="center">
					Domain : <?php echo ucwords($_SESSION['domain']); ?><br>
					<font face="verdana" size="-2">Waktu Akses Sistem Informasi Nilai Online [ <?php echo $_SESSION['waktu'];?> ]
					<br>
					<?php echo "Sekarang pukul  $waktu WIB";?>
					</font></p>
				</td>
				</tr>
				</table>               
				<!-- end id-form  -->
              </td>
              <td>
					<!--  start related-activities -->
					<?php include "include_photos.php";?>  
					<?php 
					if($_SESSION['domain']=='siswa'){
						echo "<br>";
						include "include_pengumuman_tugas.php";
					}				
					?> 
                    <br>
					<?php include "include_pengumuman.php";?>  
					<br>
					<?php include "include_user_online.php";?>
					<!-- end related-activities -->
			  </td>
            </tr>
            <tr>
              <td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
              <td></td>
            </tr>
          </table>

	<div class="clear"></div>
     
    </div>
    <!--  end content-table-inner ............................................END  -->
    </td>
    <td id="tbl-border-right"></td>
</tr>
<tr>
    <th class="sized bottomleft"></th>
    <td id="tbl-border-bottom">&nbsp;</td>
    <th class="sized bottomright"></th>
</tr>
</table>
