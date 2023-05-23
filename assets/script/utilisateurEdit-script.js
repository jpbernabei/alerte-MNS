    
function validateFormEdit(event) {
     
    // Récupérer les valeurs des champs
    let emailInput = document.querySelector("#emailEdit");
    let nameInput = document.querySelector('#nameEdit');
    let prenomInput = document.querySelector('#prenomEdit');
  
    // Vérifier l'adresse e-mail
    let emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    let isValidEmail = emailRegex.test(emailInput.value);

    let nameRegex = /^[a-zA-Z]+$/;
    let isValidname = nameRegex.test(nameInput.value);

    let prenomRegex = /^[a-zA-Z]+$/;
    let isValidPrenom = prenomRegex.test(prenomInput.value);
  
    // Vérifier les conditions pour valider le formulaire
      if (!isValidEmail) {
        event.preventDefault()// Empêcher la soumission du formulaire par défaut
        emailInput.style.border = "solid 3px red";
        document.querySelector("#emailErrorEdit").innerHTML= "Adresse email non valide";
        document.querySelector("#emailErrorEdit").style.color = "orange"
      }
     
      if (!isValidname) {
        event.preventDefault()
        nameInput.style.border ="solid 3px red";
        document.querySelector("#nameErrorEdit").innerHTML = "Le nom ne doit pas comporter de caractaires spécials";
        document.querySelector("#nameErrorEdit").style.color = "orange"
      }
      if (!isValidPrenom) {
        event.preventDefault()
        prenomInput.style.border ="solid 3px red";
        document.querySelector("#prenomErrorEdit").innerHTML = "Le prénom ne doit pas comporter de caractaires spécials";
        document.querySelector("#prenomErrorEdit").style.color = "orange"
      }
  }
  
  // Ajouter un gestionnaire d'événement pour le formulaire 
  document.querySelector("#formEdit").addEventListener("submit", (e)=>validateFormEdit(e));