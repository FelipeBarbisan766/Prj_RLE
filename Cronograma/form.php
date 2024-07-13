<?php include_once('../navbar.php');?>
<body>
<a class="btn btn-primary" href="cronograma.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/></svg> voltar</a>
    <br>
<form action="registro.php" method="post">
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
        
        <label for="sem">Semana</label>
        <select name="sem" id="sem">
            <option value="1">Segunda</option>
            <option value="2">terça</option>
            <option value="3">Quarta</option>
            <option value="4">Quinta</option>
            <option value="5">Sexta</option>
        </select><br>
        
        <label for="prof">Professor</label>
        <select name="prof" id="prof">
        <?php
        include_once ("../conexao.php");
        $slq = mysqli_query($conexao, "SELECT * FROM professor");
        while ($prof = mysqli_fetch_array($slq)) {
          if ($prof['prof_isActive'] == true) { ?>
              <option value="<?php echo $prof['prof_cod']; ?>"><?php echo $prof['prof_nome']; ?></option>
                    <?php }
        }
        ; ?>
        </select><br>
        
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
