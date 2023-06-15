    
  //   function verificationActifAdmin(){
  //     let isCheckedAdmin = document.getElementById("actifAdmin").checked;
  //     let isNotCheckedAdmin = document.getElementById("noActifAdmin");
  //     if(!isCheckedAdmin){
  //         isNotCheckedAdmin.value = 0;
  //     } else {
  //         isNotCheckedAdmin.value = 1;
  //     }
  // }
  
  
  // let adminActif = document.getElementById("actifAdmin").value;
  // let adminToggle = document.getElementById("actifAdmin");
  
  // if(adminActif == 1)
  // {
  //     adminToggle.checked = true;
  // }else{
  //     adminToggle.checked = false;
  // }
  
  
function validateFormEdit(event) {
     
    // Récupére les valeurs des champs
    let emailInput = document.querySelector("#emailEdit");
    let nameInput = document.querySelector('#nameEdit');
    let prenomInput = document.querySelector('#prenomEdit');
  
    // Vérifie l'adresse e-mail
    let emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    let isValidEmail = emailRegex.test(emailInput.value);

    let nameRegex = /^[a-zA-Z\-]+$/;
    let isValidname = nameRegex.test(nameInput.value);

    let prenomRegex = /^[a-zA-Z\-]+$/;
    let isValidPrenom = prenomRegex.test(prenomInput.value);
  
          // Réinitialise les styles et les messages d'erreur
          emailInput.style.border = "none";
          document.querySelector("#emailErrorEdit").innerHTML = "";
      
          nameInput.style.border = "none";
          document.querySelector("#nameErrorEdit").innerHTML = "";
      
          prenomInput.style.border = "none";
          document.querySelector("#prenomErrorEdit").innerHTML = "";
        
    // Vérifie les conditions pour valider le formulaire
      if (!isValidEmail) {
        event.preventDefault()// Empêche la soumission du formulaire par défaut
        emailInput.style.backgroundColor = "LightPink";
        document.querySelector("#emailErrorEdit").innerHTML= "Adresse email non valide";
        document.querySelector("#emailErrorEdit").style.color = "orange"
      } else {
        emailInput.style.backgroundColor = "#bef7e3";
        document.querySelector("#emailErrorEdit").innerHTML = "";
      }
      if (!isValidname) {
        event.preventDefault()
        nameInput.style.backgroundColor = "LightPink";
        document.querySelector("#nameErrorEdit").innerHTML = "Le nom ne doit pas comporter de caractères spéciaux";
        document.querySelector("#nameErrorEdit").style.color = "orange"
      }else {
        nameInput.style.backgroundColor = "#bef7e3";
        document.querySelector("#nameErrorEdit").innerHTML = "";
      }

      if (!isValidPrenom) {
        event.preventDefault()
        prenomInput.style.backgroundColor = "LightPink";
        document.querySelector("#prenomErrorEdit").innerHTML = "Le prénom ne doit pas comporter de caractères spéciaux";
        document.querySelector("#prenomErrorEdit").style.color = "orange"
      } else {
        prenomInput.style.backgroundColor = "#bef7e3";
        document.querySelector("#prenomErrorEdit").innerHTML = "";}
  }
  
  // Ajoute un gestionnaire d'événement pour le formulaire 
  document.querySelector("#formEdit").addEventListener("submit", (e)=>validateFormEdit(e));

  document.querySelector("#emailEdit").addEventListener("keyup", validateEmail);
  function validateEmail() {
      let emailInput = document.querySelector("#emailEdit");
      let emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      let isValidEmail = emailRegex.test(emailInput.value);

      if(emailInput.value === "")
      emailInput.style.backgroundColor = "LightPink";

      if(!isValidEmail ){
        emailInput.style.backgroundColor = "LightPink";
      }
    
      if (isValidEmail) {
        emailInput.style.backgroundColor = "#bef7e3";
        document.querySelector("#emailError").innerHTML = "";
      }
    }

    document.querySelector("#nameEdit").addEventListener("keyup", validateName);
    function validateName() {
      let nameInput = document.querySelector("#nameEdit");
      let nameRegex = /^[a-zA-Z\-]+$/;
      let isValidName = nameRegex.test(nameInput.value);
    
      if(nameInput.value === "")
      nameInput.style.backgroundColor = "LightPink";
      if(!isValidName ){
        nameInput.style.backgroundColor = "LightPink";
      }
    
      if (isValidName) {
        nameInput.style.backgroundColor = "#bef7e3";
        document.querySelector("#nameError").innerHTML = "";
      }
    }

    document.querySelector("#prenomEdit").addEventListener("keyup", validatePrenom);
function validatePrenom() {
  let prenomInput = document.querySelector("#prenomEdit");
  let prenomRegex = /^[a-zA-Z\-]+$/;
  let isValidPrenom = prenomRegex.test(prenomInput.value);

  if(prenomInput.value === "")
  prenomInput.style.backgroundColor = "LightPink";

  if(!isValidPrenom ){
    prenomInput.style.backgroundColor = "LightPink";
  }
  if (isValidPrenom){
    prenomInput.style.backgroundColor = "#bef7e3";
    document.querySelector("#prenomError").innerHTML = "";
  }
}