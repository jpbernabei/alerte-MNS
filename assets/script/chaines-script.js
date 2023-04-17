function verificationActifChaine(){
    let isChecked = document.getElementById("actifChaine").checked;
    let isNotChecked = document.getElementById("noActifChaine");
    if (!isChecked){
        isNotChecked.value = 0;
    } else {
        isNotChecked.value = 1
    }
}