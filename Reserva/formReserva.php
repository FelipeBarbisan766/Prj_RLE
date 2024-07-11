<?php include_once ('../navbar.php'); ?>
<style>
.form-label{
    font-size:45px;
}
</style>
<body>
    <div class="container text-center">
<?php if(isset($_GET['data'])&&isset($_GET['lab'])) {?>
        <form action="reserva.php" method="post">
            <label for="desc" class="form-label">Descrição</label>
            <input type="text" name="desc" id="desc" class="form-control"><br>
            
            <?php
            $lab = $_GET['lab'];
            $data = $_GET['data'];
            $timestamp = strtotime((new DateTime( $data))->format('d-m-Y')); 
            $arrydata = getdate($timestamp);
            $sem = $arrydata['wday']; 
            $slq_reserva = mysqli_query($conexao, "SELECT res_aula FROM reserva WHERE res_data = '$data' AND lab_cod = '$lab' ");
            $slq_cronograma = mysqli_query($conexao, "SELECT cro_aula FROM cronograma WHERE cro_sem = '$sem' AND lab_cod = '$lab' ");
            while ($reserva = mysqli_fetch_array($slq_reserva)){
            ?>

            <label for="aula" class="form-label">Aula</label>
            <select name="aula" id="aula" class="form-select">
                <option value="1" <?php if ($reserva['res_aula']==1 || $cronograma['cro_aula']==1) {
                    echo 'disabled';
                } ?>>1º Aula -
                    7h00/7h50</option>
                <option value="2" <?php if ($reserva['res_aula']==2 || $cronograma['cro_aula']==2) {
                    echo 'disabled';
                } ?>>2º Aula -
                    --/--</option>
                <option value="3" <?php if ($reserva['res_aula']==3 || $cronograma['cro_aula']==3) {
                    echo 'disabled';
                } ?>>3º Aula -
                    --/--</option>
                <option value="4" <?php if ($reserva['res_aula']==4 || $cronograma['cro_aula']==4) {
                    echo 'disabled';
                } ?>>4º Aula -
                    --/--</option>
                <option value="5" <?php if ($reserva['res_aula']==5 || $cronograma['cro_aula']==5) {
                    echo 'disabled';
                } ?>>5º Aula -
                    --/--</option>
                <option value="6" <?php if ($reserva['res_aula']==6 || $cronograma['cro_aula']==6) {
                    echo 'disabled';
                } ?>>6º Aula -
                    --/--</option>
            </select><br>
            <?php } 
            echo '<input type="hidden" name="data" value="'.$data.'">';
            echo '<input type="hidden" name="lab" value="'.$lab.'">';?>
            
            <input type="submit" value="Reservar" class="btn btn-primary">
        </form>
        
        
    <?php }else{ ?>
        <form action="" method="">
        <label for="data" class="form-label">Data</label>
        <input type="date" name="data" id="data" class="form-control" <?php if (isset($_GET['data'])) {echo 'value="' . $_GET['data'] . '"';} ?> required><br>

        <label for="lab" class="form-label">Laboratorio</label>
        <select name="lab" id="lab" class="form-select" required>
            <?php
            include_once ("../conexao.php");
            $slq = mysqli_query($conexao, "SELECT * FROM laboratorio");
            while ($labs = mysqli_fetch_array($slq)) {
                if ($labs['lab_isActive'] == true) { ?>
                    <option value="<?php echo $labs['lab_cod']; ?>"><?php echo $labs['lab_nome']; ?></option>
                <?php }
            }
            ; ?>
            </select><br>
            <input type="submit" value="Continuar" class="btn btn-primary">
    </form>
    <?php }; ?>
    </div>
</body>

<!-- ----------------------------------------------------------------------------------------------------------------- -->