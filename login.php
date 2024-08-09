<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <?php
  include_once ("conexao.php");
  ?>

<section>

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Entre em sua conta</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="#" method="POST">
      <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Usuário</label>
        <div class="mt-2">
          <input id="email" name="txt_nome" type="text" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Senha</label>
          <div class="text-sm">
            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Esqueceu a senha??</a>
          </div>
        </div>
        <div class="mt-2">
          <input id="password" name="txt_senha" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
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
                      echo '<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 " role="alert">
                            <span class="font-medium">Danger alert!</span> Senha ou usuário incorretos! Tente novamente.
                            </div>';

                    }
                  }

                }
                ?>
                    </form>
                    </div>
                </div>

  <script src="../path/to/flowbite/dist/flowbite.min.js"></script>

</body>
<!-- <p>Caso não lembre a senha ou não tem certeza <br> <a href="https://i.imgflip.com/737h8a.jpg" class="alert-link">Click aqui para Alterar !</a></p> -->

</html>