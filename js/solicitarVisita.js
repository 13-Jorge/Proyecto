import flatpickr from "flatpickr"

document.addEventListener("DOMContentLoaded", () => {
  // Inicializar el selector de días
  flatpickr("#dias_preferencia", {
    mode: "multiple",
    dateFormat: "Y-m-d",
    minDate: "today",
    maxDate: new Date().fp_incr(30), // Permite seleccionar hasta 30 días en el futuro
    locale: {
      firstDayOfWeek: 1, // Semana comienza en lunes
    },
  })

  // Inicializar los selectores de hora
  flatpickr("#hora_inicio", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
    minTime: "09:00",
    maxTime: "20:00",
  })

  flatpickr("#hora_fin", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
    minTime: "09:00",
    maxTime: "20:00",
  })

  // Validar que la hora de fin sea posterior a la hora de inicio
  document.getElementById("solicitarVisitaForm").addEventListener("submit", (e) => {
    var horaInicio = document.getElementById("hora_inicio").value
    var horaFin = document.getElementById("hora_fin").value

    if (horaInicio >= horaFin) {
      e.preventDefault()
      alert("La hora de fin debe ser posterior a la hora de inicio.")
    }
  })
})

