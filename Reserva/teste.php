<?php if($data = 2){?>
        <label for="aula" class="form-label">Aula</label>
        <select name="aula" id="aula" class="form-select">
            <option value="1" <?php if (isset($_GET['aula']) && $_GET['aula'] == 1) {
                echo 'selected';
            } ?>>1º Aula -
                7h00/7h50</option>
            <option value="2" <?php if (isset($_GET['aula']) && $_GET['aula'] == 2) {
                echo 'selected';
            } ?>>2º Aula -
                --/--</option>
            <option value="3" <?php if (isset($_GET['aula']) && $_GET['aula'] == 3) {
                echo 'selected';
            } ?>>3º Aula -
                --/--</option>
            <option value="4" <?php if (isset($_GET['aula']) && $_GET['aula'] == 4) {
                echo 'selected';
            } ?>>4º Aula -
                --/--</option>
            <option value="5" <?php if (isset($_GET['aula']) && $_GET['aula'] == 5) {
                echo 'selected';
            } ?>>5º Aula -
                --/--</option>
            <option value="6" <?php if (isset($_GET['aula']) && $_GET['aula'] == 6) {
                echo 'selected';
            } }?>>6º Aula -
                --/--</option>
        </select><br>