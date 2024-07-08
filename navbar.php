<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</head>
<body>
  
<?php 
  include_once("protect.php");
  include_once ("conexao.php");
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="\Prj_RLE/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="\Prj_RLE/Reserva/formReserva.php">Reserva</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Calendario
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/Prj_RLE/Calendario/dia.php">Dia</a></li>
            <li><a class="dropdown-item" href="/Prj_RLE/Calendario/semana.php">Semana</a></li>
            <li><a class="dropdown-item" href="#">Mês</a></li>
          </ul>
        </li>
        <?php if(isset($_SESSION['admCod'])){?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Cronograma <!-- não achei um nome melhor (depois trocar pfv) -->
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/Prj_RLE/Cronograma/cronograma.php">Semana</a></li>
            <li><a class="dropdown-item" href="/Prj_RLE/Cronograma/form.php">Registrar</a></li>
          </ul>
        </li>
        <?php }; ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo $_SESSION['nome'] ?>
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="">Configs</a></li>
          <li><hr class="dropdown-divider"></li>
            <?php if(isset($_SESSION['admCod'])){?>
              <li><a class="dropdown-item" href="\Prj_RLE/ADM/pageControl.php">Controle Adm</a></li>
              <li><hr class="dropdown-divider"></li>
              <?php }; ?>
            <li><a class="dropdown-item" href="\Prj_RLE/logoff.php">Sair</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

</body>