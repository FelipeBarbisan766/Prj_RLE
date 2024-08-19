<?php
include_once('../conexao.php');

$query_eventos = "SELECT evento_cod, titulo, cor, comeco, fim FROM eventos";


$result_eventos = $conexao->query($query_eventos);


$eventos = [];
if ($result_eventos->num_rows > 0) {
    while ($row_eventos = $result_eventos->fetch_assoc()) {
        $eventos[] = [
            'evento_cod' => $row_eventos['evento_cod'],
            'titulo' => $row_eventos['titulo'],
            'cor' => $row_eventos['cor'],
            'comeco' => $row_eventos['comeco'],
            'fim' => $row_eventos['fim'],
        ];
    }
}


echo json_encode($eventos);
?>