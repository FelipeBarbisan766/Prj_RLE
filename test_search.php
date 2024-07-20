
<?php  
include_once ("conexao.php");
include_once ("navbar.php");
if(isset($_GET['busca'])){

    $busca=strtoupper($_GET['busca']);
    //nome similar 
    $slq_reserva = mysqli_query($conexao, "SELECT r.res_aula as aula,r.res_desc as descr,r.res_isActive as active, p.prof_nome as prof FROM reserva as r INNER JOIN professor as p on r.prof_cod=p.prof_cod INNER JOIN laboratorio as l on r.lab_cod=l.lab_cod WHERE r.res_desc like '%".$busca."%' ORDER BY r.res_aula ASC");
    $slq_cronograma = mysqli_query($conexao, "SELECT c.cro_aula as aula,c.cro_desc as descr,c.cro_isActive as active, p.prof_nome as prof FROM cronograma as c INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod INNER JOIN professor as p on c.prof_cod=p.prof_cod WHERE  c.cro_desc like '%".$busca."%' ORDER BY c.cro_aula ASC");
    $quant = $slq_reserva->num_rows;
    if($quant >= 1){
        echo '<h2>Reservas Com Nomes Similares</h2>';
        while ($reserva = mysqli_fetch_array($slq_reserva)) {
        echo '<a class="list-group-item list-group-item-action">1ºAula - '.$reserva['descr'].'- Professor(a)'.$reserva['prof'].'</a>';
        }
    }
    $quant = $slq_cronograma->num_rows;
    if($quant >= 1){
        echo '<h2>Cronogramas Com Nomes Similares</h2>';
        while ($cronograma = mysqli_fetch_array($slq_cronograma)) {
        echo '<a class="list-group-item list-group-item-action">1ºAula - '.$cronograma['descr'].'- Professor(a)'.$cronograma['prof'].'</a>';
        }
    }
    //reservas/cornogramas dos professor similar 
    $slq_reserva = mysqli_query($conexao, "SELECT r.res_aula as aula,r.res_desc as descr,r.res_isActive as active, p.prof_nome as prof FROM reserva as r INNER JOIN professor as p on r.prof_cod=p.prof_cod INNER JOIN laboratorio as l on r.lab_cod=l.lab_cod WHERE p.prof_nome like '%".$busca."%' ORDER BY r.res_aula ASC");
    $slq_cronograma = mysqli_query($conexao, "SELECT c.cro_aula as aula,c.cro_desc as descr,c.cro_isActive as active, p.prof_nome as prof FROM cronograma as c INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod INNER JOIN professor as p on c.prof_cod=p.prof_cod WHERE  p.prof_nome  like '%".$busca."%' ORDER BY c.cro_aula ASC");
    $quant = $slq_reserva->num_rows;
    if($quant >= 1){
        echo '<h2>Reservas dos Professores com nome Similares</h2>';
        while ($reserva = mysqli_fetch_array($slq_reserva)) {
        echo '<a class="list-group-item list-group-item-action">1ºAula - '.$reserva['descr'].'- Professor(a)'.$reserva['prof'].'</a>';
        }
    }
    $quant = $slq_cronograma->num_rows;
    if($quant >= 1){
        echo '<h2>Cronogramas dos Professores Com Nomes Similares</h2>';
        while ($cronograma = mysqli_fetch_array($slq_cronograma)) {
        echo '<a class="list-group-item list-group-item-action">1ºAula - '.$cronograma['descr'].'- Professor(a)'.$cronograma['prof'].'</a>';
        }
    }
    //

}else{
    ?>

<form action="">
    <label for="">Search</label>
    <input type="text" name="busca">
    <input type="submit" value="Submit">
</form>

<?php
}

?> 