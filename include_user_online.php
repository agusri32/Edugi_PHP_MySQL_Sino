<?php
if(!isset($_SESSION['domain'])){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<div id="related-activities">
    <!--  start related-act-top -->
    <div id="related-act-top"> <img src="images/forms/user_online.jpg" width="271" height="43" alt="" /> </div>
    <!-- end related-act-top -->
    <!--  start related-act-bottom -->
    <div id="related-act-bottom">
      <!--  start related-act-inner -->
      <div id="related-act-inner">
        <div class="left"></div>
        <div class="right"></div>
        <div class="clear"></div>
        
		<table>
		<?php
		$view_user=mysqli_query($link,"select * from tbl_user_pesan where online='yes' order by id_user asc");
		while($row_user=mysqli_fetch_array($view_user)){
			?>
			<tr>
				<td><a href="#"><img src="images/user_online.ico" width="21" height="21" alt="" /></a></td>
				<td><h5>
				<a href="javascript:void(0)" onclick="javascript:chatWith('<?php echo $row_user['username']; ?>')">
				<?php echo $row_user['nama_user']; ?> (<?php echo $row_user['domain']; ?>)
				</a>
				</h5></td>
			</tr>
			<?php
		}
		?>			
		</table>
		
		
        <div class="clear"></div>
      </div>
      <!-- end related-act-inner -->
      <div class="clear"></div>
    </div>
    <!-- end related-act-bottom -->
  </div>