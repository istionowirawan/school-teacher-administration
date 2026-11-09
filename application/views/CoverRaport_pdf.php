<?php
$p = new PDFTable();
$p->AddFont('vni_times');
$p->AddFont('vni_times', 'B');
$p->AddFont('vni_times', 'I');
$p->AddFont('vni_times', 'BI');
$p->SetMargins(20,20,20);

$p->defaultFontFamily = 'times';
$p->defaultFontStyle  = '';
$p->defaultFontSize   = 12;

$baris=0;
//echo "===>" .$tampil_siswa_nis_kelas->num_rows();

foreach($tampil_siswa_nis_kelas->result() as $row) {

	$coverDepan = "
	<table border=0 width=100%>
	  <tr> 
		<td colspan=5 height=20></td>
	  </tr>
	  
	  <tr> 
		<td colspan=5 size=15 style=bold >
			RAPOR<br>
			SEKOLAH MENENGAH PERTAMA<br>
			(SMP)<br>
		</td>
	  </tr>
	  
	  <tr> 
		<td colspan=5 height=20></td>
	  </tr>
	  
	  <tr> 
		<td></td>
		<td></td>
		<td width=40 >
			<img src='images/logo_tutwuri.jpg' width='40px' height='40px' >
		</td>
		<td></td>
		<td></td>
	  </tr>
	  
	  <tr> 
		<td colspan=5 height=25></td>
	  </tr>
	  
	  <tr> 
		<td></td>
		<td colspan='3' style=bold >Nama Peserta Didik:<br></td>
		<td></td>
	  </tr>
	  <tr> 
		<td></td>
		<td colspan='3' border=1 >".$row->nama."</td>
		<td></td>
	  </tr>
	  
	  <tr> 
		<td colspan=5 height=25></td>
	  </tr>
	  
	  <tr> 
		<td></td>
		<td colspan='3' style=bold >No. Induk / NISN:<br></td>
		<td></td>
	  </tr>
	  <tr> 
		<td></td>
		<td colspan='3' border=1 >".$row->niy." / ".$row->nisn."</td>
		<td></td>
	  </tr>
	  
	   <tr> 
		<td colspan=5 height=20></td>
	  </tr>
	  
	  
	   <tr> 
		<td colspan=5 style=bold >
			KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN<br>
			REPUBLIK INDONESIA
		</td>
	  </tr>
	  
	</table>
	";

	$detailSekolah = "";
	foreach($data_sekolah->result() as $rowS) {
		$detailSekolah = "
		<table border=0 align=center width=100% >
		  
		  <tr> 
			<td colspan=5 height=10></td>
		  </tr>
		  
		   <tr> 
			<td></td>
			<td></td>
			<td>
				<img src='images/logo.jpg' width='230px' height='300px' >
			</td>
			<td></td>
			<td></td>
		  </tr>
		  
		  <tr> 
			<td colspan=5 height=10></td>
		  </tr>
		  
		  <tr> 
			<td colspan=5 size=15 style=bold >
				RAPOR<br>
				SEKOLAH MENENGAH PERTAMA<br>
				(SMP)<br>
			</td>
		  </tr>
		  
		  <tr> 
			<td colspan=5 height=10></td>
		  </tr>
		</table>";
		  
		$detailSekolah .= "
		<table border=0 align=center width=100% >
		  <tr> 
			<td width=15 ></td>
			<td width=40 align=left >Nama Sekolah</td>
			<td width=5 >:</td>
			<td align=left >".$rowS->nama."</td>
			<td></td>
		  </tr>
		  
		   <tr> 
			<td></td>
			<td align=left >NPSN</td>
			<td>:</td>
			<td align=left >".$rowS->npsn."</td>
			<td></td>
		  </tr>
		  
		  <tr> 
			<td></td>
			<td align=left >NIS / NSS / NDS</td>
			<td>:</td>
			<td align=left >".$rowS->nis." / ".$rowS->nostatistik."</td>
			<td></td>
		  </tr>
		  
		  <tr> 
			<td></td>
			<td align=left valign='top' >Alamat Sekolah</td>
			<td valign='top'>:</td>
			<td align=left width='100' >".$rowS->alamat."</td>
			<td></td>
		  </tr>
		  
		  <tr> 
			<td></td>
			<td align=left >Desa/Kelurahan</td>
			<td>:</td>
			<td align=left >".$rowS->kelurahan."</td>
			<td></td>
		  </tr>
		  
		  <tr> 
			<td></td>
			<td align=left >Kecamatan</td>
			<td>:</td>
			<td align=left >".$rowS->kecamatan."</td>
			<td></td>
		  </tr>
		  
		  <tr> 
			<td></td>
			<td align=left >Kota/Kabupaten</td>
			<td>:</td>
			<td align=left >".$rowS->kabupaten."</td>
			<td></td>
		  </tr>
		  
		  <tr> 
			<td></td>
			<td align=left >Provinsi</td>
			<td>:</td>
			<td align=left >".$rowS->provinsi."</td>
			<td></td>
		  </tr>
		  
		  <tr> 
			<td></td>
			<td align=left >Website</td>
			<td>:</td>
			<td align=left >".$rowS->website."</td>
			<td></td>
		  </tr>
		  
		  <tr> 
			<td></td>
			<td align=left >Email</td>
			<td>:</td>
			<td align=left >".$rowS->email."</td>
			<td></td>
		  </tr>
		  
		</table>
		";
	}

	$tglRaport = "";
	if($tgl_raport->num_rows()>0) {
		$tglRaport = $tgl_raport->row(0)->semester2;
	}
	$nama_kepsek = "";
	if($kepsek->num_rows()>0) {
		$nama_kepsek = $kepsek->row(0)->nama_kepsek;
	}
	
	
	$psb_nis = "";
	$psb_niy = "";
	$psb_nisn = "";
	$psb_nama = "";
	$psb_namapanggil = "";
	$psb_jk = "";
	$psb_ttl = "";
	$psb_agama = "";
	$psb_stat_kel = "";
	$psb_warganegara = "";
	$psb_anakke = "";
	$psb_alamat = "";
	$psb_telp = "";
	$psb_diterima = "";
	$psb_kelas = "";
	$psb_sekolahasal = "";
	$psb_nama_ayah = "";
	$psb_pek_ayah = "";
	$psb_alamat_ayah = "";
	$psb_nama_ibu = "";
	$psb_pek_ibu = "";
	$psb_alamat_ibu = "";
	$psb_nama_wali = "";
	$psb_pek_wali = "";
	$psb_alamat_wali = "";
	$psb_photo = "";
	
	$psb_hp = "";
	$psb_hpibu = "";
	
	$adaDataSiswaEdit = 0;
	foreach($siswa_edit_jenjang->result() as $rowEditSiswa) {
		if($row->nis==$rowEditSiswa->nis) {
			$psb_nis = $rowEditSiswa->nis;
			$psb_niy = $row->niy;
			$psb_nisn = $row->nisn;
			$psb_nama = $rowEditSiswa->nama;
			$psb_namapanggil = "";
			$psb_jk = $rowEditSiswa->jenis_kelamin;
			
			$cvtTgl = substr($rowEditSiswa->tgl_lahir,8,2);
			$cvtBln = substr($rowEditSiswa->tgl_lahir,5,2);
			$cvtThn = substr($rowEditSiswa->tgl_lahir,0,4);
			$cvtTglLahir = $cvtTgl . " " . $cvtBln . " " . $cvtThn;
			
			$psb_ttl = $rowEditSiswa->tmp_lahir . ", " . $cvtTglLahir;
			$psb_agama = $rowEditSiswa->agama;
			$psb_stat_kel = $rowEditSiswa->stat_dlm_keluarga;
			$psb_warganegara = $row->warga_negara;
			$psb_anakke = $rowEditSiswa->anak_ke;
			$psb_alamat = $rowEditSiswa->alamat;
			$psb_telp = $rowEditSiswa->telp;
			$psb_diterima = $rowEditSiswa->diterima_tgl;
			$psb_kelas = $rowEditSiswa->diterima_kelas;
			$psb_sekolahasal = $rowEditSiswa->sekolah_asal;
			$psb_nama_ayah = $rowEditSiswa->nama_ayah;
			$psb_pek_ayah = $rowEditSiswa->pek_ayah;
			$psb_alamat_ayah = $rowEditSiswa->alamat_ortu;
			$psb_nama_ibu = $rowEditSiswa->nama_ibu;
			$psb_pek_ibu = $rowEditSiswa->pek_ibu;
			$psb_alamat_ibu = $rowEditSiswa->alamat_ortu;
			$psb_nama_wali = $rowEditSiswa->nama_wali;
			$psb_pek_wali = $rowEditSiswa->pek_wali;
			$psb_alamat_wali = $rowEditSiswa->alamat_wali;
			$psb_photo = $rowEditSiswa->namePhoto;
			$psb_hp = $rowEditSiswa->telp_ortu;
			$psb_hpibu = $rowEditSiswa->telp_ortu;
			
			$adaDataSiswaEdit = 1;
		}
	}
	
	if($adaDataSiswaEdit==0) {
		foreach($siswa_psb->result() as $rowPsb) {
			if($row->nis==$rowPsb->nomorIndukSiswa) {
				$psb_nis = $rowPsb->nomorIndukSiswa;
				$psb_niy = $row->niy;
				$psb_nisn = $row->nisn;
				$psb_nama = $rowPsb->namaSiswa;
				$psb_namapanggil = "";
				$psb_jk = $rowPsb->jenisKelamin;
				$psb_ttl = $rowPsb->tmpLahir . ", " . $rowPsb->tglLahir . " " . $rowPsb->blnLahir . " " . $rowPsb->thnLahir;
				$psb_agama = $rowPsb->agama;
				$psb_warganegara = $row->warga_negara;
				$psb_anakke = $rowPsb->anakKe;
				$psb_alamat = $rowPsb->alamat;
				$psb_telp = $rowPsb->telpRumah;
				$psb_diterima = "";
				$psb_kelas = "";
				$psb_sekolahasal = $rowPsb->sekolahAsal;
				$psb_nama_ayah = $rowPsb->namaAyah;
				$psb_pek_ayah = $rowPsb->pekerjaanAyah;
				$psb_alamat_ayah = "";
				$psb_nama_ibu = $rowPsb->namaIbu;
				$psb_pek_ibu = $rowPsb->pekerjaanIbu;
				$psb_alamat_ibu = "";
				$psb_nama_wali = $rowPsb->namaWali;
				$psb_pek_wali = $rowPsb->pekerjaanWali;
				$psb_alamat_wali = "";
				$psb_photo = $rowPsb->namePhoto;
				
				$psb_hp = $rowPsb->hp;
				$psb_hpibu = $rowPsb->hpibu;
				
				break;
			}
		}
	}
	
	$detailSiswa = "
	<table border=0 align=center width=100% >
	  
	  <tr> 
		<td colspan=4 size=12 style=bold >
			IDENTITAS PERSERTA DIDIK
		</td>
	  </tr>
	  
	  <tr> 
		<td colspan=4 height=7></td>
	  </tr>
	  
	  <tr> 
		<td width='10' >1. </td>
		<td align=left >Nama Peserta Didik (Lengkap)</td>
		<td>:</td>
		<td align=left width='100' >".$psb_nama."</td>
	  </tr>
	  
	  <tr> 
		<td>2. </td>
		<td align=left >Nomor Induk</td>
		<td width=5px >:</td>
		<td align=left >".$psb_niy."</td>
	  </tr>
	  
	  <tr> 
		<td>3. </td>
		<td align=left >Tempat Tanggal Lahir</td>
		<td>:</td>
		<td align=left >".$psb_ttl."</td>
	  </tr>
	  
	  <tr> 
		<td>4. </td>
		<td align=left >Jenis Kelamin</td>
		<td>:</td>
		<td align=left >".ucfirst($psb_jk)."</td>
	  </tr>
	  
	  
	  <tr> 
		<td>5. </td>
		<td align=left >Agama</td>
		<td>:</td>
		<td align=left >".ucfirst($psb_agama)."</td>
	  </tr>
	  
	  <tr> 
		<td>6. </td>
		<td align=left >Status dalam Keluarga</td>
		<td>:</td>
		<td align=left >".$psb_stat_kel."</td>
	  </tr>
	  
	  <tr> 
		<td>7. </td>
		<td align=left >Anak ke</td>
		<td>:</td>
		<td align=left >".$psb_anakke."</td>
	  </tr>
	  
	  
	  <tr> 
		<td>8. </td>
		<td align=left >Alamat Peserta Didik</td>
		<td>:</td>
		<td align=left >".$psb_alamat."</td>
	  </tr>
	  
	  <tr> 
		<td>9. </td>
		<td align=left >Nomor Telepon Rumah</td>
		<td>:</td>
		<td align=left >".$psb_telp."</td>
	  </tr>
	  
	  <tr> 
		<td>10. </td>
		<td align=left >Sekolah Asal</td>
		<td>:</td>
		<td align=left >".$psb_sekolahasal."</td>
	  </tr>
	  
	  <tr> 
		<td>11. </td>
		<td align=left >Diterima di sekolah ini</td>
		<td></td>
		<td align=left ></td>
	  </tr>
	  
	  <tr> 
		<td></td>
		<td align=left >a. Di kelas</td>
		<td>:</td>
		<td align=left >".$psb_kelas."</td>
	  </tr>
	  
	  <tr> 
		<td></td>
		<td align=left >b. Pada tanggal</td>
		<td>:</td>
		<td align=left >".$psb_diterima."</td>
	  </tr>
	  
	  <tr> 
		<td>12. </td>
		<td align=left >Nama Orang Tua</td>
		<td></td>
		<td align=left ></td>
	  </tr>
	  
	  <tr> 
		<td></td>
		<td align=left >a. Ayah</td>
		<td>:</td>
		<td align=left >".$psb_nama_ayah."</td>
	  </tr>
	  
	  <tr> 
		<td></td>
		<td align=left >b. Ibu</td>
		<td>:</td>
		<td align=left >".$psb_nama_ibu."</td>
	  </tr>
	  
	  
	  <tr> 
		<td>13. </td>
		<td align=left >Alamat Orang Tua</td>
		<td>:</td>
		<td align=left >".$psb_alamat_ayah."</td>
	  </tr>
	  
	  <tr> 
		<td></td>
		<td align=left >Nomor Telepon Rumah</td>
		<td>:</td>
		<td align=left >".$psb_hp."</td>
	  </tr>
	  
	  
	  <tr> 
		<td>14. </td>
		<td align=left >Pekerjaan Orang Tua</td>
		<td></td>
		<td align=left ></td>
	  </tr>
	  
      <tr> 
		<td></td>
		<td align=left >a. Ayah</td>
		<td>:</td>
		<td align=left >".$psb_pek_ayah."</td>
	  </tr>
	  
	  <tr> 
		<td></td>
		<td align=left >b. Ibu</td>
		<td>:</td>
		<td align=left >".$psb_pek_ibu."</td>
	  </tr>
	  
	  
	  <tr> 
		<td>15. </td>
		<td align=left >Nama Wali Peserta Didik</td>
		<td>:</td>
		<td align=left >".$psb_nama_wali."</td>
	  </tr>
	  
	  <tr> 
		<td>16. </td>
		<td align=left >Alamat Wali Peserta Didik</td>
		<td>:</td>
		<td align=left >".$psb_alamat_wali."</td>
	  </tr>
	  
	  <tr> 
		<td></td>
		<td align=left >Nomor Telepon Rumah</td>
		<td>:</td>
		<td align=left >".$psb_telp."</td>
	  </tr>
	  
	  <tr> 
		<td>17. </td>
		<td align=left >Pekerjaan Wali Peserta Didik</td>
		<td>:</td>
		<td align=left >".$psb_pek_wali."</td>
	  </tr>
	  
	  
	</table>

	<table border=0 align=center width=100% >
		<tr> 
			<td height=5 colspan=4></td>
		</tr>
	  
		<tr>";
		
		//$_SERVER['SERVER_NAME']."/psb/photo/photoSiswa/".$rowPsb->namePhoto
		//$detailSiswa .= "<td height=45px ><img src='../psb/photo/photoSiswa/-Allysia Jovani Surjana.jpg' width='30' height='40' >".$psb_photo."</td>";
		//$detailSiswa .= "<td height=45px border=1 >".$psb_photo."</td>";
		
		$detailSiswa .= "<td width='10' ></td>";
		$detailSiswa .= "<td height='45'  >";
			if(!empty($psb_photo)) {
				$alamatPhoto = "../psb/photo/photoSiswa/".$psb_photo;
				if(file_exists($alamatPhoto)==1) {
					$detailSiswa .= "<img src='".$alamatPhoto."' width='30' height='40' >";
					// $detailSiswa .= $psb_photo;
				} else {
					$detailSiswa .= $psb_photo;
				}
			} else {
				$detailSiswa .= "<font size=9 >( Doesn't have photo yet )</font>";
			}
		$detailSiswa .= "</td>";
		$detailSiswa .= "<td width='70' ></td>";
			
		$detailSiswa .= "<td width='8' ></td>
			<td align='left' >
				Tangerang, ".$tglRaport."<br>
				Kepala Sekolah,
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				".$nama_kepsek."
			</td>
		</tr>
		
		
	</table>
	";
	
	$p->SetFont($p->defaultFontFamily, $p->defaultFontStyle, $p->defaultFontSize);
	$p->AddPage();
	$p->htmltable($coverDepan);
	$p->AddPage();
	$p->htmltable($detailSekolah);

	$p->defaultFontSize   = 10;
	$p->SetFont($p->defaultFontFamily, $p->defaultFontStyle, $p->defaultFontSize);
	$p->AddPage();
	$p->htmltable($detailSiswa);
	
	// $baris++;
	// if($baris==18) {
		// break;
	// }
	//echo $detailSiswa;
}
$p->output('Cover_raport.pdf','I');
?>