var sidenav = document.getElementById("mySidenav");
var openBtn = document.getElementById("openBtn");
var closeBtn = document.getElementById("closeBtn");

openBtn.onclick = openNav;
closeBtn.onclick = closeNav;


function openNav() {
  sidenav.classList.add("active");
}


function closeNav() {
  sidenav.classList.remove("active");
}


var sidenavChaine = document.getElementById("sidenavChaine");
var openBtnChaine = document.getElementById("openBtnChaine");
var closeBtnChaine = document.getElementById("closeBtnChaine");

openBtnChaine.onclick = openNavChaine;
closeBtnChaine.onclick = closeNavChaine;


function openNavChaine() {
  sidenavChaine.classList.add("activeChaine");
}


function closeNavChaine() {
  sidenavChaine.classList.remove("activeChaine");
}

// fonction qui permet de verifier si la sideNavChaine est ouverte et la fermer si c'est le cas
function openNavChaine() {
  if (sidenavChaine.classList.contains("activeChaine")) {
    closeNavChaine();
  } else {
    sidenavChaine.classList.add("activeChaine");
  }
}