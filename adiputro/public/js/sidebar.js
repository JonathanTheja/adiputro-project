function dropdown() {
    document.querySelector("#submenu").classList.toggle("hidden");
    document.querySelector("#arrow").classList.toggle("rotate-180");
}
dropdown();

function Open() {
    document.querySelector(".sidebar").classList.toggle("left-[-250px]");
}

function closeSidebar() {
    document.querySelector(".sidebar").classList.add("left-[-250px]");
}

function changeSideMenu(e, master) {
    let sidemenu = document.getElementsByClassName("sidemenu");
    for (let i = 0; i < sidemenu.length; i++) {
        sidemenu[i].classList.remove("bg-blue-600");
        let containerMaster = document.getElementsByClassName("containerMaster");
        for (let j = 0; j < containerMaster.length; j++) {
            containerMaster[j].classList.add("hidden");
        }
    }
    e.classList.add("bg-blue-600");
    if (document.getElementById(master).classList.contains("hidden")) {
        document.getElementById(master).classList.remove("hidden");
    }

    if (master == "masterUser") {
        window.history.replaceState('page', 'Title', "/master/user");
    } else if (master == "masterDepartemen") {
        window.history.replaceState('page', 'Title', "/master/departemen");
    } else if (master == "masterStall") {
        window.history.replaceState('page', 'Title', "/master/stall");
    } else if (master == "masterLevel") {
        window.history.replaceState('page', 'Title', "/master/level");
    }
}

let url = window.location.href;
let master = url.substring(url.indexOf("/master"), url.length);
document.getElementById("masterDepartemen").classList.remove("hidden");
// alert(url.substring(url.indexOf("master/"), url.length));
if (master == "master/user") {
    document.getElementById("masterUser").classList.remove("hidden");
    document.getElementById("sidemenuUser").classList.add("bg-blue-600");
}
else if (master == "master/departemen") {
    document.getElementById("masterDepartemen").classList.remove("hidden");
    document.getElementById("sidemenuDepartemen").classList.add("bg-blue-600");
}
else if (master == "master/stall") {
    document.getElementById("masterStall").classList.remove("hidden");
    document.getElementById("sidemenuStall").classList.add("bg-blue-600");
}
else if (master == "master/level") {
    document.getElementById("masterLevel").classList.remove("hidden");
    document.getElementById("sidemenuLevel").classList.add("bg-blue-600");
}
