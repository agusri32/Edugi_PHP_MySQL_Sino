<?php
if($domain!=='siswa'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<ul id="navigation" class="nav-main">
	<li><a href="?page=dashboard">Dashboard</a></li>
	<li class="list"><a href="javascript:;">Aktifitas</a>
	  <ul class="nav-sub">
	    <li><a href="?page=pengumuman_tugas_view">Pengumuman Tugas</a></li>
		<li><a href="?page=upload_tugas">Upload Tugas</a></li>
		<li><a href="?page=jadwal_ujian">Jadwal Ujian</a></li>
		<?php
		if($kuesioner=='buka'){
			echo "<li><a href='?page=kuesioner'>Isi Kuesioner</a></li>";
		}
		?>

	</ul>
	</li>
	
	<li class="list"><a href="javascript:;">Nilai Siswa</a>
	<ul class="nav-sub">
		<li><a href="?page=hasil_nilai">Nilai Semester</a></li>
		<li><a href="?page=hasil_nilai_rekap">Rekap Nilai</a></li>
	</ul>
	</li>
	
	<li class="list"><a href="javascript:;">Download</a>
	<ul class="nav-sub">
		<li><a href="?page=download_materi">Materi Pelajaran </a></li>
        <li><a href="?page=download_dokumen">Dokumen</a></li>
	</ul>
	</li>
				
	<li class="list"><a href="javascript:;">Pesan</a>
	<ul class="nav-sub">
		<?php
		if($pesan_siswa=='yes'){
			echo "<li><a href='?page=pesan_kirim'>Kirim Pesan</a></li>";
		}
		?>
		<li><a href="?page=pesan_masuk">Kotak Pesan</a></li>
		<?php
		if($pesan_siswa=='yes'){
			echo "<li><a href='?page=pesan_keluar'>Pesan Keluar</a></li>";
		}
		?>
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