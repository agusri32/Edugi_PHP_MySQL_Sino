<?php
if($domain!=='admin' && $domain!=='superadmin'){
	?><script language="javascript">document.location.href="logout.php"</script><?php
}
?>

<ul id="navigation" class="nav-main">
	<li><a href="?page=dashboard">Dashboard</a></li>
	
	<li class="list"><a href="javascript:;">Setup</a>
	<ul class="nav-sub">
		<li><a href="?page=setup_kelas">Nama Kelas</a></li>
		<li><a href="?page=setup_ruang_kelas">Ruang Kelas</a></li>
		<li>&nbsp;</li>
		<li><a href="?page=setup_periode">Periode Semester</a></li>
		<li><a href="?page=setup_kelompok_matpel" title="Kelompok Mata Pelajaran">Kelompok Pelajaran</a></li>
        <li><a href="?page=setup_matapelajaran">Mata Pelajaran</a></li>
		<?php 
		if($domain=="superadmin"){
			echo "<li><a href='?page=setup_sistem'><font color=#FFFF00>Setup Sistem</font></a></li>";
		}
		?>
	</ul>
	</li>
	
	<li class="list"><a href="javascript:;">Data Induk</a>
	<ul class="nav-sub">
		<li><a href="?page=data_guru">Data Guru</a></li>
        <li><a href="?page=data_siswa">Data Siswa</a></li>
		<li><a href="?page=data_ortu">Data Orang Tua</a></li>
		<li><a href="?page=data_walikelas">Data Wali Kelas</a></li>
		<li><a href="?page=pengaturan_akses_ortu">Akses Orang Tua</a></li>
		<li></li>
		<li><a href="?page=import_guru">Import Data Guru</a></li>	
		<li><a href="?page=import_siswa">Import Data Siswa</a></li>	
		<li><a href="?page=import_ortu">Import Data Orang Tua</a></li>	
		<?php 
		if($domain=="superadmin"){
			echo "<li><a href='?page=data_admin'><font color=#FFFF00>Administrator</font></a></li>";
		}
		?>
	</ul>
	</li>
	
	<li class="list"><a href="javascript:;">Pengaturan</a>
	<ul class="nav-sub">
		<li><a href="?page=jadwal_ruangkelas">Kelas Siswa</a></li>
        <li><a href="?page=jadwal_mengajar">Jadwal Mengajar</a></li>
		<li><a href="?page=jadwal_ujian_admin">Jadwal Ujian</a></li>
		<li><a href="?page=setting_update_penilaian">Update Penilaian</a></li>
		<li><a href="?page=setup_pengumuman">Pengumuman</a></li>
		<li><a href="?page=pengumuman_tugas_admin">Pengumuman Tugas</a></li>	
		<li></li>
		<li><a href="?page=setup_kuesioner">Pertanyaan Kuesioner</a></li>
		<li><a href="?page=setup_kuesioner_open">Akses Kuesioner</a></li>
		
	</ul>
	</li>
		
	<li class="list"><a href="javascript:;">Laporan</a>
	<ul class="nav-sub">
		<li><a href="?page=laporan_ruangkelas_admin">Kelas Siswa</a></li>
        <li><a href="?page=laporan_kelompok_matpel_admin">Mata Pelajaran</a></li>
        <li><a href="?page=laporan_jadwal_mengajar_admin">Jadwal Mengajar</a></li>
		<li><a href="?page=laporan_jadwal_ujian_admin">Jadwal Ujian</a></li>
        <li></li>
		<li><a href="?page=laporan_penilaian_admin">Penilaian</a></li>
		<?php
		if($kuesioner=='buka'){
			echo "<li><a href='?page=kuesioner_review_admin'>Hasil Kuesioner</a></li>";
		}
		?>
	</ul>
	</li>
	
	<li class="list"><a href="javascript:;">File</a>
	<ul class="nav-sub">
		<li><a href="?page=download_materi_admin">Materi Pelajaran</a></li>
		<li><a href="?page=download_tugas_admin">Tugas Siswa</a></li>
        <li><a href="?page=upload_dokumen_admin">Upload Dokumen</a></li>
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
		if($domain=='superadmin'){
			echo "<a href='?page=setting_superadmin'>Setting</a>";
		}
		
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
		<a href='?page=setup_kontak_kami'>Kontak Kami</a>
		</li>
	</ul>
	</li>
	
	<li>
	<a href="logout.php" onclick="return confirm('Apakah Anda yakin?')"><font color="#FFFF00">Logout (<?php echo ucwords($username);?>)</font></a></li>
</ul>