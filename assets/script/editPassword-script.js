function validateEditPassword(event){

    let emailInput = document.querySelector('#email');
    let oldPasswordInput = document.querySelector('#oldPassword');
    let newPassword1Input = document.querySelector('#newPassword1');
    let newPassword2Input = document.querySelector('#newPassword2');

      // Vérifier l'adresse e-mail
      let emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      let isValidEmail = emailRegex.test(emailInput.value);
    
      // Vérifier le mot de passe (au moins une majuscule et un chiffre)
      let passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;

      let isValidPassword1 = passwordRegex.test(oldPasswordInput.value);

      let isValidPassword2 = passwordRegex.test(newPassword1Input.value);

      let isValidPassword3 = passwordRegex.test(newPassword2Input.value);
  
      // Vérifier les conditions pour valider le formulaire
        if (!isValidEmail) {
          event.preventDefault()// Empêcher la soumission du formulaire par défaut
          emailInput.style.border = "solid 3px red";
          document.querySelector("#emailError").innerHTML= "Adresse email non valide";
          document.querySelector("#emailError").style.color = "orange"
        }
        if (!isValidPassword1) {
          event.preventDefault()// Empêcher la soumission du formulaire par défaut
          oldPasswordInput.style.border = "solid 3px red";
          document.querySelector("#oldPasswordError").innerHTML = "Le mot de passe doit contenir au moins 8 caractaires, dont une majuscule et un chiffre.";
          document.querySelector("#oldPasswordError").style.color = "orange"
        }
        if (!isValidPassword2) {
          event.preventDefault()
          newPassword1Input.style.border ="solid 3px red";
          document.querySelector("#newPassword1Error").innerHTML = "Le mot de passe doit contenir au moins 8 caractaires, dont une majuscule et un chiffre";
          document.querySelector("#newPassword1Error").style.color = "orange"
        }
        if (!isValidPassword3) {
          event.preventDefault()
          newPassword2Input.style.border ="solid 3px red";
          document.querySelector("#newPassword2Error").innerHTML = "Le mot de passe doit contenir au moins 8 caractaires, dont une majuscule et un chiffre";
          document.querySelector("#newPassword2Error").style.color = "orange"
        }
        if(isValidPassword2 != isValidPassword3) {
            event.preventDefault()
          newPassword2Input.style.border ="solid 3px red";
          document.querySelector("#newPassword2Error").innerHTML = "Les mots de passe doivent être identiques";
          document.querySelector("#newPassword2Error").style.color = "orange"
        }
    }
    
    // Ajouter un gestionnaire d'événement pour le formulaire 
    document.querySelector("#form").addEventListener("submit", (e)=>validateEditPassword(e));

