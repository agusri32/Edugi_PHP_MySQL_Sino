<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>


<?php
if(isset($_POST['submit'])){
	$id_kontak=$_POST['id_kontak'];
	$nama_instansi=$_POST['nama_instansi'];
	$nss=$_POST['nss'];
	$kepsek=$_POST['kepsek'];
	$kepsek_nip=$_POST['kepsek_nip'];
	$alamat=$_POST['alamat'];
	$email=$_POST['email'];
	$website=$_POST['website'];
	$telpon=$_POST['telpon'];
	
	$visi=$_POST['visi'];
	$misi=$_POST['misi'];
	
	$photo_lama=$_POST['photo_lama'];
	$nama_photo=$_FILES['photo']['name'];
	
	if(empty($_FILES['photo']['name'])){
		$nama_file_upload=$photo_lama;
		$query=mysqli_query($link,"update setup_kontak_kami set nama_instansi='$nama_instansi',alamat='$alamat',email='$email',telpon='$telpon',misi='$misi',visi='$visi',photo='$nama_file_upload',nss='$nss',website='$website',kepsek='$kepsek',kepsek_nip='$kepsek_nip'  where id_kontak='$id_kontak'");
		
		if($query){
			?><script language="javascript">document.location.href="?page=setup_kontak_kami&status=3";</script><?php
		}else{
			echo  mysqli_error();
		}
	}else{	
		$uploaddir='./logo/';
		$rnd=date(His);				
		$nama_file_upload=$rnd.'-'.$nama_photo;
		$alamatfile=$uploaddir.$nama_file_upload;
		
		if (move_uploaded_file($_FILES['photo']['tmp_name'],$alamatfile))
		{
			$query=mysqli_query($link,"update setup_kontak_kami set nama_instansi='$nama_instansi',alamat='$alamat',email='$email',telpon='$telpon',misi='$misi',visi='$visi',photo='$nama_file_upload',nss='$nss',website='$website',kepsek='$kepsek',kepsek_nip='$kepsek_nip'  where id_kontak='$id_kontak'");
			
			unlink("./logo/".$photo_lama);
				
			if($query){
				?><script language="javascript">document.location.href="?page=setup_kontak_kami&status=3";</script><?php
			}else{
				echo  mysqli_error();	
			}
			
		}else{
			?><script language="javascript">document.location.href="?page=setup_kontak_kami&status=8";</script><?php
		}
	}
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Kontak Kami / Profil Sekolah</h1>
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
    <td id="tbl-border-left"></td>
    <td>
    <!--  start content-table-inner ...................................................................... START -->
    <div id="content-table-inner">
    		<?php 
			$data=mysqli_fetch_array(mysqli_query($link,"select * from setup_kontak_kami"));
				$id_kontak=$data['id_kontak'];
				$nama_instansi=$data['nama_instansi'];
				$nss=$data['nss'];
				$kepsek=$data['kepsek'];
				$kepsek_nip=$data['kepsek_nip'];
				$alamat=$data['alamat'];
				$email=$data['email'];
				$website=$data['website'];
				$telpon=$data['telpon'];
		
				$visi=$data['visi'];
				$misi=$data['misi'];
				
				$photo=$data['photo'];

			?>
			<?php include "warning.php"; ?>    
			<form action="?page=setup_kontak_kami" enctype="multipart/form-data" method="post" name="postform">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
				  
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
					<tr>
                      <th valign="top">Nama Sekolah </th>
                      <td><input type="text" name="nama_instansi" size="45" value="<?php echo $nama_instansi;?>"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th valign="top">NSS</th>
                      <td><input type="text" name="nss" size="45" title="Nomor Statistik Sekolah(NSS)" value="<?php echo $nss;?>"></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">Kepala Sekolah</th>
                      <td><input type="text" name="kepsek" size="45" value="<?php echo $kepsek;?>"></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">NIP Kep.Sekolah</th>
                      <td><input type="text" name="kepsek_nip" size="45" value="<?php echo $kepsek_nip;?>"></td>
                      <td></td>
                    </tr>
					<tr>
                      <th valign="top">Alamat </th>
                      <td>
					  <textarea name="alamat" style="width: 300px; height: 100px;">
					  <?php echo $alamat;?>
					  </textarea>
					  </td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">Email</th>
                      <td><input type="text" name="email" value="<?php echo $email;?>"></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">Website</th>
                      <td><input type="text" name="website" value="<?php echo $website;?>"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th valign="top">Telpon</th>
                      <td><input type="text" name="telpon" value="<?php echo $telpon;?>"></td>
                      <td></td>
                    </tr>
					<tr>
                      <th valign="top">Visi</th>
                      <td>
					  <textarea name="visi" style="width: 300px; height: 100px;">
					  <?php echo $visi;?>
					  </textarea>
					  <td></td>
                    </tr>
					<tr>
                      <th valign="top">Misi</th>
                      <td>
					  <textarea name="misi" style="width: 300px; height: 100px;">
					  <?php echo $misi;?>
					  </textarea>					  
					  </td>
                      <td></td>
                    </tr>
					<tr>
					  <th></th>
					  <td>
					  
						<?php 
						if(empty($photo)){
							$logo='';
						}else{
							$logo=$photo;
							?><img src="./logo/<?php echo $logo;?>" width="100" height="100"><?php
						}
						?>
						
						  
					  </td>
					  <td></td>
					</tr>
					<tr>
					  <th>LOGO INSTANSI</th>
					  <td><input type="file" name="photo" size="30"/></td>
					  <td></td>
					</tr>
					<tr>
                      <th valign="top"></th>
                      <td>
					  <input type="hidden" name="id_kontak" value="<?php echo $id_kontak;?>">
					  <input type="hidden" name="photo_lama" value="<?php echo $photo;?>">
					  <input type="submit" name="submit" value="Update" onClick="return confirm('Apakah Anda yakin?');" class="form-submit"></td>
                      <td></td>
                    </tr>
                  </table>
				  

			  </td>
              <td><!--  start related-activities -->
              </td>
            </tr>
            <tr>
              <td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
              <td></td>
            </tr>
        	</table>
			</form>     
			
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