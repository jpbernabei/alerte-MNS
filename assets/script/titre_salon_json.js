// Pour les chaines 
let ChainesNav = document.querySelectorAll('.Salon');

// Pour les salons 
let salonNav = document.getElementById('titreSalons');

// Boucle pour les boutons afin d'avancer chaque ID lors de la click 
ChainesNav.forEach(function(chaine) {
    chaine.addEventListener("click", function(){
        salonNav.innerHTML=""
        // Récuperer l'ID des chaines
        let ChaineID = chaine.id;
        // Requete Fetch
        fetch('http://alerte-mns.local/admin/parametre-salons/affichage-salon.php?id_chaine=' +ChaineID)
        .then(function(response){
            return response.json();
        })
        .then(function(affichage){
            // boucle foreach

            for(i=0; i < affichage.length; i++)
            {
                salonNav.innerHTML += '<p class="titre_salon">'+affichage[i].nom_salon+'</p>'
            }
        })
    })
});