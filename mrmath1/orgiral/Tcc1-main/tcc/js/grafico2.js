const ctx2 = document.getElementById('doughnut');

new Chart(ctx2, {
  type: 'doughnut',
  data: {
    labels: ['Aulas Assistidas', 'Horas Assistidas', 'Atividades Realizadas', 'Acerto'],
    datasets: [{
      label: '# of Votes',
      data: [2, 2, 10, 16.75],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
