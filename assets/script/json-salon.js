
document.querySelector('.nav-salon').addEventListener("click", function(e){
    mesSalons.innerHTML = ""
    fetch('  ../parametre-salons/affichage-salon.php?liste=film').then(function (response) {
        return response.json();
    }).then(function (monjson) {
        let corpsDuTableau = document.querySelector("#corpsdutableau")
        var tr = document.createElement('tr');
        for (i = 0 ; i < monjson.length ; i++) {
            // remplir le corps de mon tableau
    
            corpsDuTableau.innerHTML += "<tr>" + "<td>" + monjson[i].film_titre + "</td>" + "<td>" + monjson[i].film_datesortie + "</td>" + "<td>" + monjson[i].film_duree + "</td>" + "<td>" + monjson[i].film_etoilespresse + "</td>" + "<td>" + monjson[i].film_etoilesspectateurs + "</td>" + "</tr>"
        }
    })
})


