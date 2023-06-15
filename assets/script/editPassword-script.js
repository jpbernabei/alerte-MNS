function validateEditPassword(event){

    let emailInput = document.querySelector('#emailEdit');
    let oldPasswordInput = document.querySelector('#oldPassword');
    let newPassword1Input = document.querySelector('#newPassword1');
    let newPassword2Input = document.querySelector('#newPassword2');

      // Vérifie l'adresse e-mail
      let emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      let isValidEmail = emailRegex.test(emailInput.value);
    
      // Vérifie le mot de passe (au moins une majuscule et un chiffre)
      let passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;

      let isValidPassword1 = passwordRegex.test(oldPasswordInput.value);

      let isValidPassword2 = passwordRegex.test(newPassword1Input.value);

      let isValidPassword3 = passwordRegex.test(newPassword2Input.value);
  
      // Vérifie les conditions pour valider le formulaire
        if (!isValidEmail) {
          event.preventDefault()// Empêche la soumission du formulaire par défaut
          emailInput.style.backgroundColor = "LightPink";
          document.querySelector("#emailErrorEdit").innerHTML= "Adresse email non valide";
          document.querySelector("#emailErrorEdit").style.color = "orange"
        }else {
          emailInput.style.backgroundColor = "#bef7e3";
          document.querySelector("#emailErrorEdit").innerHTML = "";
        }
        if (!isValidPassword1) {
          event.preventDefault()// Empêche la soumission du formulaire par défaut
          oldPasswordInput.style.backgroundColor = "LightPink";
          document.querySelector("#oldPasswordError").innerHTML = "Le mot de passe doit contenir au moins 8 caractères, dont une majuscule et un chiffre.";
          document.querySelector("#oldPasswordError").style.color = "orange"
        }else {
          oldPasswordInput.style.backgroundColor = "#bef7e3";
          document.querySelector("#oldPasswordError").innerHTML = "";
        }
        if (!isValidPassword2) {
          event.preventDefault()
          newPassword1Input.style.backgroundColor = "LightPink";
          document.querySelector("#newPassword1Error").innerHTML = "Le mot de passe doit contenir au moins 8 caractères, dont une majuscule et un chiffre";
          document.querySelector("#newPassword1Error").style.color = "orange"
        }else {
          newPassword1Input.style.backgroundColor = "#bef7e3";
          document.querySelector("#newPassword1Error").innerHTML = "";}
        if (!isValidPassword3) {
          event.preventDefault()
          newPassword2Input.style.backgroundColor = "LightPink";
          document.querySelector("#newPassword2Error").innerHTML = "Le mot de passe doit contenir au moins 8 caractères, dont une majuscule et un chiffre";
          document.querySelector("#newPassword2Error").style.color = "orange"
        }
        else if(newPassword1Input.value != newPassword2Input.value) {
            event.preventDefault()
          newPassword2Input.style.backgroundColor = "LightPink";
          document.querySelector("#newPassword2Error").innerHTML = "Les mots de passe doivent être identiques";
          document.querySelector("#newPassword2Error").style.color = "orange"
        }else {
          newPassword2Input.style.backgroundColor = "#bef7e3";
          document.querySelector("#newPassword2Error").innerHTML = "";}
    }
    
    // Ajoute un gestionnaire d'événement pour le formulaire 
    document.querySelector("#form").addEventListener("submit", (e)=>validateEditPassword(e));



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
          document.querySelector("#emailErrorEdit").innerHTML = "";
        }
      }
  
      document.querySelector("#oldPassword").addEventListener("keyup", validateOldPassword);
      function validateOldPassword() {
        let oldPasswordInput = document.querySelector("#oldPassword");
        let oldPasswordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
        let isValidoldPassword = oldPasswordRegex.test(oldPasswordInput.value);
      
        if(oldPasswordInput.value === "")
        oldPasswordInput.style.backgroundColor = "LightPink";
        if(!isValidoldPassword ){
          oldPasswordInput.style.backgroundColor = "LightPink";
        }
      
        if (isValidoldPassword) {
          oldPasswordInput.style.backgroundColor = "#bef7e3";
          document.querySelector("#oldPasswordError").innerHTML = "";
        }
      }
  
      document.querySelector("#newPassword1").addEventListener("keyup", validateNewPassword1);
  function validateNewPassword1() {
    let newPassword1Input = document.querySelector("#newPassword1");
    let newPassword1Regex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    let isValidNewPassword1 = newPassword1Regex.test(newPassword1Input.value);
  
    if(newPassword1Input.value === "")
    newPassword1Input.style.backgroundColor = "LightPink";
  
    if(!isValidNewPassword1 ){
      newPassword1Input.style.backgroundColor = "LightPink";
    }
    if (isValidNewPassword1){
      newPassword1Input.style.backgroundColor = "#bef7e3";
      document.querySelector("#newPassword1Error").innerHTML = "";
    }
  }

  document.querySelector("#newPassword2").addEventListener("keyup", validateNewPassword2);
  function validateNewPassword2() {
    let newPassword2Input = document.querySelector("#newPassword2");
    let newPassword2Regex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    let isValidnewPassword2 = newPassword2Regex.test(newPassword2Input.value);
  
    if(newPassword2Input.value === "")
    newPassword2Input.style.backgroundColor = "LightPink";
  
    if(!isValidnewPassword2 ){
      newPassword2Input.style.backgroundColor = "LightPink";
    }
    if (isValidnewPassword2){
      newPassword2Input.style.backgroundColor = "#bef7e3";
      document.querySelector("#newPassword2Error").innerHTML = "";
    }
  }