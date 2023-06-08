<?php

$text = 'ASSALAMUALAIKUM WR WB
OM SWASTIASTHU
SHALOM

Bersama ini dilaporkan kepada Jenderal giat harian *505 TIK* pada hari Sabtu tanggal 29 April 2023 jam 07.00 Wib s/d selesai sbb :

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

2. GIAT  PERSONIL BID TIK MELAKSANAKAN APEL MALAM OPERASI KETUPAT SELIGI 2023 DI LOBBY POLDA KEPRI;

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

// Strip the text starting from "Tembusan" to "Wassalamualaikum"
$strippedText = preg_replace('/Tembusan.*Wassalamualaikum/s', '', $text);

// Separate the text between " GIAT " and ";" symbol
$pattern = '/ GIAT (.*?);/';
$matches = [];

preg_match_all($pattern, $strippedText, $matches);

$hasilGiat = $matches[1];

// Detect and format dates as dd/mm/yy
$datePattern = "/\b(\d{1,2}\s\w+\s\d{4})\b/";
$dateMatches = [];

preg_match_all($datePattern, $strippedText, $dateMatches);

$formattedDates = [];
foreach ($dateMatches[0] as $date) {
    $dateTime = DateTime::createFromFormat('d F Y', $date);
    $formattedDates[] = $dateTime->format('d/m/y');
}

// Export to CSV
$csvData = "Hasil Giat;Date\n";
$count = min(count($hasilGiat), count($formattedDates));

for ($i = 0; $i < $count; $i++) {
    $csvData .= $hasilGiat[$i] . '";' . $formattedDates[$i] . "\"\n";
}

// Set the appropriate headers for CSV file download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="hasil_giat.csv"');

// Output the CSV data to the browser
echo $csvData;
?>
