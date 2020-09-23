<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>
<?php
if($_GET['mode']=='input'){
	
	$pertanyaan=htmlentities($_POST['pertanyaan']);
	$cek=mysqli_num_rows(mysqli_query($link,"select * from tbl_kuesioner_tanya where pertanyaan='$pertanyaan'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=setup_kuesioner&status=4";</script><?php
	}else{
	
		$query=mysqli_query($link,"insert into tbl_kuesioner_tanya values('','$pertanyaan')");
		
		if($query){
			?><script language="javascript">document.location.href="?page=setup_kuesioner&status=1";</script><?php
		}
	}	
}

if($_GET['mode']=='delete'){
	
	$id_tanya=$_GET['id_tanya'];
	$query=mysqli_query($link,"delete from tbl_kuesioner_tanya where id_tanya='$id_tanya'");
	if($query){
		?><script language="javascript">document.location.href="?page=setup_kuesioner&status=2";</script><?php
	}
}

if($_GET['mode']=='update'){
	$id_tanya=$_POST['id_tanya'];
	$pertanyaan=htmlentities($_POST['pertanyaan']);
	
	$cek=mysqli_num_rows(mysqli_query($link,"select * from tbl_kuesioner_tanya where pertanyaan='$pertanyaan'"));
	
	if($cek>0){
		?><script language="javascript">document.location.href="?page=setup_kuesioner&status=4";</script><?php
	}else{	
		$query=mysqli_query($link,"update tbl_kuesioner_tanya set pertanyaan='$pertanyaan' where id_tanya='$id_tanya'");
		
		if($query){
			?><script language="javascript">document.location.href="?page=setup_kuesioner&status=3";</script><?php
		}
	}
}

if($_GET['mode']=='edit'){
	$id_tanya=$_GET['id_tanya'];
	$edit=mysqli_query($link,"select * from tbl_kuesioner_tanya where id_tanya='$id_tanya'");

	$data=mysqli_fetch_array($edit);
	$pertanyaan=$data['pertanyaan'];
}
?>

<!--  start page-heading -->
<div id="page-heading">
    <h1>Pertanyaan Kuesioner</h1>
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
			include "warning.php";
			?>    
	
			<?php
			if($_GET['mode']=='edit'){
				?><form action="?page=setup_kuesioner&mode=update" method="post"><?php 
			}else{
				?><form action="?page=setup_kuesioner&mode=input" method="post"><?php
			}
			?>
			
 	        <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr valign="top">
              <td><!--  start step-holder -->
                <!--  end step-holder -->
                  <!-- start id-form -->
                  <table border="0" width="100%" cellpadding="0" cellspacing="0"  id="id-form">
                    <tr>
                      <th valign="top">Pertanyaan</th>
                      <td>
					  <textarea id="pertanyaan" name="pertanyaan"><?php echo $data['pertanyaan'];?></textarea>
					  </td>
                      <td></td>
                    </tr>
                    <tr>
                      <th>&nbsp;</th>
                      <td valign="top">
					  		<input type="hidden" name="id_tanya" value="<?php echo $_GET['id_tanya'];?>">
					  		<input type="submit" name="submit" onClick="return cek_kelas()" value="" class="form-submit" />
                      		<input type="reset" value="" class="form-reset"  />
                      </td>
                      <td></td>
                    </tr>
                  </table>
                <!-- end id-form  -->
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
		<i>
		<p> * Data di setup tidak disarankan untuk dihapus jika sistem sudah berjalan. 
		<br>* Disarankan hanya untuk update atau insert. 
		<br>* Karena Data yang lama akan menjadi history
		</p>
		</i>
		<br>
		
		<?php
		//************awal paging************//
		$query=mysqli_query($link,"select * from tbl_kuesioner_tanya order by id_tanya asc");
		$get_pages=mysqli_num_rows($query); //dapatkan jumlah semua data
		
		if ($get_pages>$entries)  //jika jumlah semua data lebih banyak dari nilai awal yang diberikan
		{
			?>Halaman : <?php
			$pages=1;
			while($pages<=ceil($get_pages/$entries))
			{
				if ($pages!=1)
				{
					echo " | ";
				}
			?>
			<!--Membuat link sesuai nama halaman-->
			<a href="?page=setup_kuesioner&halaman=<?php echo ($pages-1); ?> " style="text-decoration:none"><font size="2" face="verdana" color="#009900"><?php echo $pages; ?></font></a>
			<?php
			$pages++;
			}
			
		}else{
			$pages=1;
		}
		
		//**************akhir paging*****************//
		?>
		</font>
		<?php
		$page=(int)$_GET['halaman'];
		$offset=$page*$entries;
		
		//menampilkan data dengan menggunakan limit sesuai parameter paging yang diberikan
		$result=mysqli_query($link,"select * from tbl_kuesioner_tanya order by id_tanya asc limit $offset,$entries"); //output
		?>
		
      	<!--  start product-table ..................................................................................... -->
        <form id="mainform" action="">
        <table border="0" width="70%" cellpadding="0" cellspacing="0" id="product-table">
        <tr>
            <th width="5%" class="table-header-repeat line-left minwidth-1"><a href="">Nomor</a>	</th>
            <th width="68%" class="table-header-repeat line-left minwidth-1"><a href="">Pertanyaan</a></th>
            <th width="5%" class="table-header-options line-left"><a href="">Aksi</a></th>
        </tr>
        
        
        <?php
		$no=0;
		while($row=mysqli_fetch_array($result)){
		?>	
		<tr>
            <td><?php echo $offset=$offset+1;?></td>
            <td><?php echo $row['pertanyaan'];?></td>
            <td class="options-width">
            <a href="?page=setup_kuesioner&mode=delete&id_tanya=<?php echo $row['id_tanya'];?>" onclick="return confirm('Apakah Anda yakin?')" title="Delete" class="icon-2 info-tooltip"></a>
            <a href="?page=setup_kuesioner&mode=edit&id_tanya=<?php echo $row['id_tanya'];?>" title="Edit" class="icon-5 info-tooltip"></a>            
            </td>
        </tr>
		<?php
		}
		?>
        </table>
		TOTAL DATA : <?php echo $get_pages;?>
        <!--  end product-table................................... --> 
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