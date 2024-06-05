<?php
include_once ("../navbar.php");
?>
<div class="container">
    
    <form action="addProf" modal="post">
        <div class="mb-3">
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
</div>