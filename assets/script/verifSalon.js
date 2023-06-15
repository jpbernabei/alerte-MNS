

function formVerifySalon(event) {
     
    // Récupérer les valeurs des champs
    let salon = document.querySelector("#salon");

          // Réinitialiser les styles et les messages d'erreur
          salon.style.backgroundColor = "none";
          document.querySelector("#salon").innerHTML = "";

    // Vérifier les conditions pour valider le formulaire
      if (salon.value == '' ) {
        event.preventDefault()// Empêcher la soumission du formulaire par défaut
        salon.style.backgroundColor = "LightPink";
        document.querySelector("#salon").innerHTML= "Le salon doit contenir un nom.";
        document.querySelector("#salon").style.color = "orange"
      }
  }
  
  // Ajouter un gestionnaire d'événement pour le formulaire 
  document.querySelector("#form").addEventListener("submit", (e)=>validateFormReunion(e));

  
  document.querySelector("#salon").addEventListener("keyup", validateNom);
  function validateNom() {
      let salon = document.querySelector("#salon");
      
      if(salon.value === "")
      salon.style.backgroundColor = "LightPink";
  else {
    salon.style.backgroundColor = "#bef7e3";
        document.querySelector("#salon").innerHTML = "";
      }
    }