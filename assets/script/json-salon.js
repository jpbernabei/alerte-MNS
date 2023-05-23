// Pour les chaines 
let ChainesNav = document.querySelectorAll('.button-new-chaines');
// Pour les salons 
let salonNav = document.getElementById('mesSalons');

// Boucle pour les boutons afin d'avancer chaque ID lors de la click 
ChainesNav.forEach(function(chaine) {
    chaine.addEventListener("click", function(){
        salonNav.innerHTML=""
        // Récuperer l'ID des chaines
        let ChaineID = chaine.id;
        // Requete Fetch
        fetch('http://alerte-mns.local/admin/parametre-salons/affichage-salon.php?id_chaine=' + ChaineID)
        .then(function(response)
        {
            return response.json();
        })
        .then(function(affichage)
        {
            for(i=0; i < affichage.length; i++)
            {
                salonNav.innerHTML += '<button class="button-new-chaines">'+affichage[i].nom_salon+'</button>'
            }
        })
    })
});

//------------------------------------------------Titre des chaines------------------------------------------------------------


// Pour les salons 
let titreChaineNav = document.getElementById('titre');

// Boucle pour les boutons afin d'avancer chaque ID lors de la click 
ChainesNav.forEach(function(chaine) {
    chaine.addEventListener("click", function(){
        titreChaineNav.innerHTML=""
        // Récuperer l'ID des chaines
        let ChaineID = chaine.id;
        // Requete Fetch
        fetch('http://alerte-mns.local/admin/parametre-salons/affichage-salon.php?id_chaine=' + ChaineID)
        .then(function(response)
        {
            return response.json();
        })
        // .then(affichage => console.log(affichage))
        .then(function(affichage)
        
        {
            for(i=0; i < affichage.length; i++)
            {
                titreChaineNav.innerHTML += '<button class="bouton-new-chaines">'+affichage[i].nom_chaine+'</button>'
            }
        })
    })
});


//------------------------------------------------Message en fonction des salons------------------------------------------------------------

