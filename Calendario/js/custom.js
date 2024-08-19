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
      dayMaxEvents: true, // allow "more" link when too many events
      events: {
        url: 'listarEvento.php', // Caminho para o seu script PHP
        method: 'GET',
        failure: function() {
            alert('Falha ao carregar eventos!');
        }
    },
    });

    calendar.render();
  });