var sidenav = document.getElementById("mySidenav");
var openBtn = document.getElementById("openBtn");
var closeBtn = document.getElementById("closeBtn");

openBtn.onclick = openNav;
closeBtn.onclick = closeNav;

/* Set the width of the side navigation to 250px */
function openNav() {
  sidenav.classList.add("active");
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  sidenav.classList.remove("active");
}


var sidenavChaine = document.getElementById("sidenavChaine");
var openBtnChaine = document.getElementById("openBtnChaine");
var closeBtnChaine = document.getElementById("closeBtnChaine");

openBtnChaine.onclick = openNavChaine;
closeBtnChaine.onclick = closeNavChaine;

/* Set the width of the side navigation to 250px */
function openNavChaine() {
  sidenavChaine.classList.add("activeChaine");
}

/* Set the width of the side navigation to 0 */
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