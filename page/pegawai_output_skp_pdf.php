<?php
session_start();
include ('../nigol.php');

	include "../koneksi.php";
	include("../ext/mpdf/mpdf.php");
	$html .= '<h2 align="center">PENILAIAN SASARAN KERJA<br>PEGAWAI NEGERI SIPIL</h2><br>';
        $nip = $_GET['dinilai'];
	$year = $_GET['tahun_skp'];
        /*$hasil2  = mysqli_query("select * from tbl_form_skp where penilai=".$_SESSION['userid']."");
	  if (!$hasil2)
		die("Gagal Query data karena : ".mysqli_error());

		
	if($row = mysqli_fetch_array($hasil2))*/
	    $hasil  = mysqli_query("select * from tbl_form_skp where tahun_skp=$year AND dinilai='".$nip."' ORDER BY tahun_skp");	
	
	$ambil = mysqli_query("select nama_pns from tbl_pns where nip='".$nip."'");
	    if ($buaris = mysqli_fetch_array($ambil))
		$html .= "<b>Nama Pegawai Dinilai : ".$buaris['nama_pns']."<br> NIP : ".$nip."</b><br><br>";
		$html .="<br><br>";
		$html .= "<center><table id='rounded-corner' summary='2007 Major IT Companies Profit' border=1>
   <tr align='center'>
    <th rowspan='2'>Tahun SKP</th>
    <!--<th rowspan='2'>Penilai</th>
    <th rowspan='2'>Dinilai</th>-->
    <th rowspan='2'>Tugas</th>
    <th colspan='5' align='center'>TARGET</th>
    <th colspan='5'>REALISASI</th>
    <th rowspan='2'>Count</th>
    <th rowspan='2'>Capaian SKP</th>

   </tr>  
   <tr> 
    <th>Kredit</th>
    <th>Kuantitas</th>
    <th>Kualitas</th>
    <th>Waktu</th>
    <th>Biaya</th>
    <th>Kredit</th>
    <th>Kuantitas</th>
    <th>Kualitas</th>
    <th>Waktu</th>
    <th>Biaya</th>
   </tr>";
   
	while($row = mysqli_fetch_array($hasil))
	{
           
		$html .= "<tr>";
		$html .= "<td>" .$row['tahun_skp']. "</td>";
		$html .= "<td>" .$row['tugas']. "</td>";
		$html .= "<td>" .$row['kredit']. "</td>";
                $html .= "<td>" .$row['kuantitas']. "</td>";
                $html .= "<td>" .$row['kualitas']. "</td>";
		$html .= "<td>" .$row['waktu']. "</td>";
	        $html .= "<td>" .$row['biaya']. "</td>";
		$html .= "<td>" .$row['kredit_real']. "</td>";
		$html .= "<td>" .$row['kuantitas_real']. "</td>";
		$html .= "<td>" .$row['kualitas_real']. "</td>";
		$html .= "<td>" .$row['waktu_real']. "</td>";
                $html .= "<td>" .$row['biaya_real']. "</td>";
                $html .= "<td>" .$row['penghitungan']. "</td>";
		if ($row['nilai_capaian_skp'] > 91) 
				 $html .= "<td>" .$row['nilai_capaian_skp']." (Sangat Baik) </td>";
			 elseif ($row['nilai_capaian_skp'] >76 && $row['nilai_capaian_skp'] <90)
				 $html .= "<td>" .$row['nilai_capaian_skp']. " (Baik) </td>";
			 elseif ($row['nilai_capaian_skp'] >61 && $row['nilai_capaian_skp'] <75)
				 $html .= "<td>" .$row['nilai_capaian_skp']. " (Cukup)</td>";
			 elseif ($row['nilai_capaian_skp'] >51 && $row['nilai_capaian_skp'] <60)
				 $html .= "<td>" .$row['nilai_capaian_skp']. " (Kurang)</td>";
			 elseif ($row['nilai_capaian_skp'] <50)
				 $html .= "<td>" .$row['nilai_capaian_skp']. " (Buruk)</td>";
		$html .= "</tr>";
	}
	 $tahun = $_GET['tahun_skp'];
	 $nip = $_GET['dinilai'];
	 $q1  = mysqli_query("select sum(nilai_capaian_skp)/count(tahun_skp) AS Nilai_SKP from tbl_form_skp
			 where tahun_skp=$tahun AND dinilai='".$nip."'");
	 if (!$q1)
	    die("Gagal Query data karena : ".mysqli_error());
	    
	 if($rowzy = mysqli_fetch_array($q1))
	 $html .= "<tr align='center'>
	       <th rowspan='2' colspan='13' align='right'>NILAI CAPAIAN SKP (60%) </th>
	       <th rowspan='2'>".$rowzy['Nilai_SKP']." (".$rowzy['Nilai_SKP']*0.6.")</th>
	      </tr>";
	      
	mysqli_free_result($result);
	
	$hasil  = mysqli_query("select a.kode, a.nama_jabatan, b.nama_palru from tbl_jabatan a, tbl_pangkat_golru b
				where a.id_jabatan=".$_SESSION['jab']." AND b.id_palru=".$_SESSION['pal']."");
	if($row = mysqli_fetch_array($hasil))
	$hasil_lagi  = mysqli_query("select a.nip, a.nama_pns, c.nama_palru, b.nama_jabatan, a.unit_kerja, a.jekel, a.tmt, a.level
			       from tbl_pns a, tbl_jabatan b, tbl_pangkat_golru c
			       where a.id_palru=c.id_palru AND a.id_jabatan=b.id_jabatan AND b.kode='".$row['kode']."' AND a.level='penilai' ORDER BY a.level");
	if($rowz = mysqli_fetch_array($hasil_lagi))
	$html .= "</table>";
		$html .="<br><br><br><br><br><br>";
		$html .="<b>Blora, 31 Desember</b> $tahun<br>";
		$html .="Pejabat Penilai,<br><br><br>";
		$html .="($rowz[nama_pns]) <br>";
		$html .="NIP: $rowz[nip] <br>";


//==============================================================
//change your echo/print with $html.=""; to show in PDF view
//==============================================================


$mpdf=new mPDF('c','A4-L','','',15,15,27,25,16,13); 

$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
$mpdf->defaultheaderfontsize = 10; /* in pts */
$mpdf->defaultheaderfontstyle = B; /* blank, B, I, or BI */
$mpdf->defaultheaderline = 1; /* 1 to include line below header/above footer */
$mpdf->defaultfooterfontsize = 12; /* in pts */
$mpdf->defaultfooterfontstyle = B; /* blank, B, I, or BI */
$mpdf->defaultfooterline = 1; /* 1 to include line below header/above footer */
$mpdf->SetHeader('{DATE j-m-Y}|{PAGENO}| Badan Kepegawaian Daerah Kabupaten Blora');
$mpdf->SetFooter('{PAGENO}'); /* defines footer for Odd and Even Pages - placed at Outer margin */
        $mpdf->SetFooter(array(
                'L' => array(
                'content' => 'Text to go on the left',
                'font-family' => 'sans-serif',
                'font-style' => 'B', /* blank, B, I, or BI */
                'font-size' => '10', /* in pts */
                ),
                'C' => array(
                'content' => '- {PAGENO} -',
                'font-family' => 'serif',
                'font-style' => 'BI',
                'font-size' => '18', /* gives default */
                ),
                'R' => array(
                'content' => 'Printed @ {DATE j-m-Y H:m}',
                'font-family' => 'monospace',
                'font-style' => '',
                'font-size' => '10',
                ),
                'line' => 1, /* 1 to include line below header/above footer */
                ), 'E' /* defines footer for Even Pages */
        );
$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

// LOAD a stylesheet
$stylesheet = file_get_contents('../ext/mpdf/examples/mpdfstyletables.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html,2);

$mpdf->Output('penilaian_skp_'.$buaris['nama_pns'].'_'.$nip.'_tahun_'.$year.'.pdf','I');
exit;
//==============================================================
//==============================================================
//==============================================================


?>