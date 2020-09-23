<?php
if(!isset($_SESSION['domain'])){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<div id="related-activities">
    <!--  start related-act-top -->
    <div id="related-act-top"> <img src="images/forms/pengumuman.jpg" width="271" height="43" alt="" /> </div>
    <!-- end related-act-top -->
    <!--  start related-act-bottom -->
    <div id="related-act-bottom">
      <!--  start related-act-inner -->
      <div id="related-act-inner">
        <div class="left"></div>
        <div class="right"></div>
        <div class="clear"></div>
        
		<?php
		$domain=$_SESSION['domain'];
		$view=mysqli_query($link,"select * from setup_pengumuman where status_aktif='yes' and untuk='umum' or untuk='$domain' order by id_pengumuman asc");
		while($row=mysqli_fetch_array($view)){
			?>
			<div class="left"><a href=""><img src="images/forms/icon_edit.gif" width="21" height="21" alt="" /></a></div>
       		<div class="right">

			 <h5><?php echo $row['judul']; ?></h5>
			  	 <?php echo $row['isi']; ?>
			</div>
			<?php
		}
		?>			
		
		
        <div class="clear"></div>
      </div>
      <!-- end related-act-inner -->
      <div class="clear"></div>
    </div>
    <!-- end related-act-bottom -->
  </div>