import flatpickr from "flatpickr"
import "flatpickr/dist/flatpickr.min.css"

document.addEventListener("DOMContentLoaded", () => {
  flatpickr.localize(flatpickr.l10ns.es)

  const calendarioDias = flatpickr("#dias_preferencia", {
    mode: "multiple",
    dateFormat: "d/m/Y",
    minDate: "today",
    maxDate: new Date().fp_incr(30),
    disable: [(date) => date.getDay() === 0],
    locale: {
      firstDayOfWeek: 1,
    },
    onChange: (selectedDates, dateStr) => {
      selectedDates.sort((a, b) => a - b)
    },
  })

  const horaInicio = flatpickr("#hora_inicio", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
    minTime: "09:00",
    maxTime: "19:30",
    defaultHour: 9,
    defaultMinute: 0,
    minuteIncrement: 30,
    onChange: (selectedDates, dateStr) => {
      if (selectedDates.length > 0) {
        const minEndTime = new Date(selectedDates[0])
        minEndTime.setMinutes(minEndTime.getMinutes() + 30)
        horaFin.set("minTime", minEndTime.getHours() + ":" + minEndTime.getMinutes())
      }
    },
  })

  const horaFin = flatpickr("#hora_fin", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
    minTime: "09:30",
    maxTime: "20:00",
    defaultHour: 9,
    defaultMinute: 30,
    minuteIncrement: 30,
  })

  document.getElementById("solicitarVisitaForm").addEventListener("submit", (e) => {
    const horaInicioVal = document.getElementById("hora_inicio").value
    const horaFinVal = document.getElementById("hora_fin").value
    const diasSeleccionados = document.getElementById("dias_preferencia").value

    if (!diasSeleccionados) {
      e.preventDefault()
      alert("Por favor, seleccione al menos un día para la visita.")
      return
    }

    if (!horaInicioVal || !horaFinVal) {
      e.preventDefault()
      alert("Por favor, seleccione el rango horario completo.")
      return
    }

    const [horaI, minI] = horaInicioVal.split(":")
    const [horaF, minF] = horaFinVal.split(":")
    const inicio = new Date(2000, 0, 1, horaI, minI)
    const fin = new Date(2000, 0, 1, horaF, minF)

    if (fin <= inicio) {
      e.preventDefault()
      alert("La hora de fin debe ser posterior a la hora de inicio.")
      return
    }
  })
})

