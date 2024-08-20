<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RLE</title>
        <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<!-- PAGINA INICIAL TODO MUNDO VAI VER -->
    <?php include_once('navbar2.php'); ?>
       <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white"> <?php if(isset($_SESSION['nome'])){echo 'Olá,'.$_SESSION['nome'];}else{echo 'Bem Vindo';}?></h1>
        <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">O quê deseja fazer?</p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <a href="./Cronograma/cronograma2.php" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Ver Cronograma
                </a> 
                <a href="./Calendario/diaV3.php" class="py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Ver Calendário
                </a> 
                <?php
                if(isset($_SESSION['nome'])){
                ?>
                <a href="./Reserva/formReserva.php" class="py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900" >
                    Reservar Laboratório
                </a>
                <?php if($_SESSION['cargo']=='adm'){?>
                    <a href="./ADM/pageControl.php" class="py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Controle
                    </a>
                <?php }}?>
            </div>
        </div>
     </div>

                
    

<script src="../path/to/flowbite/dist/flowbite.min.js"></script>

</body>
</html>