<?php
	header('Content-Type:application/json');
	header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
	error_reporting(0);
	date_default_timezone_set('Asia/Jakarta');

	$connsqlserver = odbc_connect("Driver={SQL Server};Server=36.93.204.245;Database=dbhospital;", "sa", "rspkublora2)22");
	$connsqlserver_hrd = odbc_connect("Driver={SQL Server};36.93.204.245;Database=DBHRD;", "sa", "rspkublora2)22");

	$json = json_decode(file_get_contents('php://input'));

	$k = getallheaders();
	$user = "mjkn-rsi";
	$pass = "54321";

	if(($k['user'] == $user) && ($k['key'] == $pass))
	{
		$nik 		= $json->nik;
		$rm 		= $json->norm;
		$bpjs 		= $json->nomorkartu;
		$rujuk 		= $json->nomorrujukan;
		$nohp 		= $json->nohp;
		$poli1 		= $json->kodepoli;
		$tanggal 	= $json->tanggalperiksa;
		$waktu 		= date('H:i:s', $json->waktu);
		$dokter1 	= $json->kodedokter;
		$pt 		= '2028';
		$rm 		= sprintf("%08s", $rm);

		$hrdb = date('w', strtotime($tanggal)) + 1;

		// Mapping Poli BPJS
		$sql = "SELECT KODERS FROM BPJS_MAPPINGPOLI WHERE KODEBPJS = '$poli1'";
		$rs = odbc_exec($connsqlserver, $sql);
		$ada_poli = odbc_num_rows($rs);
		$no = 1;
		while (odbc_fetch_row($rs))
		{	
			$poli = odbc_result($rs, "KODERS");
		}

		// Mapping Dokter BPJS
		$sql = "SELECT KODERS FROM BPJS_MAPPINGDOKTER WHERE KODEBPJS = '$dokter1'";
		$rs = odbc_exec($connsqlserver, $sql);
		$ada_dokter = odbc_num_rows($rs);
		$no = 1;
		while (odbc_fetch_row($rs))
		{	
			$dokter = odbc_result($rs,"KODERS");
		}
						
		// Cek Pasien
		$sql = "SELECT * FROM PASIEN WHERE NOPASIEN = '$rm'";
		$rs = odbc_exec($connsqlserver, $sql);
		$ada_pasien = odbc_num_rows($rs);
		
		// Cek Pasien Baru
		$sql = "SELECT * FROM PASIEN WHERE NOKTP = '$nik' OR NOKARTU = '$bpjs'";
		$rs = odbc_exec($connsqlserver, $sql);
		$pasien_baru = odbc_num_rows($rs);
						
		// Cek Kuota Dokter di Jadwal Dokter
		$sql = "SELECT * FROM JWDOKTER WHERE KODEDOKTER = '$dokter' AND KODEBAGIAN = '$poli' AND KODEHARI='$hrdb'";
		$rs = odbc_exec($connsqlserver,$sql);
		$ada_jadwal = odbc_num_rows($rs);
		while (odbc_fetch_row($rs))
		{
			$kuota = odbc_result($rs, "KUOTAONLINE");
			$kuota_off = odbc_result($rs, "KUOTAOFFLINE");
		}

		//Cek Waktu (Hari) di Jadwal Dokter
		$sql = "SELECT KODEWAKTU FROM JWDOKTER WHERE KODEDOKTER = '$dokter' AND KODEBAGIAN = '$poli' AND KODEHARI = '$hrdb'";
		$rs = odbc_exec($connsqlserver,$sql);
		$ada_jadwal = odbc_num_rows($rs);
		$no = 1;					
		while (odbc_fetch_row($rs))
		{
			$kodewaktu = odbc_result($rs,"KODEWAKTU");									
		}

		// Cek Kuota Dokter dan Poli
		$terpakai1 = "SELECT a.noreg FROM REGDR AS A, REGPAS AS b WHERE a.KODEDOKTER = '$dokter' AND a.BAGREGDR = '$poli' AND b.TGLREG = '$tanggal' AND a.NOREG = b.NOREG";
		$r_terpakai = odbc_exec($connsqlserver, $terpakai1);
		$terpakai = odbc_num_rows($r_terpakai);
		if ($terpakai >= $kuota)
		{
			$ada_kuota = 0;
		}
		else
		{
			$ada_kuota = 1;
		}
		$sisajkn1 = $kuota - $terpakai;

		$notif_1 = "Sukses";
		$kode_1 = "200";

		// Cek Kondisi dari hasil Request
		if ($ada_pasien == 0)
		{
			$kode_1 = "203";
			$notif_1 =" -No Pasien Tidak Ditemukan";
		}
		if ($pasien_baru == 0)
		{
			$kode_1 = "203";
			$notif_1 =" -Pasien Belum Terdaftar di Rumah Sakit. Silahkan ke Bagian Admisi";			
		}
		if ($ada_jadwal == 0)
		{
			$kode_1 = "204";
			$notif_1 = " -Jadwal Dokter Tidak Ditemukan";
		}
		if ($ada_poli == 0)
		{
			$kode_1 = "202";
			$notif_1 =   " -Kode Poli Tidak Ada";
		}
		if ($ada_kuota == 0)
		{
			$kode_1 = "205";
			$notif_1 = " -Kuota Online Habis" . $terpakai . $kuota ;
		}
		if ($ada_dokter == 0)
		{
			$kode_1 = "201";
			$notif_1 = " -Kode Dokter Tidak Ada";
		}

		//Proses Daftar
		if($kode_1 == '200')
		{
			$null = date('ymd', strtotime($tanggal)) . '0000';
			$sql = "SELECT CONVERT(BIGINT, ISNULL(MAX(NOREG), '$null')) + 1 AS NOREG FROM REGPAS WHERE TGLREG = '$tanggal'";
			$rs = odbc_exec($connsqlserver, $sql);
			while (odbc_fetch_row($rs))
			{
				$noreg = odbc_result($rs, "NOREG");
			}

			$null = date('ymd', strtotime($tanggal)) . '0000';
			$sql = "SELECT ISNULL(MAX(NOBOOKING), '$null') AS NOBOOK FROM REGBOOKING WHERE UTKTGLREG = '$tanggal'";

			$rs=odbc_exec($connsqlserver, $sql);
			while (odbc_fetch_row($rs))
			{
				$nobook = odbc_result($rs, "NOBOOK");
				$nobook = $nobook + 1;	
			}						

			$sql = "SELECT ISNULL(MAX(NOURUTDR), '0') AS urut FROM REGBOOKING WHERE WAKTUDR = '$kodewaktu' AND UTKTGLREG = '$tanggal' AND KODEDOKTER = '$dokter' AND KODEBAGIAN = '$poli'";
			$rs = odbc_exec($connsqlserver, $sql);
			while (odbc_fetch_row($rs))
			{
				$urut = odbc_result($rs, "urut");
				$urut = $urut + 1;
			}

			// Simpan hasil Request ke dalam Database
			$sql = "INSERT INTO REGBOOKING(NORUJUKAN, NOBOOKING, KODEBAGIAN, KODEDOKTER, WAKTUDR, TYPEPASIEN, NOPASIEN, NAMAPASIEN, UTKTGLREG, JAMDTG, TGLPESAN, JAMPESAN, NOTELP, VALID, TIPEBOOKING, NOURUTDR, NOREG, CEKSEP) 
			VALUES ('$rujuk', '$nobook', '$poli', '$dokter', '$kodewaktu', 'L', '$rm', '$nama', '$tanggal', '$waktu', GETDATE(), GETDATE(), '$username', 'V', '1', '$urut', '$noreg', 'N')";

			$rs = odbc_execute($p, $isi);
			$rs = odbc_exec($connsqlserver, $sql) or die ("Gagal Transaksi REGBOOKING");

			$sql = "INSERT INTO REGPAS(NOREG, NOPASIEN, KODEPT, TGLREG, JAMREG, ASALREG, BARULAMA, REGTELP, CRKUNJUNG, VALIDRI, USLOGNM, CLIENT) 
			VALUES ('$noreg', '$rm', '$pt', '$tanggal', GETDATE(), 'J', 'L', 'W', '2', 'O', 'ADMIN', 'JKN') ";
			$rs = odbc_exec($connsqlserver, $sql) or die ("Gagal Transaksi REGPAS");

			$sql = "INSERT INTO REGDR(KODEDOKTER, dokterpgnt, NOREG, waktureg, nourutdr, bagregdr, flagicd, tglinput, flagresume) 
			VALUES ('$dokter', '$dokter', '$noreg', '$kodewaktu', '$urut', '$poli', 'N', GETDATE(), 'T')";
			$rs = odbc_exec($connsqlserver, $sql) or die ("Gagal Transaksi REGDR");

			$sql = "UPDATE JWDOKTER SET terpakaionline = terpakaionline + 1, NOURUTDR = NOURUTDR + 1 WHERE KODEDOKTER = '$dokter' AND KODEHARI = '$hrdb'";
			$rs = odbc_exec($connsqlserver, $sql);
			
		}

		// Proses Pendaftaran Selesai
		echo 
			'{
				"response": {
						"noreg" : "'.$noreg.'",
						"urut" : "'.$urut.'",
						"nopasien" : "'.$rm.'",
						"KODEDOKTERrs" : "'.$dokter.'",
						"kodepolirs" : "'.$poli.'",
						"tanggal" : "'.$tanggal.'",
						"jkn" : '.$kuota.',
						"sisajkn" : '.$sisajkn1.',
						"nonjkn" : '.$kuota_off.',
						"sisanonjkn" : 0,
						"keterangan" : "Tunjukkan Pada Petugas Saat Akan Periksa."
				},
				"metadata": {
					"message": "'.$notif_1.'",
					"code": '.$kode_1.'
				}
			}';
	}
	else
	{
		echo   
			'{
				"response": {
						"keterangan" : "Gagal."
				},
				"metadata": {
					"message": "100",
					"code": "User dan Key Tidak Cocok"
				}
			}';	
	}	
?>