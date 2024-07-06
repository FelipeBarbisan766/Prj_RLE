<?php include_once('../navbar.php');?>
<body>
    <form action="reserva.php" method="post">
        <label for="desc">Descrição</label>
        <input type="text" name="desc" id="desc"><br>
        
        <label for="aula">Aula</label>
        <select name="aula" id="aula">
            <option value="1" <?php if(isset($_GET['aula']) && $_GET['aula'] == 1){echo 'selected';} ?>>1º Aula - 7h00/7h50</option>
            <option value="2" <?php if(isset($_GET['aula']) && $_GET['aula'] == 2){echo 'selected';} ?>>2º Aula - --/--</option>
            <option value="3" <?php if(isset($_GET['aula']) && $_GET['aula'] == 3){echo 'selected';} ?>>3º Aula - --/--</option>
            <option value="4" <?php if(isset($_GET['aula']) && $_GET['aula'] == 4){echo 'selected';} ?>>4º Aula - --/--</option>
            <option value="5" <?php if(isset($_GET['aula']) && $_GET['aula'] == 5){echo 'selected';} ?>>5º Aula - --/--</option>
            <option value="6" <?php if(isset($_GET['aula']) && $_GET['aula'] == 6){echo 'selected';} ?>>6º Aula - --/--</option>
        </select><br>
        
        <label for="data">Data</label>
        <input type="date" name="data" id="data" <?php if(isset($_GET['data'])){echo 'value="'.$_GET['data'].'"';} ?>><br>
        
        <label for="lab">Laboratorio</label>
        <select name="lab" id="lab">
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
        <input type="submit" value="Reservar">
    </form>
</body>

<!-- ----------------------------------------------------------------------------------------------------------------- -->
