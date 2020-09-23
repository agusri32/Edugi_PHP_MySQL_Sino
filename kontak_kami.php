<?php
if(!isset($_SESSION['domain'])){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Kontak Kami</h1>
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
			$data=mysqli_fetch_array(mysqli_query($link,"select * from setup_kontak_kami"));
				$id_kontak=$data['id_kontak'];
				$nama_instansi=$data['nama_instansi'];
				$alamat=$data['alamat'];
				$email=$data['email'];
				$telpon=$data['telpon'];
				$logo=$data['photo'];
			?>
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
					<tr>
                      <th valign="top"><img src="./logo/<?php echo $logo;?>" width="120" height="100"></th>
                      <td></td>
                      <td></td>
                    </tr>
					<tr>
                      <th valign="top">Nama Instansi </th>
                      <td><?php echo $nama_instansi;?></td>
                      <td></td>
                    </tr>
					<tr>
                      <th valign="top">Alamat </th>
                      <td>
					  <?php echo $alamat;?>
					  </td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">Email</th>
                      <td><?php echo $email;?></td>
                      <td></td>
                    </tr>
                     <tr>
                      <th valign="top">Telpon</th>
                      <td><?php echo $telpon;?></td>
                      <td></td>
                    </tr>
				</table>
                <!-- end id-form  -->
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
			  </td>
              <td><!--  start related-activities -->
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