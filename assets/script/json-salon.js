
let id_chaine = document.querySelector('.button-new-chaines');

document.querySelector('.nav-salon').addEventListener("click", function(e){
    mesSalons.innerHTML = ""
    fetch('../parametre-salons/affichage-salon.php?id_chaine=' +id_chaine).then(function (response) {
        return response.json();})
        .then(function (monjson)
        {
        console.log(monjson);
        let lesSalons = document.querySelector("#nav-salon")
        var button = document.createElement('button');
        for (i = 0 ; i < monjson.length ; i++) {
            // remplir le corps de mon tableau
            lesSalons.innerHTML += "<tr>" + "<td>" + monjson[i].film_titre + "</td>" + "<td>" + monjson[i].film_datesortie + "</td>" + "<td>" + monjson[i].film_duree + "</td>" + "<td>" + monjson[i].film_etoilespresse + "</td>" + "<td>" + monjson[i].film_etoilesspectateurs + "</td>" + "</tr>"
        }
    })
})


