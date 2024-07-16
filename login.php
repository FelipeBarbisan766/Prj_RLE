<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</head>

<body>
  <?php
  include_once ("conexao.php");
  ?>
  <section class="vh-50 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
              <div class="mb-md-5 mt-md-4 pb-5">
                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50 mb-5">Porfavor coloque seu Usuário e Senha</p>
                <form action="" method="POST">
                  <div class="form-outline form-white mb-4">
                    <input type="text" name="txt_nome" id="typeEmailX" class="form-control form-control-lg" />
                    <label class="form-label" for="typeEmailX">Usuário</label>
                  </div>
                  <div class="form-outline form-white mb-4">
                    <input type="password" name="txt_senha" id="typePasswordX" class="form-control form-control-lg" />
                    <label class="form-label" for="typePasswordX">Senha</label>
                  </div>
                  <button class="btn btn-outline-light btn-lg px-5" type="submit">Entrar</button>
                  <br>
              </div>

              <?php

              if (!isset($_SESSION)) {
                session_start();
                if (isset($_SESSION['cod'])) {
                  header('Location:');
                }
              }

              if (isset($_POST['txt_nome']) || isset($_POST['txt_senha'])) // verifica se existe as variaveis email e senha
              {
                if (strlen($_POST['txt_nome']) == 0) // o "strlen" conta quantas letras existe na variavel então se for = a 0 nada foi escrito
                {
                  echo '<div class="alert alert-danger" role="alert">Preencha seu E-mail!</div>';
                } else if (strlen($_POST['txt_senha']) == 0) {
                  echo '<div class="alert alert-danger" role="alert">Preencha sua Senha!</div>';
                } else {
                  $nome = $conexao->real_escape_string($_POST['txt_nome']);//codigo para evitar invasão (pode ser retirado se quiser)
                  $senha = $conexao->real_escape_string($_POST['txt_senha']);

                  $nome = strtoupper($nome);
                  $senha = strtolower($senha);

                  $sql_code = "SELECT * FROM professor WHERE prof_nome = '$nome' AND prof_senha ='$senha'";
                  $sql_query = $conexao->query($sql_code) or die("falha na execução do codigo");

                  $quantidade = $sql_query->num_rows;

                  if ($quantidade == 1) {
                    $usuario = $sql_query->fetch_assoc();
                    if (!isset($_SESSION)) {
                      session_start();
                    } elseif (isset($_SESSION)) {
                      session_destroy();
                      session_start();
                    }
                    $_SESSION['cod'] = $usuario['prof_cod'];
                    $_SESSION['nome'] = $usuario['prof_nome'];
                    $_SESSION['cargo'] = $usuario['prof_cargo'];

                    header('Location: index.php');

                  }else {
                      echo '<div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Falha Ao Logar!</h4>
                            <p>E-mail ou senha incorretas tente novamente!</p></div>';

                    }
                  }

                }
              
              ?>


            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</body>
<!-- <p>Caso não lembre a senha ou não tem certeza <br> <a href="https://i.imgflip.com/737h8a.jpg" class="alert-link">Click aqui para Alterar !</a></p> -->

</html>