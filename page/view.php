<?php
	include "../koneksi.php";
        //$nip = $_GET['username'];
	//$hasil = mysqli_query("SELECT * FROM tbl_form WHERE penilai='".$nip."'");
	
        //$hasil  = mysqli_query("SELECT * FROM tbl_form WHERE penilai=1057;");
	$hasil  = mysqli_query("select * from tbl_pns where pwd=md5('aldy')");
	if (!$hasil)
		die("Gagal Query data karena : ".mysqli_error());

        /*if ($row = mysqli_fetch_array($hasil)){
	echo "Nama : ".$row['penilai']."<br>";
	echo "Dinilai : ".$row['dinilai']."<br>";
	
	  }*/
	echo '<input type=button value="Refresh" onClick="window.location.reload()" />';
	
	echo "<center><table id='rounded-corner' summary='2007 Major IT Companies Profit' border=1>
  <tr align='center'>
    <th>NIP</th>
    <th>NAMA</th>
    <th>PANGKAT, GOLRU</th>
    <th>JABATAN</th>
    <th>UNIT KERJA</th>
    <th>JENIS KELAMIN</th>
    <th>TMT</th>
    <th>HAK AKSES</th>
    <th colspan='2'>ACTION</th>
  </tr>";


        //while(mysqli_fetch_assoc($hasil))
	//while(mysqli_num_rows($hasil)==$hitung)
	while($row = mysqli_fetch_array($hasil))
	{
           
		echo "<tr>";
		echo "<td>" .$row['nip']. "</td>";
		echo "<td>" .$row['nama_pns']. "</td>";
		echo "<td>" .$row['nama_palru']. "</td>";
		echo "<td>" .$row['nama_jabatan']. "</td>";
		echo "<td>" .$row['unit_kerja']. "</td>";
                echo "<td>" .$row['jekel']. "</td>";
                echo "<td>" .$row['tmt']. "</td>";
		echo "<td>" .$row['level']. "</td>";
		echo "<td> <a href=admin_edit_pegawai.php?nip=$row[nip]>Edit</a></td>";
	        echo "<td> <a class='del' href=admin_input_pegawai.php?mode=delete&nip=$row[nip]>Hapus</a></td> ";
		echo "</tr>";
            
	}
	//mysqli_free_result($result);
	echo "</table>";
?>