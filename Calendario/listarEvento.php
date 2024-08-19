<?php
include_once('../conexao.php');

$query_eventos = "SELECT evento_cod, titulo, cor, comeco, fim FROM eventos";

$result_eventos = $conexao->query($query_eventos);

$eventos = [];
if ($result_eventos->num_rows > 0) {
    while ($row_eventos = $result_eventos->fetch_assoc()) {
        $eventos[] = [
            'id' => $row_eventos['evento_cod'],
            'title' => $row_eventos['titulo'],
            'color' => $row_eventos['cor'],
            'start' => $row_eventos['comeco'],
            'end' => $row_eventos['fim'],
        ];
    }
}

echo json_encode($eventos);
?>