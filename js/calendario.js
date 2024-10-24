// variaveis globais

let nav = 0;
let clicked = null;

// variavel do modal:
const newEvent = document.getElementById('newEventModal');
const deleteEventModal = document.getElementById('deleteEventModal');
const backDrop = document.getElementById('modalBackDrop');
const eventTitleInput = document.getElementById('eventTitleInput');

// div calendar:
const calendar = document.getElementById('calendar');
const weekdays = ['domingo', 'segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira', 'sábado'];

let monthDate = '';

//funções

function openModal(date) {
  clicked = date;
  const eventDay = events.find((event) => event.date === clicked);

  monthDate = new Date(monthDate);
  monthDate = monthDate.toISOString().split('T')[0];

  if (eventDay) {
    document.getElementById('eventText').innerText = eventDay.title;
    deleteEventModal.style.display = 'block';
  } else {
    newEvent.style.display = 'block';
  }

  backDrop.style.display = 'block';
}

// função load() será chamada quando a pagina carregar:

function load() {
  const date = new Date();

  // mudar titulo do mês:
  if (nav !== 0) {
    date.setMonth(new Date().getMonth() + nav);
  }

  const day = date.getDate();
  const month = date.getMonth();
  const year = date.getFullYear();

  const daysMonth = new Date(year, month + 1, 0).getDate();
  const firstDayMonth = new Date(year, month, 1);

  const dateString = firstDayMonth.toLocaleDateString('pt-br', {
    weekday: 'long',
    year: 'numeric',
    month: 'numeric',
    day: 'numeric',
  });

  const paddinDays = weekdays.indexOf(dateString.split(', ')[0]);

  // mostrar mês e ano:
  document.getElementById('monthDisplay').innerText = `${date.toLocaleDateString('pt-br', { month: 'long' })}, ${year}`;

  calendar.innerHTML = '';

  // criando uma div com os dias:

  for (let i = 1; i <= paddinDays + daysMonth; i++) {
    const dayS = document.createElement('div');
    dayS.classList.add('day');

    // Adicionando zeros à esquerda para mês e dia
    const day = i - paddinDays;
    const dayString = `${String(month + 1).padStart(2, '0')}/${String(day).padStart(2, '0')}/${year}`;

    dayS.id = dayString;

    // condicional para criar os dias de um mês:
    if (i > paddinDays) {
      dayS.innerText = day;

      const eventDay = events.find(event => event.date === dayString);

      if (day === date.getDate() && nav === 0) {
        dayS.id = 'currentDay';
      }

      if (eventDay) {
        const eventDiv = document.createElement('div');
        eventDiv.classList.add('event');
        eventDiv.innerText = eventDay.title;
        dayS.appendChild(eventDiv);
      }

      dayS.addEventListener('click', () => {
        monthDate = dayS.id;
        openModal(dayString);
      });
    } else {
      dayS.classList.add('padding');
    }

    calendar.appendChild(dayS);
  }
}

function closeModal() {
  eventTitleInput.classList.remove('error');
  newEvent.style.display = 'none';
  backDrop.style.display = 'none';
  deleteEventModal.style.display = 'none';

  eventTitleInput.value = '';
  clicked = null;
  load();
}

function saveEvent() {
  if (eventTitleInput.value) {
    eventTitleInput.classList.remove('error');

    events.push({
      date: clicked,
      title: eventTitleInput.value
    });

    const data = events.clicked;
    const titulo = eventTitleInput.value;

    $.post('process_calendario.php?data=' + monthDate + '&titulo=' + titulo, function (include_process_calendario) {
      $("#div_process_calendario").html(include_process_calendario);
    });

    closeModal();
  } else {
    eventTitleInput.classList.add('error');
  }
}

function deleteEvent() {
  events = events.filter(event => event.date !== clicked);
  closeModal();
}

// botões 

function buttons() {
  document.getElementById('backButton').addEventListener('click', () => {
    nav--;
    load();
  });

  document.getElementById('nextButton').addEventListener('click', () => {
    nav++;
    load();
  });

  document.getElementById('saveButton').addEventListener('click', () => saveEvent());

  document.getElementById('cancelButton').addEventListener('click', () => closeModal());

  document.getElementById('deleteButton').addEventListener('click', () => deleteEvent());

  document.getElementById('closeButton').addEventListener('click', () => closeModal());
}

buttons();
load();
