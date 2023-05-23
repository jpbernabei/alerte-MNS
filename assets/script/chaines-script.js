
function verificationActifChaine(){
    let isCheckedChaine = document.getElementById("actifChaine").checked;
    let isNotCheckedChaine = document.getElementById("noActifChaine");
    if (!isCheckedChaine){
        isNotCheckedChaine.value = 0;
    } else {
        isNotCheckedChaine.value = 1;
    }
}
let chaineActive = document.getElementById("actifChaine").value;
let chaineToggle = document.getElementById("actifChaine");

if(chaineActive == 1)
{
    chaineToggle.checked = true;
}else{
    chaineToggle.checked = false;
}


