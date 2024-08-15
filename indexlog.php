
<!-- PAGINA SO OS LOGADO VAI VER -->
    <?php 
    include_once('navbar2.php');
    ?>
    
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
        
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Olá, <?php echo $_SESSION['nome'];?></h1>
        <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">O quê deseja fazer?</p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <a href="./Cronograma/cronograma.php" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Reservar Laboratório
                </a>
                <a href="./Cronograma/cronogramalog.php" class="py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Cronograma
                </a> 
                <a href="./Calendario/calendario.php" class="py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Calendário
                </a>  
            </div>
        </div>
    </div>


<script src="../path/to/flowbite/dist/flowbite.min.js"></script>

</body>
</html>