<head>

<title>Penilaian Kinerja Pegawai BKD Blora</title>
<!--<link rel="stylesheet" type="text/css" href="css/panel.css" />-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="css/panel_.css" rel="stylesheet" media="screen">
</head>
<?php
session_start();
include ('nigol.php');

//require_once 'config/logout_auto.php';


//cek level user, jika user melakukan keluar
if(($_SESSION['level']!="admin")
   && ($_SESSION['level']!="atasan")
   && ($_SESSION['level']!="pegawai")
   && ($_SESSION['level']!="penilai")){
     header("location:index.php?error=6");

}


?>

<?php
    //echo "iki halaman panel ADMIN Aldy";
    echo "<br>";
?>

<body>

<div id="halaman">

	<!-- header !-->
	<div id="header"> 
	</div>

	<!-- content !-->
    <div id="content">
	<body>
	<div id="tulis">
	<h3>Selamat Datang </h3><br />
        <div>
	Akses   : <?php echo $_SESSION['level']; ?><br>
        NIP     : <?php echo $_SESSION['userid']; ?><br>
        Nama    : <?php echo $_SESSION['name']; ?><br>
		<?php
	  include "koneksi.php";
	  $hasil  = mysqli_query("select a.kode2, a.nama_jabatan, b.nama_palru from tbl_jabatan a, tbl_pangkat_golru b
				where a.id_jabatan=".$_SESSION['jab']." AND b.id_palru=".$_SESSION['pal']."");
	  if (!$hasil)
		die("Gagal Query data karena : ".mysqli_error());
		
	  if($row = mysqli_fetch_array($hasil)){
	    echo "Jabatan : ".$row['nama_jabatan'];
	    echo "<br>";
	    echo "Pangkat, golru : ".$row['nama_palru'];
	    echo "<br>";echo "<br>";
	  }
	?>
	<br/><br/>
        </div>
	Silahkan pilih menu yang di sebelah untuk mengelola Kepegawaian kabupaten Blora<br />
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	<br /><br /><br /><br /><br />
    
   </div>
   </body>
		<?php
			include "case.php";
		?>
    </div>


    <!-- sidebar kiri !-->
    <div id="sidebar_kiri">

    	 <div id="sidebar_title">
			<div id="sidebar_name">
				KELOLA KEPEGAWAIAN
				
			</div>

			<div id="sidebar_isi">
				<ul>   
					<li><h3>Sebagai <?php echo $_SESSION['level']; ?></h3></li>
                                        <li style='color: red'>Home</li>
					<li><a href="page/atasan_input_skpkp.php">SKP dan PKP</a></li>
					<!--<li><a href='#'>Data Jabatan</a></li>
					<li><a href='#'>Set Pass</a></li>
					<li><a href='#'>Report</a></li>-->
					
				</ul>
			</div>
    	</div>



    	<div id="sidebar_title">
			<div id="sidebar_name">
			  Logout
			</div>

			<div id="sidebar_isi">
				<ul>
					<li><a href="nigol.php?op=out">Keluar</a></li>
				</ul>
			</div>
    	</div>
    </div>

    <!-- footer !-->
    <div id="footer"> BKD. KABUPATEN BLORA &copy; th 2013 </div>
</div>
</body>

        
        
