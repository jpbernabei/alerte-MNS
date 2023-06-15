// function verificationActifReunion(){
//     let isChecked = document.getElementById("actifReunion").checked;
//     let isNotChecked = document.getElementById("noActifReunion");
//     if (!isChecked){
//         isNotChecked.value = 0;
//     } else {
//         isNotChecked.value = 1;
//     }
// }
// let reunionActive = document.getElementById("actifReunion").value;
// let reunionToggle = document.getElementById("actifReunion");

// if(reunionActive == 1)
// {
//     reunionToggle.checked = true;
// }else{
//     reunionToggle.checked = false;
// }


function validateFormReunion(event) {
     
    // Récupére les valeurs des champs
    let nomReunion = document.querySelector("#nomReunion");
    let sujetReunion = document.querySelector("#sujetReunion");
    let dateReunion = document.querySelector('#dateReunion');
    let heureReunion = document.querySelector('#heureReunion');

          // Réinitialise les styles et les messages d'erreur
          nomReunion.style.backgroundColor = "none";
          document.querySelector("#nomReunionError").innerHTML = "";
      
          sujetReunion.style.backgroundColor = "none";
          document.querySelector("#sujetReunionError").innerHTML = "";
      
          dateReunion.style.backgroundColor = "none";
          document.querySelector("#dateReunionError").innerHTML = "";
      
          heureReunion.style.backgroundColor = "none";
          document.querySelector("#heureReunionError").innerHTML = "";

    // Vérifie les conditions pour valider le formulaire
      if (nomReunion.value == '' ) {
        event.preventDefault()// Empêche la soumission du formulaire par défaut
        nomReunion.style.backgroundColor = "LightPink";
        document.querySelector("#nomReunionError").innerHTML= "La réunion doit avoir un nom";
        document.querySelector("#nomReunionError").style.color = "orange"
      }
      if (sujetReunion.value == '') {
        event.preventDefault()// Empêche la soumission du formulaire par défaut
        sujetReunion.style.backgroundColor = "LightPink";
        document.querySelector("#sujetReunionError").innerHTML = "La réunion doit avoir un sujet";
        document.querySelector("#sujetReunionError").style.color = "orange"
      }
      if (dateReunion.value == '') {
        event.preventDefault()
        dateReunion.style.backgroundColor = "LightPink";
        document.querySelector("#dateReunionError").innerHTML = "La réunion doit avoir une date";
        document.querySelector("#dateReunionError").style.color = "orange"
      }
      if (heureReunion.value == '') {
        event.preventDefault()
        heureReunion.style.backgroundColor = "LightPink";
        document.querySelector("#heureReunionError").innerHTML = "La réunion doit avoir une heure";
        document.querySelector("#heureReunionError").style.color = "orange"
      }
  }
  
  // Ajoute un gestionnaire d'événement pour le formulaire 
  document.querySelector("#form").addEventListener("submit", (e)=>validateFormReunion(e));

  
  document.querySelector("#nomReunion").addEventListener("keyup", validateNom);
  function validateNom() {
      let nomReunion = document.querySelector("#nomReunion");
      
      if(nomReunion.value === "")
      nomReunion.style.backgroundColor = "LightPink";
  else {
    nomReunion.style.backgroundColor = "#bef7e3";
        document.querySelector("#nomReunionError").innerHTML = "";
      }
    }

    document.querySelector("#sujetReunion").addEventListener("keyup", validateSujet);
    function validateSujet() {
        let sujetReunion = document.querySelector("#sujetReunion");
        
        if(sujetReunion.value === "")
        sujetReunion.style.backgroundColor = "LightPink";
    else {
      sujetReunion.style.backgroundColor = "#bef7e3";
          document.querySelector("#sujetReunionError").innerHTML = "";
        }
      }

      document.querySelector("#dateReunion").addEventListener("mouseout", validatedate);
      function validatedate() {
          let dateReunion = document.querySelector("#dateReunion");
          
          if(dateReunion.value === "")
          dateReunion.style.backgroundColor = "LightPink";
      else {
        dateReunion.style.backgroundColor = "#bef7e3";
            document.querySelector("#dateReunionError").innerHTML = "";
          }
        }

        document.querySelector("#heureReunion").addEventListener("mouseout", validateheure);
        function validateheure() {
            let heureReunion = document.querySelector("#heureReunion");
            
            if(heureReunion.value === "")
            heureReunion.style.backgroundColor = "LightPink";
        else {
          heureReunion.style.backgroundColor = "#bef7e3";
              document.querySelector("#heureReunionError").innerHTML = "";
            }
          }