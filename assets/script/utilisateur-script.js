function verificationActifUser(){
    let isCheckedUser = document.getElementById("actifUser").checked;
    let isNotCheckedUser = document.getElementById("noActifUser");
    if (!isCheckedUser){
        isNotCheckedUser.value = 0;
    } else {
        isNotCheckedUser.value = 1;
    }
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



let userActive = document.getElementById("actifUser").value;
let userToggle = document.getElementById("actifUser");

if(userActive == 1)
{
    userToggle.checked = true;
}else{
    userToggle.checked = false;
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