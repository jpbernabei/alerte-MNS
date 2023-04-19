function verificationActifUser(){
    let isChecked = document.getElementById("actifUser").checked;
    let isNotChecked = document.getElementById("noActifUser");
    if (!isChecked){
        isNotChecked.value = 0;
    } else {
        isNotChecked.value = 1;
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


// let userToggle = document.getElementById("actifUser");

// userToggle.addEventListener("change", function() {
//   if (this.checked) {
//     // Code pour activer l'utilisateur
//   } else {
//     // Code pour désactiver l'utilisateur
//   }
// });