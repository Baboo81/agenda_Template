const hours = [
    "09:00", "10:00", "11:00",
    "14:00", "15:00", "16:00"
];

// Simulation des heures indisponibles (plus tard → backend)
const unavailableHours = ["11:00", "15:00"];

// Fonction pour générer les boutons des créneaux d'une date donnée
function renderHours(container, date) {
    hours.forEach(hour => {
        const btn = document.createElement("button");

        if (unavailableHours.includes(hour)) {
            btn.className = "btn btn-outline-secondary disabled d-flex align-items-center gap-2";
            btn.innerHTML = `
                <i class="bi bi-lock-fill"></i>
                ${hour}
                <span class="text-muted">(Réservé)</span>
            `;
        } else {
            btn.className = "btn btn-outline-success d-flex align-items-center gap-2";
            btn.innerHTML = `
                <i class="bi bi-clock"></i>
                ${hour}
            `;

            btn.addEventListener("click", (e) => {
                e.stopPropagation(); // empêche le clic sur le jour
                console.log("RDV choisi :", date, hour);
            });
        }

        container.appendChild(btn);
    });
}

// Fonction pour connecter les jours du calendrier à la modal
function initAgendaDayClick() {
    document.querySelectorAll('.calendar-day').forEach(day => {
        day.addEventListener('click', () => {

            const date = day.dataset.date;
            const container = document.getElementById('hoursContainer');
            container.innerHTML = '';

            document.getElementById('selectedDate').textContent = date;

            renderHours(container, date);

            new bootstrap.Modal(document.getElementById('hoursModal')).show();
        });
    });
}

// Exécution au chargement du DOM
document.addEventListener('DOMContentLoaded', () => {
    initAgendaDayClick();
});
