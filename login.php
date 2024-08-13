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

<section class="bg-gray-50 dark:bg-gray-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
          <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
          RLE    
      </a>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Entrar
              </h1>
              <form class="space-y-4 md:space-y-6" method="POST">
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usuário</label>
                      <input type="text" name="txt_nome" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Digite seu usuário" required="">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                      <input type="password" name="txt_senha" id="password" placeholder="Digite sua senha" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <button type="submit" class="flex w-full justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Entrar</button>

              </form>
          </div>
      </div>
  </div>
</section>
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


  <script src="../path/to/flowbite/dist/flowbite.min.js"></script>


<!-- <p>Caso não lembre a senha ou não tem certeza <br> <a href="https://i.imgflip.com/737h8a.jpg" class="alert-link">Click aqui para Alterar !</a></p> -->

</body>
</html>