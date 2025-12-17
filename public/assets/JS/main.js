'use strict';

// On parcourt toutes les heures disponibles de la journée :
hours.forEach(hour => {

    // Création dynamique d'un btn pour chaque créneau horaire :
    const btn = document.createElement("button");

    // Si l'heure fait partie des créneaux non dispo :
    if (unavailableHours.include(hour)) {

        // On applique des classes Bootstrap :
        // - style secondaire (gris)
        // - heure affichée
        // - mention "Réservé" en txt atténué
        btn.className = "btn btn-outline-secondary disable d-flex align-items-center gap-2";

        // Contenu btn :
        // - icône cadenas (créneaux verrouillé)
        // - heure affichée
        // - mention "Réservé" en txt atténué
        btn.innerHTML = `
            <i class="bi bi-lock-fill"></i>
            ${hour}
            <span class="text-muted">Réservé</span>
        `;

        } else {

            // Cas où le créneau est disponible 
            // - style vert (dispo)
            // - bouton cliquable
            btn.className = "btn btn-outline-success d-flex align-items-center gap-2";

            // Contenu btn
            // - icône horloge
            // - heure affichée
            btn.innerHTML = `
                <i class="bi bi-clock"></i>
                ${hour}
            `;

            // Evènement déclenché lorsque l'utilisateur clique sur une heure dispo
            btn.addEventListener("click", () => {
                // Pour l'instant : simple log
                // Plus tard : evoi vers le backend pour résèrver le créneau
                console.log("Créneau choisi :", hour);
            });
        }

        // On ajoute le btn (dispo ou résèrvé) dans le conteneur de la modal
        container.appendChild(btn);
});
