<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-neutral-100 dark:bg-neutral-900 flex flex-col min-h-screen">
  <?php
  include_once ("conexao.php");  
  ?>
  


<section class="">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
 
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-gray-900 dark:text-white">
    <path fill-rule="evenodd" d="M1.5 6.375c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v3.026a.75.75 0 0 1-.375.65 2.249 2.249 0 0 0 0 3.898.75.75 0 0 1 .375.65v3.026c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 17.625v-3.026a.75.75 0 0 1 .374-.65 2.249 2.249 0 0 0 0-3.898.75.75 0 0 1-.374-.65V6.375Zm15-1.125a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-1.5 0V6a.75.75 0 0 1 .75-.75Zm.75 4.5a.75.75 0 0 0-1.5 0v.75a.75.75 0 0 0 1.5 0v-.75Zm-.75 3a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-1.5 0v-.75a.75.75 0 0 1 .75-.75Zm.75 4.5a.75.75 0 0 0-1.5 0V18a.75.75 0 0 0 1.5 0v-.75ZM6 12a.75.75 0 0 1 .75-.75H12a.75.75 0 0 1 0 1.5H6.75A.75.75 0 0 1 6 12Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" clip-rule="evenodd" />
  </svg>
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
                      <input type="text" name="txt_user" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Digite seu Usuário ou Email" required>
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                      <input type="password" name="txt_senha" id="password" placeholder="Digite sua senha" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                  </div>
                  <button type="submit" class="flex w-full justify-center dark:text-gray-900 dark:bg-white dark:border dark:border-gray-300 dark:focus:outline-none dark:hover:bg-gray-100 dark:focus:ring-4 dark:focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-gray-800 text-white border-gray-600 hover:bg-gray-700 hover:border-gray-600 focus:ring-gray-700">Entrar</button>


              <?php

              if (!isset($_SESSION)) {
                session_start();
                if (isset($_SESSION['cod'])) {
                  echo '<script>alert("Você já está logado!"); window.location.href = "index.php";</script>';
                  
                  exit;
                }
              }

              if (isset($_POST['txt_user']) || isset($_POST['txt_senha'])) // verifica se existe as variaveis email e senha
              {
                if (strlen($_POST['txt_user']) == 0) // o "strlen" conta quantas letras existe na variavel então se for = a 0 nada foi escrito
                {
                  echo '<div class="alert alert-danger" role="alert">Preencha seu E-mail!</div>';
                } else if (strlen($_POST['txt_senha']) == 0) {
                  echo '<div class="alert alert-danger" role="alert">Preencha sua Senha!</div>';
                } else {
                  $user = $conexao->real_escape_string($_POST['txt_user']);//codigo para evitar invasão (pode ser retirado se quiser)
                  $senha = $conexao->real_escape_string($_POST['txt_senha']);

                  $user = strtolower($user);

                  $sql_user = mysqli_query($conexao,"SELECT * FROM professor WHERE prof_user = '$user' AND prof_senha ='$senha'"); //select do usuario e senha
                  $quantUser = $sql_user->num_rows;
                  $sql_email = mysqli_query($conexao,"SELECT * FROM professor WHERE prof_email = '$user' AND prof_senha ='$senha'"); //select do email e da senha
                  $quantEmail = $sql_email->num_rows;

                  if ($quantUser == 1 || $quantEmail == 1) {
                    if($quantUser == 1){
                      $usuario = $sql_user->fetch_assoc();
                    }
                    if($quantEmail == 1){
                      $usuario = $sql_email->fetch_assoc();
                    }
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
                      echo '<div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                            <span class="font-medium">Erro!  Usuário ou senha incorretos. </span>
                            </div>';  

                    }
                  }

                }
                ?>
                <p><a href="./Esqueci-Senha/forgot-password.php" class="alert-link font-medium text-red-600 underline dark:text-red-500 hover:no-underline">Esqueceu sua senha?</a></p>
            </form>
          </div>
        </div>
      </div>  
    </section>
  </body>
  </html>
  