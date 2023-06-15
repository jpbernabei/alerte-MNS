function validateFormConnexion(event) {
   
    // Récupére les valeurs des champs
    let emailInput = document.querySelector("#email");
    let passwordInput = document.querySelector("#password");
  
    // Vérifie l'adresse e-mail
    let emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    let isValidEmail = emailRegex.test(emailInput.value);
  
    // Vérifie le mot de passe (au moins une majuscule et un chiffre)
    let passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    let isValidPassword = passwordRegex.test(passwordInput.value);
    // si l'email n'est pas valide OU si le mot de passe n'est pas valide alors le formulaire ne se soumet pas 
    // et un message d'erreur s'affiche
        if(!isValidEmail || !isValidPassword){
            event.preventDefault()
            document.querySelector("#error").innerHTML = "Identifiant invalide";
            document.querySelector("#error").style.color = "orange";
            emailInput.style.backgroundColor = "LightPink";
            passwordInput.style.backgroundColor = "LightPink";
        }
        // // Vérifie les conditions pour valider le formulaire
        // if (!isValidEmail) {
        //     event.preventDefault()// Empêche la soumission du formulaire par défaut
            
        //     emailInput.style.backgroundColor = "LightPink";
        //     document.querySelector("#passwordError").innerHTML= "Identifiant invalide";
        //     document.querySelector("#passwordError").style.color = "orange";
            
        //   } else {
        //     emailInput.style.backgroundColor = "#bef7e3";
        //     document.querySelector("#emailError").innerHTML = "";
        //   }
    
        //   if (!isValidPassword) {
        //     event.preventDefault()// Empêche la soumission du formulaire par défaut
        //     passwordInput.style.backgroundColor = "LightPink";
        //     document.querySelector("#passwordError").innerHTML = "Identifiant invalide";
        //     document.querySelector("#passwordError").style.color = "orange"
        //   } else {
        // passwordInput.style.backgroundColor = "#bef7e3";
        // document.querySelector("#passwordError").innerHTML = "";
      }
    
      document.querySelector("#form").addEventListener("submit", (e)=>validateFormConnexion(e));


document.querySelector("#email").addEventListener("keyup", validateEmailConnexion);
function validateEmailConnexion() {
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


document.querySelector("#password").addEventListener("keyup", validatePasswordConnexion);
  function validatePasswordConnexion() {
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
  document.querySelector("#error").innerHTML = "";
}
}
// le fond des champs devient gris quand on focus
document.querySelector("#email").addEventListener("focus", function(e){
    this.style.backgroundColor ="silver"
})
//le fond des champs redevient normal quand on sort du champ
document.querySelector("#email").addEventListener("focusout", function(e){
    this.style.backgroundColor =""
})
// le fond des champs devient gris quand on focus
document.querySelector("#password").addEventListener("focus",function(e){
    this.style.backgroundColor ="silver"
})
//le fond des champs redevient normal quand on sort du champ
document.querySelector("#password").addEventListener("focusout",function(e){
    this.style.backgroundColor =""
})


