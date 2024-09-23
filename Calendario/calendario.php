
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/custom.css">



</head>
<body>
  <?php 
  include_once('../navbar2.php');
  include_once('../button_back.php');
  ?>
<div class="container mx-auto px-3">
  <div id="calendar"></div>
  <script src='js/index.global.min.js'></script>
  <script src='js/core/locales-all.global.min.js'></script>
  <script src='js/custom.js'></script>


  <div id="visualizarModal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 id="modalTitle" class="text-xl font-medium text-gray-900 dark:text-white">
                    Título do Evento
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="visualizarModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div id="modalBody" class="p-4 md:p-5 space-y-4">
                <p id="eventDetails" class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    Descrição do evento aparecerá aqui.
                </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>