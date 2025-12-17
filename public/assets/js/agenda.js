// Heures possibles dans une journée
const hours = [
    "09:00", "10:00", "11:00",
    "14:00", "15:00", "16:00"
];

/**
 * Récupère depuis le backend les heures déjà réservées pour une date
 */
async function getUnavailableHours(date) {
    const response = await fetch(`/appointments/unavailable?date=${date}`);
    return await response.json(); // ex: ["11:00", "15:00"]
}

/**
 * Génère les boutons horaires dans la modal
 */
async function renderHours(container, date) {
    container.innerHTML = '';

    // On récupère les heures indisponibles depuis la DB
    const unavailableHours = await getUnavailableHours(date);

    hours.forEach(hour => {
        const btn = document.createElement("button");

        // Cas : heure déjà réservée
        if (unavailableHours.includes(hour)) {
            btn.className = "btn btn-outline-secondary disabled d-flex align-items-center gap-2";
            btn.innerHTML = `
                <i class="bi bi-lock-fill"></i>
                ${hour}
                <span class="text-muted">(Réservé)</span>
            `;
        }
        // Cas : heure disponible
        else {
            btn.className = "btn btn-outline-success d-flex align-items-center gap-2";
            btn.innerHTML = `
                <i class="bi bi-clock"></i>
                ${hour}
            `;

            btn.addEventListener("click", async (e) => {
                e.stopPropagation();

                const email = prompt("Votre email pour confirmer le RDV :");
                if (!email) return;

                await fetch('/appointments', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({ date, hour, email })
                });

                alert("RDV réservé ✔");

                // Recharge les créneaux après réservation
                renderHours(container, date);
            });
        }

        container.appendChild(btn);
    });
}

/**
 * Connecte les jours du calendrier à la modal
 */
function initAgendaDayClick() {
    document.querySelectorAll('.calendar-day').forEach(day => {
        day.addEventListener('click', () => {
            const date = day.dataset.date;
            const container = document.getElementById('hoursContainer');

            document.getElementById('selectedDate').textContent = date;

            renderHours(container, date);

            new bootstrap.Modal(
                document.getElementById('hoursModal')
            ).show();
        });
    });
}
