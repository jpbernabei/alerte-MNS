function verificationActifReunion(){
    let isChecked = document.getElementById("actifReunion").checked;
    let isNotChecked = document.getElementById("noActifReunion");
    if (!isChecked){
        isNotChecked.value = 0;
    } else {
        isNotChecked.value = 1;
    }
}