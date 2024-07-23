fntGraficaP = () => {
  $.post(base_url + 'Grafica/getDataP',
  function (data) {
    let content = JSON.parse(data)
    let total = parseInt(content[0]['total'])
    let votosi = parseInt(content[0]['si']) / total * 100
    let votono = parseInt(content[0]['no']) / total * 100
    const ctx = document.getElementById('chartPersonal')
    new Chart(ctx, {
      type: 'bar',
      backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
      data: {
        labels: ['Personal que si voto '+ votosi.toFixed(2) + '%', 'Personal que no voto '+ votono.toFixed(2) + '%'],
        datasets: [{
          label: total + ' Votantes 2024 Personal Busyaracuy',
          data: [votosi.toFixed(2), votono.toFixed(2)],
          backgroundColor: [
            'rgba(5, 189, 69 , 0.9)',
            'rgba(236, 2, 2, 0.9)'
          ],
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
    })
    })
}


fntGraficaM = () => {
  $.post(base_url + 'Grafica/getData',
  function (data) {
    let content = JSON.parse(data)
    let total = parseInt(content[0]['total'])
    let votosi = parseInt(content[0]['si']) / total * 100
    let votono = parseInt(content[0]['no']) / total * 100
    const ctx2 = document.getElementById('chart1x10')
    new Chart(ctx2, {
      type: 'bar',
      backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
      data: {
        labels: ['Personal que si voto '+ votosi.toFixed(2) + '%', 'Personal que no voto '+ votono.toFixed(2) + '%'],
        datasets: [{
          label: total + ' Votantes 2024 Militantes del personal',
          data: [votosi.toFixed(2), votono.toFixed(2)],
          backgroundColor: [
            'rgba(5, 189, 69 , 0.9)',
            'rgba(236, 2, 2, 0.9)'
          ],
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
    })
    })
}




document.addEventListener('DOMContentLoaded', function () {
fntGraficaP()
fntGraficaM()
},false)