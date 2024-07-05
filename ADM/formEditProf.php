<?php
include_once ("../navbar.php");
?>
<div class="container">

    <form action="formEditProf.php" method="get">
        <label for="prof" class="col-form-label">Professores:</label>
        <select class="form-select form-select-lg mb-3" aria-label="prof" name="prof" id="prof">
            <?php
        $slq = mysqli_query($conexao, "SELECT * FROM professor");
        while ($prof = mysqli_fetch_array($slq)) {
            if ($prof['prof_isActive'] == true) { ?>
                <option value="<?php echo $prof['prof_cod']; ?>"><?php echo $prof['prof_nome']; ?></option>
                <?php }
        }
        ; ?>
    </select>
    
    <input type="submit" class="btn btn-primary">
</form>
<?php
if(isset($_GET['prof'])) {
    ?>
<form action="addProf.php" method="post">
    <div class="mb-3">
        <?php
        
        $slq = mysqli_query($conexao, 'SELECT * FROM professor WHERE prof_cod=' . $_GET['prof'] . '');
        $prof = mysqli_fetch_array($slq);
        
        ?>
        <label for="nome" class="col-form-label">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $prof['prof_nome']; ?>">
    </div>
    <div class="mb-3">
        <label for="senha" class="col-form-label">Senha:</label>
        <input type="text" class="form-control" id="senha" name="senha" value="<?php echo $prof['prof_senha']; ?>">
    </div>
    
    <input type="submit" class="btn btn-primary">
</form>
<?php }?>
</div>