<form action="" method="get">
    <label for="data">Data:</label>
    <input type="date" name="data" id="data">
    <input type="submit" value="Continuar">
</form>
<?php
// $domingo = 6; //domingo = 6º dia = fim da semana.
// // $dia_atual = $_GET['data'];
// // $dia_atual = new DateTime( $dia_atual, new DateTimeZone('America/Sao_Paulo') );
// // $dia_atual = $dia_atual->format('w');
// $dia_atual = date('w'); //pego o dia atual
// echo $dia_atual;
// echo '<br/ >';
// $dias_que_faltam_para_o_domingo = $domingo - $dia_atual;
// $inicio = strtotime("  -$dia_atual days");
// $fim = strtotime(" +$dias_que_faltam_para_o_domingo days");

// echo date('m-d-Y', $inicio); //data inicial
// echo '<br/ >';
// echo date('m-d-Y', $fim); //data final

// $translate = array(
//     0 => "Dom",
//     1 => "Seg",
//     2 => "Ter",
//     3 => "Qua",
//     4 => "Qui",
//     5 => "Sex",
//     6 => "Sab",
// );

// echo '<br/ >';
// echo '<br/ >';
if(isset($_GET['data'])){
    $data = new DateTime($_GET['data']);
}else{  
    $data = new DateTime();
}  
$diaN = date("w", strtotime($data->format('Y-m-d')));

$data->modify('-' . $diaN . ' day');

for ($i = 0; $i <= 6; $i++) {
    echo $data->format('d/m/Y') . ' - ' . $translate[$data->format('w')] . "<br>";
    $data->modify('+1 day');
}

// Documentação de datas !

// d - The day of the month (from 01 to 31)
// D - A textual representation of a day (three letters)
// j - The day of the month without leading zeros (1 to 31)
// l (lowercase 'L') - A full textual representation of a day
// N - The ISO-8601 numeric representation of a day (1 for Monday, 7 for Sunday)
// S - The English ordinal suffix for the day of the month (2 characters st, nd, rd or th. Works well with j)
// w - A numeric representation of the day (0 for Sunday, 6 for Saturday)
// z - The day of the year (from 0 through 365)
// W - The ISO-8601 week number of year (weeks starting on Monday)
// F - A full textual representation of a month (January through December)
// m - A numeric representation of a month (from 01 to 12)
// M - A short textual representation of a month (three letters)
// n - A numeric representation of a month, without leading zeros (1 to 12)
// t - The number of days in the given month
// L - Whether it's a leap year (1 if it is a leap year, 0 otherwise)
// o - The ISO-8601 year number
// Y - A four digit representation of a year
// y - A two digit representation of a year
// a - Lowercase am or pm
// A - Uppercase AM or PM
// B - Swatch Internet time (000 to 999)
// g - 12-hour format of an hour (1 to 12)
// G - 24-hour format of an hour (0 to 23)
// h - 12-hour format of an hour (01 to 12)
// H - 24-hour format of an hour (00 to 23)
// i - Minutes with leading zeros (00 to 59)
// s - Seconds, with leading zeros (00 to 59)
// u - Microseconds (added in PHP 5.2.2)
// e - The timezone identifier (Examples: UTC, GMT, Atlantic/Azores)
// I (capital i) - Whether the date is in daylights savings time (1 if Daylight Savings Time, 0 otherwise)
// O - Difference to Greenwich time (GMT) in hours (Example: +0100)
// P - Difference to Greenwich time (GMT) in hours:minutes (added in PHP 5.1.3)
// T - Timezone abbreviations (Examples: EST, MDT)
// Z - Timezone offset in seconds. The offset for timezones west of UTC is negative (-43200 to 50400)
// c - The ISO-8601 date (e.g. 2013-05-05T16:34:42+00:00)
// r - The RFC 2822 formatted date (e.g. Fri, 12 Apr 2013 12:01:05 +0200)
// U - The seconds since the Unix Epoch (January 1 1970 00:00:00 GMT)
