// Génération du calendrier
let currentDate = new Date();

const monthNames = [
    "Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
    "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
];

function renderCalendar() {
    const grid = document.getElementById('calendarGrid');
    if (!grid) return;

    grid.innerHTML = '';
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    const currentMonthTitle = document.getElementById('currentMonth');

    if (currentMonthTitle) {
        currentMonthTitle.innerText = monthNames[month] + ' ' + year;
    }

    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    let startDay = firstDay.getDay() === 0 ? 6 : firstDay.getDay() - 1;

    for (let i = 0; i < startDay; i++) grid.innerHTML += `<div></div>`;

    for (let day = 1; day <= lastDay.getDate(); day++) {
        const today = new Date();
        const isToday =
            day === today.getDate() &&
            month === today.getMonth() &&
            year === today.getFullYear();

        grid.innerHTML += `
            <div class="calendar-day ${isToday ? 'today' : ''}"
                 data-date="${year}-${String(month + 1).padStart(2,'0')}-${String(day).padStart(2,'0')}">
                <div class="calendar-day-number">${day}</div>
                ${[5,12,18,25].includes(day)?'<div class="event-dot"></div>':''}
            </div>
        `;
    }

    // 🔹 Réattache les événements aux jours
    if (typeof initAgendaDayClick === 'function') {
        initAgendaDayClick();
    }
}


// Navigation mois
function initCalendarNavigation() {
    const prev = document.getElementById('prevMonth');
    const next = document.getElementById('nextMonth');

    if (prev) prev.onclick = () => { currentDate.setMonth(currentDate.getMonth() - 1); renderCalendar(); };
    if (next) next.onclick = () => { currentDate.setMonth(currentDate.getMonth() + 1); renderCalendar(); };
}

// Initialisation
document.addEventListener('DOMContentLoaded', () => {
    renderCalendar();
    initCalendarNavigation();
});
