function verificationActifUser(){
    let isChecked = document.getElementById("actifUser").checked;
    let isNotChecked = document.getElementById("noActifUser");
    if (!isChecked){
        isNotChecked.value = 0;
    } else {
        isNotChecked.value = 1
    }
}