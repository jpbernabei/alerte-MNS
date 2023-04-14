// le fond des champs devient gris quand on focus
document.querySelector("#email").addEventListener("focus", function(e){
    this.style.backgroundColor ="silver"
})
document.querySelector("#email").addEventListener("focusout", function(e){
    this.style.backgroundColor =""
})
//le fond des champs redevient normal quand on focusout
document.querySelector("#password").addEventListener("focus",function(e){
    this.style.backgroundColor ="silver"
})
document.querySelector("#password").addEventListener("focusout",function(e){
    this.style.backgroundColor =""
})
// Vérification de l'email, on définit une variable regex : 
let validateEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
document.querySelector("#email").addEventListener("input", function(e){
    // juste pour voir, on va changer le fond
    this.style.backgroundColor = "silver"
    // on compart la valeur du champ par la variable
    if(document.querySelector("#email").value.match(validateEmail)){
        document.querySelector("#email").style.border="solid 3px green"
    }
    else if(document.querySelector("#email").lenght == 0){
        document.querySelector("#email").style.border=""
    }
        else{
        document.querySelector("#email").style.border="solid 3px red"
    }
})

