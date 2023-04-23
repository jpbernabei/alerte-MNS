function verificationActifReunion(){
    let isChecked = document.getElementById("actifReunion").checked;
    let isNotChecked = document.getElementById("noActifReunion");
    if (!isChecked){
        isNotChecked.value = 0;
    } else {
        isNotChecked.value = 1;
    }
}
let reunionActive = document.getElementById("actifReunion").value;
let reunionToggle = document.getElementById("actifReunion");

if(reunionActive == 1)
{
    reunionToggle.checked = true;
}else{
    reunionToggle.checked = false;
}