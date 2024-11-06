document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left:'',
      center: 'title',
    },
    locale: 'pt-br',
    navLinks: true,
    selectable: true,
    selectMirror: true,
    editable: true,
    dayMaxEvents: true,
    events: {
      url: 'listarEvento.php',
      method: 'GET',
      failure: function() {
          alert('Falha ao carregar eventos!');
      },
      eventDataTransform: function(eventData) {
          return {
              title: eventData.title,
              start: eventData.start,
              extendedProps: {
                  prof: eventData.prof,
                  lab: eventData.lab,
                  aula: eventData.aula
              }
          };
      }
},
  //? TA FUNCIONANDO MAS PRECISA PUXAR OS VALORES DO BANCO E ALINHAR ELE CERTINHO
  eventClick: function(info) {  

    const modalFirst = document.getElementById("modal-first");
  
  const event = info.event;
  const resultadoContent = `
    <p>Data: ${event.start}</p>
    <p>Professor: ${event.extendedProps.prof}</p>
    <p>Laboratório: ${event.extendedProps.lab}</p>
    <p>Aula: ${event.extendedProps.aula}ª Aula</p>
  `;
  document.getElementById("resultado").innerHTML = resultadoContent;

  
  modalFirst.classList.remove("hidden");
  modalFirst.classList.add("block");
  
  document.querySelector('[data-modal-hide="modal-first"]').addEventListener("click", function() {
    modalFirst.classList.remove("block");
    modalFirst.classList.add("hidden");
  });
  
  modalFirst.addEventListener("click", function(event) {
    if (event.target === modalFirst) {
      modalFirst.classList.remove("block");
      modalFirst.classList.add("hidden");
    }
  });
}

});

  calendar.render();
  var toolbarLeft = document.querySelector('.fc-toolbar .fc-toolbar-chunk:first-child');
  toolbarLeft.innerHTML = `
      <div class="inline-flex rounded-md shadow-sm float-right" role="group">
          <a href="diaV3.php" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white" selected>
              Dia
          </a>
          <a href="semanaV2.php" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
              Semana
          </a>
          <a href="calendario.php" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white" disabled>
              Mês
          </a>
      </div>
  `;
});