
// Pour les chaines 
let ChainesNav = document.querySelectorAll('.lesUtilisateursInChaine');
// Pour les salons 
let UserChaine = document.getElementById('side');

// Boucle pour les boutons afin d'avancer chaque ID lors de la click 
ChainesNav.forEach(function(chaine) {
    chaine.addEventListener("click", function(){
        UserChaine.innerHTML=""
        // Récuperer l'ID des chaines
        let ChaineID = chaine.id;
        // Requete Fetch
        fetch('http://alerte-mns.local/admin/parametre-chaines/affichageUserInChaine.php?id_chaine=' + ChaineID)
        .then(function(response)
        {
            return response.json();
        })
        .then(function(affichage)
        {
            for(i=0; i < affichage.length; i++)
            {
                UserChaine.innerHTML += '<div class="lesUtilisateursInChaine">'+affichage[i].nom_utilisateur+' '+affichage[i].prenom_utilisateur+'</div>'
            }
        })
    })
});