<?php
include_once ("../navbar.php");
?>
<div class="container">

    <form action="addProf.php" method="post">
        <div class="mb-3">
            <label for="nome" class="col-form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome">
        </div>
        <div class="mb-3">
            <label for="senha" class="col-form-label">Senha:</label>
            <input type="text" class="form-control" id="senha" name="senha">
        </div>
        <div class="mb-3">
            <label for="cargo" class="col-form-label">Cargo:</label>
            <select name="cargo" id="cargo" class="form-select">
                <option value="prof">Professor</option>
                <option value="adm">Coordenador / Administrador</option>
            </select><br>
        </div>
        
        <input type="submit" class="btn btn-primary">
    </form>
</div>