<?php
if($domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>


<?php
if($_GET['mode']=='update'){
	$paging_halaman=$_POST['paging_halaman'];
	$pesan_siswa=$_POST['pesan_siswa'];
	$pesan_ortu=$_POST['pesan_ortu'];
	$logout_otomatis=$_POST['logout_otomatis'];
	$title_web=$_POST['title_web'];
	
	$query1=mysqli_query($link,"update setup_sistem set nilai_setup='$paging_halaman' where nama_setup='paging_halaman'");
	$query2=mysqli_query($link,"update setup_sistem set nilai_setup='$pesan_siswa' where nama_setup='pesan_siswa'");
	$query3=mysqli_query($link,"update setup_sistem set nilai_setup='$logout_otomatis' where nama_setup='logout_otomatis'");
	$query4=mysqli_query($link,"update setup_sistem set nilai_setup='$title_web' where nama_setup='title_web'");
	$query5=mysqli_query($link,"update setup_sistem set nilai_setup='$pesan_ortu' where nama_setup='pesan_ortu'");
	
	if($query1){
		?><script language="javascript">document.location.href="?page=setup_sistem&status=3";</script><?php
	}else{
		?><script language="javascript">document.location.href="?page=setup_sistem&status=0";</script><?php
	}
}


//setting sistem
$setup1=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='paging_halaman'"));
$setup2=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='pesan_siswa'"));
$setup3=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='logout_otomatis'"));
$setup4=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='title_web'"));
$setup5=mysqli_fetch_array(mysqli_query($link,"select nilai_setup from setup_sistem where nama_setup='pesan_ortu'"));

$paging_halaman=$setup1['nilai_setup'];
$pesan_siswa=$setup2['nilai_setup'];
$logout_otomatis=$setup3['nilai_setup'];
$title_web=$setup4['nilai_setup'];
$pesan_ortu=$setup5['nilai_setup'];
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Setup Sistem </h1>
</div>
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
			include "warning.php";
			?>
    
			<form action="?page=setup_sistem&mode=update" method="post">
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
					<tr>
                      <th valign="top">Title Web </th>
                      <td>
					  <input type="text" class="inp-form" id="title_web" name="title_web" value="<?php echo $title_web;?>"/>
                      <img src="./images/informasi.jpg" title="Mengatur Nama Judul Website">
					  </td>
					  <td></td>
                    </tr>
					
					<tr>
                      <th valign="top">Paging Halaman </th>
                      <td>
					  <input type="text" class="inp-form" id="paging_halaman" name="paging_halaman" value="<?php echo $paging_halaman; ?>"/>
                      <img src="./images/informasi.jpg" title="Mengatur banyaknya data yang tampil dalam satu halaman">
					  </td>
					  <td></td>
                    </tr>

                    <tr>
                      <th valign="top">Pesan Siswa </th>
                      <td><select name="pesan_siswa"  class="styledselect_form_1">
                          <option value="yes" <?php if($pesan_siswa=='yes'){ echo "selected"; } ?>>Yes</option>
                          <option value="no" <?php if($pesan_siswa=='no'){ echo "selected"; } ?>>No</option>
                        </select>
					    <img src="./images/informasi.jpg" title="Mengatur akses siswa untuk mengirim pesan">
                      </td>
                      <td></td>
                    </tr>
                    
                    <tr>
                      <th valign="top">Pesan Orangtua </th>
                      <td><select name="pesan_ortu"  class="styledselect_form_1">
                          <option value="yes" <?php if($pesan_ortu=='yes'){ echo "selected"; } ?>>Yes</option>
                          <option value="no" <?php if($pesan_ortu=='no'){ echo "selected"; } ?>>No</option>
                        </select>
					    <img src="./images/informasi.jpg" title="Mengatur akses orangtua untuk mengirim pesan">
                      </td>
                      <td></td>
                    </tr>
                   
					<tr>
                      <th valign="top">Logout Otomatis</th>
                      <td>
					  <input type="text" title="Isi berapa detik" class="inp-form" id="logout_otomatis" name="logout_otomatis" value="<?php echo $logout_otomatis; ?>"/>
                      <img src="./images/informasi.jpg" title="Mengatur waktu logout otomatis dalam satuan detik">
					  </td>
					  <td></td>
                    </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top">
					  		<input type="submit" name="submit" onClick="return confirm('Apakah Anda yakin?')" value="" class="form-submit" />
                      </td>
                      <td></td>
                    </tr>
                  </table>
                <!-- end id-form  -->
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p></td>
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