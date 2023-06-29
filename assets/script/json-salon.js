// Pour les chaines 
let ChainesNav = document.querySelectorAll('.button-new-chaines');
// Pour les salons 
let salonNav = document.getElementById('mesSalons');

// Boucle pour les boutons afin d'avancer chaque ID lors de la click 
// ChainesNav.forEach(function(chaine) {
//     chaine.addEventListener("click", function(){
//         salonNav.innerHTML=""
//         // Récuperer l'ID des chaines
//         let ChaineID = chaine.id;
//         // Requete Fetch
//         fetch('http://alerte-mns.local/admin/parametre-salons/affichage-salon.php?id_chaine=' + ChaineID)
//         .then(function(response)
//         {
//             return response.json();
//         })
//         .then(function(affichage)
//         {
//             for(i=0; i < affichage.length; i++)
//             {
//                 salonNav.innerHTML += '<button class="button-new-chaines">'+affichage[i].nom_salon+'</button>'
//             }
//         })
//     })
// });

//------------------------------------------------Titre des chaines------------------------------------------------------------


// Pour les salons 
let titreChaineNav = document.getElementById('titre');
let sideUser = document.getElementById('side');
// Pour les messages
let messageSalon = document.getElementById('messageSalon');

// Boucle pour les boutons afin d'avancer chaque ID lors de la click 
ChainesNav.forEach(function (chaine) {
    chaine.addEventListener("click", function () {
        titreChaineNav.innerHTML = ""
        messageSalon.innerHTML='';
        // Récuperer l'ID des chaines
        let ChaineID = chaine.id;
        // Requete Fetch
        fetch('http://alerte-mns.local/admin/parametre-salons/affichage-salon.php?id_chaine=' + ChaineID)
            .then(function (response) {
                return response.json();
            })
            // .then(affichage => console.log(affichage))
            .then(function (affichage) {
                salonNav.innerHTML = '';
                if (affichage['nom_chaine'] != "") {
                    titreChaineNav.innerHTML += '<div class="titre">' + affichage['nom_chaine'] + '</div>'
                }


                for (let salon of affichage['salons']) {
                    const buttonSalon = document.createElement('button');
                    buttonSalon.innerHTML = salon.nom_salon;
                    buttonSalon.classList.add('button-new-chaines');
                    buttonSalon.addEventListener('click', e => {

                        fetch('http://alerte-mns.local/admin/parametre-salons/affichageMessage.php?id_salon=' + salon.id_salon)
                            .then(function (response) {
                                return response.json();
                            })

                            .then(messages => {
                                messageSalon.innerHTML='';
                                // Le message reste meme lors d'un changement d'une chaine ????? 
                                for (i = 0; i < messages.length; i++) {
                                    messageSalon.innerHTML += '<p class="message">' + messages[0]['texte_message'] + '</p>'
                                }
                            }) // Faire une boucle for pour créer autant d'elements que nous voulons

                    })
                    salonNav.appendChild(buttonSalon)

                }


                sideUser.innerHTML = '';
                for (let utilisateur of affichage['utilisateurs']) {
                    sideUser.innerHTML += utilisateur['nom_utilisateur'] + '</br>';
                }


            })
    })
});


//----------------------------------------------------Message en fonction des salons---------------------------------------------------------------

