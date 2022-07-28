<head>
<link href="../css/panel_.css" rel="stylesheet" media="screen">
    
<link rel="stylesheet" href="../jqui/jquery-ui-1.10.3/themes/base/jquery-ui.css">
<script src="../jqui/jquery-ui-1.10.3/jquery-1.9.1.js"></script>
<script src="../jqui/jquery-ui-1.10.3/ui/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">   
<script>

$(function() {
$( "#datepicker" ).datepicker();
});

function validateForm(){
var elements =document.getElementsByClassName("reqname");
for(var i = 0, l = elements.length; i < l; i++) {
   var x = elements[i].value;
   if(x == null || x == '') {
      alert("Mohon lengkapi data masukkan");
      return false;
      }
   }
}

</script>
</head>
<?php
include "../koneksi.php";

$nip = $_GET['nip'];
$sqledit = "select * from tbl_pns where nip = '$nip'";
$hasil = $mysqli->query($sqledit);

if (!$hasil)
	die ("Gagal query untuk edit data karena..".$mysqli->error);
	
	$data = mysqli_fetch_array($hasil);
	
	$nip=$data['nip'];
	$nama_pns=$data['nama_pns'];
	$pangkat=$data['id_palru'];
	$jab=$data['id_jabatan'];
	$unit=$data['unit_kerja'];
	$jk=$data['jekel'];
	$tmt=$data['tmt'];
	$lvl=$data['level'];
        
	echo "<center><h1>Edit Data Pegawai</h1></center>";
	
	echo "
		<center>";
		?>
                
    <?php
		function update(){
				
			global $mysqli;

			$a	= $_POST['nip'];
			$b	= $_POST['nama_pns'];
			$c	= $_POST['pangkat'];
			$d	= $_POST['jabatan'];
			$e	= $_POST['unit_kerja'];
			$f	= $_POST['jekel'];
			$g	= $_POST['tmt'];
			$h	= $_POST['level'];
				$sql=" update tbl_pns set   nama_pns ='$b',
											id_palru = '$c',
											id_jabatan='$d',
											unit_kerja = '$e',
											jekel ='$f',
											tmt = '$g',
											level	='$h',
				pwd = md5(md5('$h'))
						where nip='$a' ";             
			$hasil=$mysqli->query($sql);
			if(!$hasil)
			die("Gagal Simpan Hasil Edit Pegawai Karena :".$mysqli->error);

			header('Location: admin_input_pegawai.php');
			exit;
		}
    ?>
		<form action="<?php if (isset($_REQUEST['update'])) {update();} ?>" method="post" onsubmit="return update()">
			<table border=1>
				<tr>
				<!-- use readonly for input value to save editing, it doesn't work with disabled -->
					<td>NIP</td><td><input class='reqname' type='text' size=20 name="nip" value="<?php echo $nip; ?>" readonly ></td>
				</tr>
				<tr>
					<td>Nama</td><td><input class='reqname' type='text' size=35 name='nama_pns' value='<?php echo $nama_pns; ?>' ></td>
				</tr>
				<tr><td>Jenis Kelamin 	:</td> <td>
                                        <input type='radio' class='reqname' name='jekel' value='Laki-laki'<?php echo $jk == 'Laki-laki' ? ' checked' : '' ?>/>Laki-laki
                                        <input type='radio' class='reqname' name='jekel' value='Perempuan'<?php echo $jk == 'Perempuan' ? ' checked' : '' ?>/>Perempuan</td></tr>								<tr>
	
				</tr>
                                <tr><td>Pangkat, Golru</td> <td>
                                        <select class='reqname' name='pangkat' >
											<option value='#'>=== Pilih Pangkat ===</option>
											<option value='18'<?php echo $pangkat == '18' ? ' selected' : ''; ?>>-</option>
											<option value='1'<?php echo $pangkat == '1' ? ' selected' : ''; ?>>Pembina Utama, IV/e</option>
											<option value='2'<?php echo $pangkat == '2' ? ' selected' : ''; ?>>Pembina Utama Madya, IV/d</option>
											<option value='3'<?php echo $pangkat == '3' ? ' selected' : ''; ?>>Pembina Utama Muda, IV/c</option>
											<option value='4'<?php echo $pangkat == '4' ? ' selected' : ''; ?>>Pembina Tingkat I, IV/b</option>
											<option value='5'<?php echo $pangkat == '5' ? ' selected' : ''; ?>>Pembina, IV/a</option>
											
											<option value='6'<?php echo $pangkat == '6' ? ' selected' : ''; ?>>Penata Tingkat I, III/d</option>
											<option value='7'<?php echo $pangkat == '7' ? ' selected' : ''; ?>>Penata, III/c</option>
											<option value='8'<?php echo $pangkat == '8' ? ' selected' : ''; ?>>Penata Muda Tingkat I, III/b</option>
											<option value='9'<?php echo $pangkat == '9' ? ' selected' : ''; ?>>Penata Muda, III/a</option>
											
											<option value='10'<?php echo $pangkat == '10' ? ' selected' : ''; ?>>Pengatur Tingkat I, II/d</option>
											<option value='11'<?php echo $pangkat == '11' ? ' selected' : ''; ?>>Pengatur, II/c</option>
											<option value='12'<?php echo $pangkat == '12' ? ' selected' : ''; ?>>Pengatur Muda Tingat I, II/b</option>
											<option value='13'<?php echo $pangkat == '13' ? ' selected' : ''; ?>>Pengatur Muda, II/a</option>
											
											<option value='14'<?php echo $pangkat == '14' ? ' selected' : ''; ?>>Juru Tingat I, I/d</option>
											<option value='15'<?php echo $pangkat == '15' ? ' selected' : ''; ?>>Juru, I/c</option>
											<option value='16'<?php echo $pangkat == '16' ? ' selected' : ''; ?>>Juru Muda Tingkat I, I/b</option>
											<option value='17'<?php echo $pangkat == '17' ? ' selected' : ''; ?>>Juru Muda, I/a</option>
										</select>
										</td>
									</tr>
                                
                                <tr><td>Jabatan	</td> <td>
					<select class='reqname' name='jabatan' >
					  <option value='#'>=== Pilih jabatan ===</option>
					  <option value='1'<?php echo $jab == '1' ? ' selected' : ''; ?>>KEPALA BADAN KEPEGAWAIAN DAERAH</option>
					  <option value='2'<?php echo $jab == '2' ? ' selected' : ''; ?>>KEPALA BIDANG UMUM KEPEGAWAIAN</option>
					  <option value='3'<?php echo $jab == '3' ? ' selected' : ''; ?>>KEPALA BIDANG PENDIDIKAN DAN PELATIHAN</option>
					  <option value='4'<?php echo $jab == '4' ? ' selected' : ''; ?>>KEPALA BIDANG MUTASI PEGAWAI</option>
					  <option value='5'<?php echo $jab == '5' ? ' selected' : ''; ?>>KEPALA BIDANG PERENCANAAN DAN PENGEMBANGAN</option>
					  <option value='6'<?php echo $jab == '6' ? ' selected' : ''; ?>>KEPALA SUB BIDANG PENGOLAHAN DATA DAN INFORMASI</option>
					  <option value='7'<?php echo $jab == '7' ? ' selected' : ''; ?>>KEPALA SUB BAGIAN KEUANGAN</option>
					  <option value='8'<?php echo $jab == '8' ? ' selected' : ''; ?>>KEPALA SUB BAGIAN PROGRAM</option>
					  <option value='9'<?php echo $jab == '9' ? ' selected' : ''; ?>>KEPALA SUB BIDANG PELAYANAN ADMINISTRASI DAN KESEJAHTERAAN PEGAWAI</option>
					  <option value='10'<?php echo $jab == '10' ? ' selected' : ''; ?>>KEPALA SUB BIDANG PENGANGKATAN DAN KEPANGKATAN</option>
					  <option value='11'<?php echo $jab == '11' ? ' selected' : ''; ?>>KEPALA SUB BIDANG FORMASI DAN JABATAN</option>
					  <option value='12'<?php echo $jab == '12' ? ' selected' : ''; ?>>KEPALA SUB BIDANG PEMBINAAN DISIPLIN DAN PERATURAN PERUNDANG-UNDANGAN</option>
					  <option value='13'<?php echo $jab == '13' ? ' selected' : ''; ?>>KEPALA SUB BAGIAN UMUM</option>
					  <option value='14'<?php echo $jab == '14' ? ' selected' : ''; ?>>KEPALA SUB BIDANG PEMINDAHAN PEMBERHENTIAN DAN PENSIUN</option>
					  <option value='15'<?php echo $jab == '15' ? ' selected' : ''; ?>>KEPALA SUB BIDANG PENDIDIKAN DAN PELATIHAN STRUKTURAL</option>
					  <option value='16'<?php echo $jab == '16' ? ' selected' : ''; ?>>KEPALA SUB BIDANG PENDIDIKAN DAN PELATIHAN TEKNIS STRUKTURAL</option>
					  <option value='17'<?php echo $jab == '17' ? ' selected' : ''; ?>>KELOMPOK JABATAN FUNGSIONAL</option>
					  <option value='18'<?php echo $jab == '18' ? ' selected' : ''; ?>>STAF SUB BIDANG PENGOLAHAN DATA DAN INFORMASI</option>
					  <option value='19'<?php echo $jab == '19' ? ' selected' : ''; ?>>STAF SUB BAGIAN KEUANGAN</option>
					  <option value='20'<?php echo $jab == '20' ? ' selected' : ''; ?>>STAF SUB BAGIAN PROGRAM</option>
					  <option value='21'<?php echo $jab == '21' ? ' selected' : ''; ?>>STAF SUB BIDANG PELAYANAN ADMINISTRASI DAN KESEJAHTERAAN PEGAWAI</option>
					  <option value='22'<?php echo $jab == '22' ? ' selected' : ''; ?>>STAF SUB BIDANG PENGANGKATAN DAN KEPANGKATAN</option>
					  <option value='23'<?php echo $jab == '23' ? ' selected' : ''; ?>>STAF SUB BIDANG FORMASI DAN JABATAN</option>
					  <option value='24'<?php echo $jab == '24' ? ' selected' : ''; ?>>STAF SUB BIDANG PEMBINAAN DISIPLIN DAN PERATURAN PERUNDANG-UNDANGAN</option>
					  <option value='25'<?php echo $jab == '25' ? ' selected' : ''; ?>>STAF SUB BAGIAN UMUM</option>
					  <option value='26'<?php echo $jab == '26' ? ' selected' : ''; ?>>STAF SUB BIDANG PEMINDAHAN PEMBERHENTIAN DAN PENSIUN</option>
					  <option value='27'<?php echo $jab == '27' ? ' selected' : ''; ?>>STAF SUB BIDANG PENDIDIKAN DAN PELATIHAN STRUKTURAL</option>
					  <option value='28'<?php echo $jab == '28' ? ' selected' : ''; ?>>STAF SUB BIDANG PENDIDIKAN DAN PELATIHAN TEKNIS STRUKTURAL</option>  	  
					</select>
				</td></tr>
                                <tr><td>Unit Kerja</td> <td>         <input type='text' maxlength='30' size='30' class='reqname' name='unit_kerja' value='<?php echo $unit; ?>'/></td></tr>
				
                                <tr><td>TMT</td><td>            <input type='text' id='datepicker' name='tmt' value='<?php echo $tmt; ?>'></td></tr>
				<tr><td>Hak Akses</td> <td> 	<input type='radio' class='reqname' name='level' value='penilai'<?php echo $lvl == 'penilai' ? ' checked' : ''; ?>/>Penilai
							    <input type='radio' class='reqname' name='level' value='pegawai'<?php echo $lvl == 'pegawai' ? ' checked' : ''; ?>/>Pegawai
							    <input type='radio' class='reqname' name='level' value='atasan'<?php echo $lvl == 'atasan' ? ' checked' : ''; ?>/>Atasan</td></tr>

                                
    ";    
?>
				<tr>
				<td align="right" colspan=2>
				 <input action="action" type="button" value="Kembali" onclick="history.go(-1);" />
				 <input type="submit" name="update" value="Update" onclick="update()" ></td>
				</tr>
			
			</table></center>
		</form>