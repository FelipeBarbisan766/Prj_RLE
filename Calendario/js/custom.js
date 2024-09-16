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

  const visualizarModal = document.getElementById("visualizarModal");
  
  const event = info.event;
  
  document.getElementById('modalTitle').innerText = event.title;
  const description = ` 
  <p>Data: ${event.start}</p>
  <p>Professor: ${event.extendedProps.prof}</p>
  <p>Laboratorio: ${event.extendedProps.lab}</p>
  <p>Aula: ${event.extendedProps.aula}ºAula</p>
  `;
  // ! EVITAR MEXER (CODIGO DO CAPETA!)
  document.getElementById('eventDetails').innerHTML = description;
  
  visualizarModal.classList.remove('hidden');
  visualizarModal.classList.add('block');
  
  document.querySelector('[data-modal-hide="visualizarModal"]').addEventListener('click', function() {
    visualizarModal.classList.remove('block');
    visualizarModal.classList.add('hidden');
  });
  
  visualizarModal.addEventListener('click', function(event) {
    if (event.target === visualizarModal) {
      visualizarModal.classList.remove('block');
      visualizarModal.classList.add('hidden');
    }
  });
}

});

  calendar.render();
});