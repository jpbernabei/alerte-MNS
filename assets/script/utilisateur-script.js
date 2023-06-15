function verificationActifUser(){
    let isCheckedUser = document.getElementById("actifUser").checked;
    let isNotCheckedUser = document.getElementById("noActifUser");
    if (!isCheckedUser){
        isNotCheckedUser.value = 0;
    } else {
        isNotCheckedUser.value = 1;
    }
}
let userActive = document.getElementById("actifUser").value;
let userToggle = document.getElementById("actifUser");

if(userActive == 1)
{
    userToggle.checked = true;
}else{
    userToggle.checked = false;
}

function verificationActifAdmin(){
    let isCheckedAdmin = document.getElementById("actifAdmin").checked;
    let isNotCheckedAdmin = document.getElementById("noActifAdmin");
    if(!isCheckedAdmin){
        isNotCheckedAdmin.value = 0;
    } else {
        isNotCheckedAdmin.value = 1;
    }
}

let adminActif = document.getElementById("actifAdmin").value;
let adminToggle = document.getElementById("actifAdmin");

if(adminActif == 1)
{
    adminToggle.checked = true;
}else{
    adminToggle.checked = false;
}



// let userToggle = document.getElementById("actifUser");

// userToggle.addEventListener("change", function() {
//   if (this.checked) {
//     // Code pour activer l'utilisateur
//   } else {
//     // Code pour désactiver l'utilisateur
//   }
// });




function validateForm(event) {
     
    // Récupérer les valeurs des champs
    let emailInput = document.querySelector("#email");
    let passwordInput = document.querySelector("#password");
    let nameInput = document.querySelector('#nom');
    let prenomInput = document.querySelector('#prenom');
  
    // Vérifier l'adresse e-mail
    let emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    let isValidEmail = emailRegex.test(emailInput.value);
  
    // Vérifier le mot de passe (au moins une majuscule et un chiffre)
    let passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    let isValidPassword = passwordRegex.test(passwordInput.value);

    let nameRegex = /^[a-zA-Z\-]+$/;
    let isValidname = nameRegex.test(nameInput.value);

    let prenomRegex = /^[a-zA-Z\-]+$/;
    let isValidPrenom = prenomRegex.test(prenomInput.value);

      // Réinitialiser les styles et les messages d'erreur
    emailInput.style.border = "none";
    document.querySelector("#emailError").innerHTML = "";

    passwordInput.style.border = "none";
    document.querySelector("#passwordError").innerHTML = "";

    nameInput.style.border = "none";
    document.querySelector("#nameError").innerHTML = "";

    prenomInput.style.border = "none";
    document.querySelector("#prenomError").innerHTML = "";
  
    // Vérifier les conditions pour valider le formulaire
      if (!isValidEmail) {
        event.preventDefault()// Empêcher la soumission du formulaire par défaut
        emailInput.style.backgroundColor = "LightPink";
        document.querySelector("#emailError").innerHTML= "Adresse email non valide";
        document.querySelector("#emailError").style.color = "orange";
      } else {
        emailInput.style.backgroundColor = "#bef7e3";
        document.querySelector("#emailError").innerHTML = "";
      }

      if (!isValidPassword) {
        event.preventDefault()// Empêcher la soumission du formulaire par défaut
        passwordInput.style.backgroundColor = "LightPink";
        document.querySelector("#passwordError").innerHTML = "Le mot de passe doit contenir au moins 8 caractères, dont une majuscule et un chiffre.";
        document.querySelector("#passwordError").style.color = "orange"
      } else {
    passwordInput.style.backgroundColor = "#bef7e3";
    document.querySelector("#passwordError").innerHTML = "";
  }

      if (!isValidname) {
        event.preventDefault()
        nameInput.style.backgroundColor ="LightPink";
        document.querySelector("#nameError").innerHTML = "Le nom ne doit pas comporter de caractères spéciaux";
        document.querySelector("#nameError").style.color = "orange"
      }else {
        nameInput.style.backgroundColor = "#bef7e3";
        document.querySelector("#nameError").innerHTML = "";
      }

      if (!isValidPrenom) {
        event.preventDefault()
        prenomInput.style.backgroundColor ="LightPink";
        document.querySelector("#prenomError").innerHTML = "Le prénom ne doit pas comporter de caractères spéciaux";
        document.querySelector("#prenomError").style.color = "orange"
      } else {
        prenomInput.style.backgroudColor = "#bef7e3";
        document.querySelector("#prenomError").innerHTML = "";
      }
  }
  
  // Ajouter un gestionnaire d'événement pour le formulaire 
  document.querySelector("#form").addEventListener("submit", (e)=>validateForm(e));

  document.querySelector("#email").addEventListener("keyup", validateEmail);
  function validateEmail() {
      let emailInput = document.querySelector("#email");
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


document.querySelector("#password").addEventListener("keyup", validatePassword);
    function validatePassword() {
  let passwordInput = document.querySelector("#password");
  let passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
  let isValidPassword = passwordRegex.test(passwordInput.value);

  if(passwordInput.value === "")
  passwordInput.style.backgroundColor = "LightPink";
  if(!isValidPassword ){
    passwordInput.style.backgroundColor = "LightPink";
  }

  if (isValidPassword)  {
    passwordInput.style.backgroundColor = "#bef7e3";
    document.querySelector("#passwordError").innerHTML = "";
  }
}

document.querySelector("#nom").addEventListener("keyup", validateName);
function validateName() {
  let nameInput = document.querySelector("#nom");
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

document.querySelector("#prenom").addEventListener("keyup", validatePrenom);
function validatePrenom() {
  let prenomInput = document.querySelector("#prenom");
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

