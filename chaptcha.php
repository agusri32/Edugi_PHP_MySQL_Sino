<?php session_start();
//untuk membuat angka dan huruf yang randome
$str='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstupwxyz0123456789';

//ambil 5 string yang bisa terdiri dari angka dan huruf 
$rand=substr(str_shuffle($str),0,5);

//fungsi acak
$no=rand(1,3);

//menempelkan angka tadi ke sebuah gambar background yang sudah di tetapkan sebelumnya.
$image=imagecreatefromjpeg("chaptcha.jpg");
$font=5;
$black=imagecolorallocate($image,0,0,0);
$y=(imagesy($image)-imagefontheight($font))/2;
imagestring($image,$font,8,$y,$rand,$black);

//membuat session string randome
$_SESSION['RandVal']=md5($rand);
header('Content-type:image/jpeg');
imagejpeg($image);
imagedestroy($image);
?> 

