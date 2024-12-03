document.addEventListener("DOMContentLoaded", function () {
    const timeoutBtns = document.querySelectorAll(".timeoutBtn"); // Sélectionner tous les boutons avec la classe "timeoutBtn"

    timeoutBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
            // Désactiver le bouton cliqué
            btn.disabled = true;

            // Trouver ou créer un conteneur de timer pour ce bouton
            let timerDisplay = btn.nextElementSibling;
            if (!timerDisplay || !timerDisplay.classList.contains("timerDisplay")) {
                timerDisplay = document.createElement("div");
                timerDisplay.classList.add("timerDisplay");
                timerDisplay.style.fontSize = "1.5rem";
                timerDisplay.style.marginTop = "10px";
                btn.parentNode.appendChild(timerDisplay);
            }
            timerDisplay.style.display = "block";

            // Démarrer le compte à rebours
            let timeLeft = 30;
            timerDisplay.textContent = `Temps restant : ${timeLeft} secondes`;

            const interval = setInterval(() => {
                timeLeft--;
                timerDisplay.textContent = `Temps restant : ${timeLeft} secondes`;

                if (timeLeft <= 0) {
                    clearInterval(interval);
                    timerDisplay.textContent = "Temps écoulé !";
                    btn.disabled = false; // Réactiver le bouton
                }
            }, 1000);
        });
    });
});
