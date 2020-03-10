window.addEventListener("DOMContentLoaded", (event) => {

    var butins = document.getElementById('but_ins');
    if (butins !== null || true) {

        butins.addEventListener('click', function showInscription() {
                var formConnexion = document.getElementById('connexion');
                if (formConnexion) {
                    formConnexion.style.display = "none";
                    var formInscription = document.getElementById('inscription');
                    formInscription.style.display = "block";
                }
            }
        );
    }

    function showConnexion() {
        var formInscription = document.getElementById('inscription');
        if (formInscription) {
            formInscription.style.display = "none";
            var formConnexion = document.getElementById('connexion');
            formConnexion.style.display = "block"
        }
    }
});