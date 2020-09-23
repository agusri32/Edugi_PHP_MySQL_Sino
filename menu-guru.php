<?php
if($domain!=='guru'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>


<ul id="navigation" class="nav-main">
	<li><a href="?page=dashboard">Dashboard</a></li>
	
	<li class="list"><a href="javascript:;">Aktifitas</a>
	  <ul class="nav-sub">
	    <li><a href="?page=pengumuman_tugas">Pengumuman Tugas</a></li>
		<li><a href="?page=download_tugas">Lihat Tugas Siswa</a></li>
        <li><a href="?page=input_nilai">Input Nilai</a></li>
	</ul>
  </li>
	
	<li class="list"><a href="javascript:;">Laporan</a>
	<ul class="nav-sub">
		<li><a href="?page=laporan_penilaian">Penilaian</a></li>
		<li><a href="?page=kuesioner_review_guru">Hasil Kuesioner</a></li>
	</ul>
	</li>
	
	<li class="list"><a href="javascript:;">File</a>
	<ul class="nav-sub">
		<li><a href="?page=upload_materi_guru">Upload Materi</a></li>
		<li><a href="?page=download_dokumen">Download Dokumen</a></li>
	</ul>
	</li>
	
	<li class="list"><a href="javascript:;">Pesan</a>
	<ul class="nav-sub">
		<li><a href="?page=pesan_kirim">Kirim Pesan</a></li>
		<li><a href="?page=pesan_masuk">Kotak Pesan</a></li>
        <li><a href="?page=pesan_keluar">Pesan Keluar</a></li>
	</ul>
	</li>
	
	<li class="list"><a href="javascript:;">Profil</a>
	<ul class="nav-sub">
		<li>
		<?php
		if($domain=='admin'){
			echo "<a href='?page=setting_admin'>Setting</a>";
		}
		
		if($domain=='guru'){
			echo "<a href='?page=setting_guru'>Setting</a>";
		}
		
		if($domain=='siswa'){
			echo "<a href='?page=setting_siswa'>Setting</a>";
		}
		
		if($domain=='ortu'){
			echo "<a href='?page=setting_ortu'>Setting</a>";
		}
		?>
		</li>
		<li>
		<a href='?page=kontak_kami'>Kontak Kami</a>
		</li>
	</ul>
	</li>
	
	<li><a href="logout.php" onclick="return confirm('Apakah Anda yakin?')"><font color="#FFFF00">Logout (<?php echo ucwords($username);?>)</font></a></li>

</ul>