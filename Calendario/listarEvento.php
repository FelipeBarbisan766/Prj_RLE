<?php
include_once('../conexao.php');

$query_eventos = "SELECT r.res_cod as cod, r.res_desc as descr, r.res_data as dat, p.prof_nome as prof, l.lab_nome as lab, r.res_aula as aula  FROM reserva as r INNER JOIN professor as p on r.prof_cod=p.prof_cod INNER JOIN laboratorio as l on r.lab_cod=l.lab_cod";

$result_eventos = $conexao->query($query_eventos);

$eventos = [];
if ($result_eventos->num_rows > 0) {
    while ($row_eventos = $result_eventos->fetch_assoc()) {
        $eventos[] = [
            'id' => $row_eventos['cod'],
            'title' => $row_eventos['descr'],
            'start' => $row_eventos['dat'],
            'prof' => $row_eventos['prof'],
            'lab' => $row_eventos['lab'],
            'aula' => $row_eventos['aula'],
        ];
    }
}

echo json_encode($eventos);