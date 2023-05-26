function verificationActifSalon(){
    let isChecked = document.getElementById("actifSalon").checked;
    let isNotChecked = document.getElementById("noActifSalon");
    if (!isChecked){
        isNotChecked.value = 0;
    } else {
        isNotChecked.value = 1;
    }
}
