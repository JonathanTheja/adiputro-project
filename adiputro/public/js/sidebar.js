function dropdown() {
    document.querySelector("#submenu").classList.toggle("hidden");
    document.querySelector("#arrow").classList.toggle("rotate-180");
}
dropdown();

function Open() {
    document.querySelector(".sidebar").classList.toggle("left-[-250px]");
    document.querySelector("#container").classList.toggle("ml-[250px]");
}

function closeSidebar() {
    document.querySelector(".sidebar").classList.add("left-[-250px]");
    document.querySelector("#container").classList.remove("ml-[250px]");
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
var master = url.substring(url.indexOf("/master"), url.length);
if (master.includes("master/user")) {
    document.getElementById("sidemenuUser").classList.add("bg-blue-600");
}
else if (master.includes("master/departemen")) {
    document.getElementById("sidemenuDepartemen").classList.add("bg-blue-600");
}
else if (master.includes("master/stall")) {
    document.getElementById("sidemenuStall").classList.add("bg-blue-600");
}
else if (master.includes("master/level")) {
    document.getElementById("sidemenuLevel").classList.add("bg-blue-600");
}
