<?php
$sabado = 6; //sabado = 6º dia = fim da semana.
$dia_atual = date('w'); //pego o dia atual
$dias_que_faltam_para_o_sabado = $sabado - $dia_atual;

$inicio = strtotime("-$dia_atual days");
$fim = strtotime("+$dias_que_faltam_para_o_sabado days");

echo date('m-d-Y', $inicio); //data inicial
echo '<br/ >';
echo date('m-d-Y', $fim); //data final

$translate = array(
    0 => "Dom",
    1 => "Seg",
    2 => "Ter",
    3 => "Qua",
    4 => "Qui",
    5 => "Sex",
    6 => "Sab",
);

echo '<br/ >';
echo '<br/ >';

$data = new DateTime();
$diaN = date("w", strtotime($data->format('Y-m-d')));

$data->modify('-' . $diaN . ' day');

for ($i = 0; $i <= 6; $i++) {
    echo $data->format('d/m/Y') . ' - ' . $translate[$data->format('w')] . "<br>";
    $data->modify('+1 day');
}