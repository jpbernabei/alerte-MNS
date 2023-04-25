function verificationActifSalon(){
    let isChecked = document.getElementById("actifSalon").checked;
    let isNotChecked = document.getElementById("noActifSalon");
    if (!isChecked){
        isNotChecked.value = 0;
    } else {
        isNotChecked.value = 1;
    }
}
let salonActive = document.getElementById("actifSalon").value;
let salonToggle = document.getElementById("actifSalon");

if(salonActive == 1)
{
    salonToggle.checked = true;
}else{
    salonToggle.checked = false;
}