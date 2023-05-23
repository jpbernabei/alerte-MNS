// le fond des champs devient gris quand on focus
document.querySelector("#email").addEventListener("focus", function(e){
    this.style.backgroundColor ="silver"
})
//le font des champs redevient normal quand on sort du champ
document.querySelector("#email").addEventListener("focusout", function(e){
    this.style.backgroundColor =""
})
// le fond des champs devient gris quand on focus
document.querySelector("#password").addEventListener("focus",function(e){
    this.style.backgroundColor ="silver"
})
//le font des champs redevient normal quand on sort du champ
document.querySelector("#password").addEventListener("focusout",function(e){
    this.style.backgroundColor =""
})
// Vérification de l'email, définition d'une variable pour y stocker le regex: 
let validateEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

//Selection de l'élement avec son id, et ajout d'un evenement
document.querySelector("#email").addEventListener("input", function(e){

    //comparaison de la valeur du champ avec le regex
    if(document.querySelector("#email").value.match(validateEmail)){
        document.querySelector("#email").style.border="solid 3px green"
    }
    else if(document.querySelector("#email").value.lenght == 0){
        document.querySelector("#email").style.border=""
    }
        else{
        document.querySelector("#email").style.border="solid 3px red"
    }
})

