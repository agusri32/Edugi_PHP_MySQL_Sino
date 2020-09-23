<?php
if(!isset($_SESSION['domain'])){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<div id="related-activities">
    <!--  start related-act-top -->
    <div id="related-act-top"> <img src="images/forms/photo_profil.jpg" width="271" height="43" alt="" /> </div>
    <!-- end related-act-top -->
    <!--  start related-act-bottom -->
    <div id="related-act-bottom">
      <!--  start related-act-inner -->
      <div id="related-act-inner">
        <div class="left"></div>
        <div class="right"></div>
        <div class="clear"></div>
        
        <center>
		<?php
		if($_SESSION['domain']=='siswa'){
			?><a href="?page=setting_siswa"><img src="./photo_siswa/<?php echo $_SESSION['photo'];?>" width="200" height="200"/></a><?php
		}
		if($_SESSION['domain']=='guru'){
			?><a href="?page=setting_guru"><img src="./photo_guru/<?php echo $_SESSION['photo'];?>" width="200" height="200"/></a><?php
		}
		if($_SESSION['domain']=='ortu'){
			?><a href="?page=setting_ortu"><img src="./photo_ortu/<?php echo $_SESSION['photo'];?>" width="200" height="200"/></a><?php
		}
		if($_SESSION['domain']=='admin' || $_SESSION['domain']=='superadmin'){
			?><img src="./images/Administrator.jpg" width="200" height="200"/><?php
		}
		?>
		</center>
		
		
        <div class="clear"></div>
      </div>
      <!-- end related-act-inner -->
      <div class="clear"></div>
    </div>
    <!-- end related-act-bottom -->
  </div>