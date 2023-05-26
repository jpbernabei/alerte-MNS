// function verificationActifUser(){
//     let isCheckedUser = document.getElementById("actifUser").checked;
//     let isNotCheckedUser = document.getElementById("noActifUser");
//     if (!isCheckedUser){
//         isNotCheckedUser.value = 0;
//     } else {
//         isNotCheckedUser.value = 1;
//     }
// }
// let userActive = document.getElementById("actifUser").value;
// let userToggle = document.getElementById("actifUser");

// if(userActive == 1)
// {
//     userToggle.checked = true;
// }else{
//     userToggle.checked = false;
// }

function verificationActifAdmin(){
    let isCheckedAdmin = document.getElementById("actifAdmin").checked;
    let isNotCheckedAdmin = document.getElementById("noActifAdmin");
    if(!isCheckedAdmin){
        isNotCheckedAdmin.value = 0;
    } else {
        isNotCheckedAdmin.value = 1;
    }
}


// let adminActif = document.getElementById("actifAdmin").value;
// let adminToggle = document.getElementById("actifAdmin");

// if(adminActif == 1)
// {
//     adminToggle.checked = true;
// }else{
//     adminToggle.checked = false;
// }



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

    let nameRegex = /^[a-zA-Z]+$/;
    let isValidname = nameRegex.test(nameInput.value);

    let prenomRegex = /^[a-zA-Z]+$/;
    let isValidPrenom = prenomRegex.test(prenomInput.value);
  
    // Vérifier les conditions pour valider le formulaire
      if (!isValidEmail) {
        event.preventDefault()// Empêcher la soumission du formulaire par défaut
        emailInput.style.border = "solid 3px red";
        document.querySelector("#emailError").innerHTML= "Adresse email non valide";
        document.querySelector("#emailError").style.color = "orange"
      }
      if (!isValidPassword) {
        event.preventDefault()// Empêcher la soumission du formulaire par défaut
        passwordInput.style.border = "solid 3px red";
        document.querySelector("#passwordError").innerHTML = "Le mot de passe doit contenir au moins 8 caractaires, dont une majuscule et un chiffre.";
        document.querySelector("#passwordError").style.color = "orange"
      }
      if (!isValidname) {
        event.preventDefault()
        nameInput.style.border ="solid 3px red";
        document.querySelector("#nameError").innerHTML = "Le nom ne doit pas comporter de caractaires spécials";
        document.querySelector("#nameError").style.color = "orange"
      }
      if (!isValidPrenom) {
        event.preventDefault()
        prenomInput.style.border ="solid 3px red";
        document.querySelector("#prenomError").innerHTML = "Le prénom ne doit pas comporter de caractaires spécials";
        document.querySelector("#prenomError").style.color = "orange"
      }
  }
  
  // Ajouter un gestionnaire d'événement pour le formulaire 
  document.querySelector("#form").addEventListener("submit", (e)=>validateForm(e));

