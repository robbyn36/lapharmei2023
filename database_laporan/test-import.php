<?php
// MySQL database credentials
$hostname = "localhost";
$username = "root";
$password = "";
$database = "lapharmei2023";

// Connect to the MySQL server
$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Text to be stripped and imported
$text = 'ASSALAMUALAIKUM WR WB
OM SWASTIASTHU
SHALOM

Bersama ini dilaporkan kepada Jenderal giat harian *505 TIK* pada hari Sabtu tanggal 29 April 2023  jam 07.00 Wib s/d selesai sbb :

*KEGIATAN OPS KETUPAT SELIGI 2023*

1. GIAT SUBBIDTEKINFO AKP AGUNG DAN 3 PERSONIL 
MELAKSANAKAN APEL PAGI OPERASI KETUPAT SELIGI 
2023 DI LOBBY POLDA KEPRI;

2. GIAT  PERSONIL BID TIK MELAKSANAKAN APEL MALAM OPERASI KETUPAT SELIGI 2023 DI LOBBY POLDA KEPRI;

*KEGIATAN PERSONIL*

1. GIAT PERSONIL BID TIK APEL PENGECEKAN SERAH TERIMA PIKET FUNGSI , MSO , CC DAN DRIVER OPS ;

2. GIAT PERSONIL BID TIK MELAKSANAKAN PIKET FUNGSI BID TIK;

3. GIAT PERSONIL BID TIK MELAKSANAKAN PIKET FUNGSI MSO;

4. GIAT PERSONIL BID TIK MELAKSANAKAN PIKET FUNGSI COMMAND CENTER;

*KEGIATAN SUBBIDTEKINFO*

1. GIAT SUBBIDTEKINFO BRIPDA JOSUA DAN 3 PERSONIL MELAKSANAKAN SURVEY PEMASANGAN TITIK CCTV DI MAKO POLDA KEPRI DAN PENGECEKAN CCTV YANG AKTIF ATAU NONAKTIF;

*KEGIATAN SITIPOL*

1. GIAT SITIPOL POLRES JAJARAN MENYIAPKAN PERANGKAT SOUND SYSTEM UNTUK GIAT APEL PAGI PERSONIL;

Dum
KABID TIK POLDA KEPRI
29/04/23 22.53 - Robby Naibaho: Kepada Yth :
⭐⭐ *Kadiv TIK Polri*
⭐⭐ *Kapolda Kepri*

Dari : Kabid TIK Polda Kepri

■ Tembusan :
*1. Karo Tekkom Div TIK*
*2. Karo Tekinfo Div TIK*
*3. Wakapolda Kepri*
*4. Irwasda Polda Kepri*
*5. Para PJU Div TIK*
*6. Para PJU Polda Kepri*

Assalamualaikum wr.wb ,
Selamat malam Jenderal, mohon ijin melaporkan Giat harian Bid TIK Polda Kepulauan Riau, hari Sabtu tanggal 29 April 2023 ( Data dan Dokumentasi Terlampir ) sebagai berikut :

*KEGIATAN OPS KETUPAT SELIGI 2023*

1. GIAT SUBBIDTEKINFO AKP AGUNG DAN 3 PERSONIL MELAKSANAKAN APEL PAGI OPERASI KETUPAT SELIGI 
2023 DI LOBBY POLDA KEPRI;

2. GIAT PERSONIL BID TIK MELAKSANAKAN APEL MALAM OPERASI KETUPAT SELIGI 2023 DI LOBBY POLDA KEPRI;

*KEGIATAN PERSONIL*

1. GIAT PERSONIL BID TIK APEL PENGECEKAN SERAH TERIMA 
PIKET FUNGSI , MSO , CC DAN DRIVER OPS ;

2. GIAT PERSONIL BID TIK MELAKSANAKAN PIKET FUNGSI BID TIK;

3. GIAT PERSONIL BID TIK MELAKSANAKAN PIKET FUNGSI MSO;

4. GIAT PERSONIL BID TIK MELAKSANAKAN PIKET FUNGSI COMMAND CENTER;

*KEGIATAN SUBBIDTEKINFO*

1. GIAT SUBBIDTEKINFO BRIPDA JOSUA DAN 3 PERSONIL MELAKSANAKAN SURVEY PEMASANGAN TITIK CCTV DI MAKO POLDA KEPRI DAN PENGECEKAN CCTV YANG AKTIF ATAU NONAKTIF;

*KEGIATAN SITIPOL*

1. GIAT SITIPOL POLRES JAJARAN MENYIAPKAN PERANGKAT SOUND SYSTEM UNTUK GIAT APEL PAGI PERSONIL;


Dum.
KABID TIK POLDA KEPRI
Wassalamualaikum Wr Wb;';


// Extracting data for insertion
$pattern = '/GIAT\s([A-Z\s]+)/';
if (preg_match_all($pattern, $text, $matches)) {
    $row1 = $matches[1];
} else {
    $row1 = array();
}

$pattern = '/(\d{1,2}\/\d{1,2}\/\d{2,4})/';
if (preg_match_all($pattern, $text, $matches)) {
    $row2 = $matches[1];
} else {
    $row2 = array();
}

$pattern = '/GIAT\s([A-Z]+)/';
if (preg_match_all($pattern, $text, $matches)) {
    $row3 = array_combine($matches[0], $matches[1]);
} else {
    $row3 = array();
}

// Prepare and execute SQL statements for insertion
$stmt = $conn->prepare("INSERT INTO laporan_harian (row1, row2, row3) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $val1, $val2, $val3);

foreach ($row1 as $index => $value) {
    $val1 = isset($row1[$index]) ? trim($row1[$index]) : '';
    $val2 = isset($row2[$index]) ? date('Y-m-d', strtotime($row2[$index])) : '';
    $val3 = isset($row3[$value]) ? trim($row3[$value]) : '';
    $stmt->execute();
}

$stmt->close();
$conn->close();
