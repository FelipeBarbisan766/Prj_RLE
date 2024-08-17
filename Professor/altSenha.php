<?php
include_once ("../conexao.php");
include_once ("../navbar.php");
include_once ("../protect.php");
?>
<a class="btn btn-primary" href="pageProfessor.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/></svg> voltar</a>

<div class="container">

    <?php
    if (isset($_GET['senha'])) {
        $cod = $_SESSION['cod'];
        $senha = $_GET['senha'];
        $sql_code = "SELECT * FROM professor WHERE prof_cod = '$cod' AND prof_senha ='$senha'";
        $sql_query = $conexao->query($sql_code) or die("falha na execução do codigo");

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {
            ?>
            <h1>Alteração de Senha do Professor</h1>
            <form action="altSenha.php" method="post">
                
                <label for="nova_senha" class="form-label">Nova senha:</label>
                <input type="text" name="nova_senha" id="nova_senha" class="form-control" required>
                <br>
                <label for="nova_senha2" class="form-label">Confirme a Nova senha:</label>
                <input type="text" name="nova_senha2" id="nova_senha2" class="form-control" required>
                <br>
                <input type="submit" value="Registrar" class="btn btn-primary">
                <a type="button" href="pageProfessor.php" class="btn btn-secondary">Cancelar</a>
            </form>
            <?php
        } else {
            echo '  <form action="" method="">
                        <label for="senha" class="form-label">Digite Sua Senha Atual Novamente:</label>
                        <input type="text" name="senha" id="senha" class="form-control" required><br>
                        <input type="submit" value="Registrar" class="btn btn-primary">
                        <a type="button" href="pageProfessor.php" class="btn btn-secondary">Cancelar</a>
                    </form><br>
                    <div class="alert alert-warning" role="alert">
                    <p>Senha incorreta! Verifique novamente</p>
                    </div>';
        }
    }elseif(isset($_POST['nova_senha'])){
        $cod = $_SESSION['cod'];
        $senha_nova = $_POST['nova_senha'];
        $senha_nova2 = $_POST['nova_senha2'];
        if($senha_nova == $senha_nova2){
            $sql = mysqli_query($conexao,"UPDATE professor SET prof_senha='$senha_nova' WHERE prof_cod='$cod'");
            if($sql){
                header('Location:pageProfessor.php');
            }else{
                echo "Erro no alter";
            }
        }else{
            echo '
            <h1>Alteração de Senha do Professor</h1>
            <form action="altSenha.php" method="post">
                
                <label for="nova_senha" class="form-label">Nova senha:</label>
                <input type="text" name="nova_senha" id="nova_senha" class="form-control" required>
                <br>
                <label for="nova_senha2" class="form-label">Confirme a Nova senha:</label>
                <input type="text" name="nova_senha2" id="nova_senha2" class="form-control" required>
                <br>
                <input type="submit" value="Registrar" class="btn btn-primary">
                <a type="button" href="pageProfessor.php" class="btn btn-secondary">Cancelar</a>
            </form>
            <br>
            <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">As senhas não coincidem</h4>
            <p>Alguma das senhas estão incorretas, tente novamente!</p></div>';
        }
    }
    else {
        ?>
        <h3>Antes de prosseguir confirme sua indentidade</h3>
        <form action="" method="">
            <label for="senha" class="form-label">Digite Sua Senha Atual:</label>
            <input type="text" name="senha" id="senha" class="form-control" required><br>
            <input type="submit" value="Registrar" class="btn btn-primary">
            <a type="button" href="pageProfessor.php" class="btn btn-secondary">Cancelar</a>
        </form>
        <?php
    }
    ?>



</div>