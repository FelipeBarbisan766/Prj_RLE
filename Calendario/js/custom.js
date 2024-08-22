document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
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
      }
    },

    // TA FUNCIONANDO MAS PRECISA PUXAR OS VALORES DO BANCO E ALINHAR ELE CERTINHO
eventClick: function(info) {
  const visualizarModal = document.getElementById("visualizarModal");
  
  document.getElementById('modalTitle').innerText = info.event.title;
  
  const event = info.event;
  const description = `
    <p>Início: ${info.event.start}</p>
    <p>Fim: ${info.event.end}</p>
  `;
  
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