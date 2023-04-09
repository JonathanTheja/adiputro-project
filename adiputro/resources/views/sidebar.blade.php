<span class="fixed text-white text-4xl top-5 left-4 cursor-pointer" onclick="openSidebar();" id="openSidebar">
    <i class="bi bi-filter-left py-1 px-2 bg-gray-900 rounded-md"></i>
</span>
<div class="fixed top-0 bottom-0 p-2 w-250px overflow-y-auto text-center bg-gray-900" id="sidebar">
    <div class="text-gray-100 text-xl">
        <div class="p-2.5 mt-1 flex items-center">
            <div class="justify-center w-full">
                <img class="mx-auto w-48 bg-white rounded-md" src={{ asset('img/adiputro_logo.svg') }} alt="logo"
                    style="width:80px;height:80px" />
            </div>
            <div class="absolute ml-40 cursor-pointer bg-blue-600 px-3 py-1 rounded-md" onclick="openSidebar();">x</div>
        </div>
        <hr class="my-2 text-gray-600">
    </div>
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 cursor-pointer bg-gray-700 text-white">
        <i class="bi bi-search text-sm"></i>
        <input type="text" placeholder="Search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none">
    </div>
    <a href="{{ url('/master/user') }}">
        <div class="sidemenu p-2.5 mt-3 flex items-center rounded-md px-4 cursor-pointer hover:bg-blue-600 text-white"
            id="sidemenuUser">
            <i class="bi bi-people"></i>
            <span class="text-[15px] ml-4 text-gray-200">Master User</span>
        </div>
    </a>

    <a href="{{ url('/master/departemen') }}">
        <div class="sidemenu p-2.5 mt-3 flex items-center rounded-md px-4 cursor-pointer hover:bg-blue-600 text-white"
            id="sidemenuDepartemen">
            <i class="bi bi-house"></i>
            <span class="text-[15px] ml-4 text-gray-200">Master Departemen</span>
        </div>
    </a>
    {{-- <a href="{{ url('/master/stall') }}">
        <div class="sidemenu p-2.5 mt-3 flex items-center rounded-md px-4 cursor-pointer hover:bg-blue-600 text-white"
            onclick="changeSideMenu(this,'masterStall')" id="sidemenuStall">
            <i class="bi bi-house-door"></i>
            <span class="text-[15px] ml-4 text-gray-200">Master Stall</span>
        </div>
    </a> --}}
    <a href="{{ url('/dashboard') }}">
        <div class="sidemenu p-2.5 mt-3 flex items-center rounded-md px-4 cursor-pointer hover:bg-blue-600 text-white"
            id="sidemenuDashboard">
            <i class="bi bi-tools"></i>
            <span class="text-[15px] ml-4 text-gray-200">Dashboard</span>
        </div>
    </a>
    <a href="{{ url('/master/data') }}">
        <div class="sidemenu p-2.5 mt-3 flex items-center rounded-md px-4 cursor-pointer hover:bg-blue-600 text-white"
            id="sidemenuData">
            <i class="bi bi-stack"></i>
            <span class="text-[15px] ml-4 text-gray-200">Master Data</span>
        </div>
    </a>
    <a href="{{ url('/master/input') }}">
        <div class="sidemenu p-2.5 mt-3 flex items-center rounded-md px-4 cursor-pointer hover:bg-blue-600 text-white"
            id="sidemenuInput">
            <i class="bi bi-file-image"></i>
            <span class="text-[15px] ml-4 text-gray-200">Master Input</span>
        </div>
    </a>
    <a href="{{ url('/process-entry') }}">
        <div class="sidemenu p-2.5 mt-3 flex items-center rounded-md px-4 cursor-pointer hover:bg-blue-600 text-white"
            id="sidemenuProcessEntry">
            <i class="bi bi-hdd-stack"></i>
            <span class="text-[15px] ml-4 text-gray-200">Process Entry</span>
        </div>
    </a>
    <hr class="my-4 text-gray-600">
    <a href="{{ url('/notifikasi/report') }}">
        <div class="sidemenu p-2.5 mt-3 flex items-center rounded-md px-4 cursor-pointer hover:bg-blue-600 text-white"
            id="sidemenuNotifikasiReport">
            <i class="bi bi-envelope-open"></i>
            <span class="text-[15px] ml-4 text-gray-200">Notifikasi Report</span>
        </div>
    </a>
    <a href="{{ url('/notifikasi/report/approval') }}">
        <div class="sidemenu p-2.5 mt-3 flex items-center rounded-md px-4 cursor-pointer hover:bg-blue-600 text-white"
            id="sidemenuNotifikasiReportApproval">
            <i class="bi bi-file-earmark-arrow-up"></i>
            <span class="text-[15px] ml-4 text-gray-200">Report Approval</span>
        </div>
    </a>
    {{-- <div class="p-2.5 mt-3 flex items-center rounded-md px-4 cursor-pointer hover:bg-blue-600 text-white"
        onclick="dropdown();">
        <i class="bi bi-chat-left-text-fill"></i>
        <div class="flex justify-between w-full items-center">
            <span class="text-[15px] ml-4 text-gray-200">Chatbox</span>
            <span class="text-sm rotate-180" id="arrow">
                <i class="bi bi-chevron-down"></i>
            </span>
        </div>
    </div> --}}

    {{-- <div class="text-left text-sm font-thin mt-2 w-4/5 mx-auto text-gray-200" id="submenu">
        <h1 class="cursor-pointer p-2 hover:bg-blue-700 rounded md mt-1">Social</h1>
        <h1 class="cursor-pointer p-2 hover:bg-blue-700 rounded md mt-1">Personal</h1>
        <h1 class="cursor-pointer p-2 hover:bg-blue-700 rounded md mt-1">Friends</h1>
    </div> --}}

    <a href="/login">
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 cursor-pointer hover:bg-blue-600 text-white">
            <i class="bi bi-box-arrow-in-right"></i>
            <span class="text-[15px] ml-4 text-gray-200">Logout</span>
        </div>
    </a>
</div>
{{-- <script src="{{ asset('js/sidebar.js') }}"></script> --}}
<script>
    function openSidebar() {
        document.querySelector("#sidebar").classList.toggle("left-[-250px]");
        document.querySelector("#container").classList.toggle("ml-[250px]");
        $("#searchNavbar").width($("#content").width());
    }

    function closeSidebar() {
        document.querySelector("#sidebar").classList.add("left-[-250px]");
        document.querySelector("#container").classList.remove("ml-[250px]");
        $("#searchNavbar").width($("#content").width());
    }

    // function changeSideMenu(e, master) {
    //     let sidemenu = document.getElementsByClassName("sidemenu");
    //     for (let i = 0; i < sidemenu.length; i++) {
    //         sidemenu[i].classList.remove("bg-blue-600");
    //         let containerMaster = document.getElementsByClassName("containerMaster");
    //         for (let j = 0; j < containerMaster.length; j++) {
    //             containerMaster[j].classList.add("hidden");
    //         }
    //     }
    //     e.classList.add("bg-blue-600");
    //     if (document.getElementById(master).classList.contains("hidden")) {
    //         document.getElementById(master).classList.remove("hidden");
    //     }
    // }

    let url = window.location.href;
    var master = url;
    // alert(master);
    if (master.includes("master/user")) {
        document.getElementById("sidemenuUser").classList.add("bg-blue-600");
    } else if (master.includes("master/departemen")) {
        document.getElementById("sidemenuDepartemen").classList.add("bg-blue-600");
    } else if (master.includes("master/stall")) {
        document.getElementById("sidemenuStall").classList.add("bg-blue-600");
    }
    // else if (master.includes("master/level")) {
    //     document.getElementById("sidemenuLevel").classList.add("bg-blue-600");
    // }
    else if (master.includes("dashboard")) {
        document.getElementById("sidemenuDashboard").classList.add("bg-blue-600");
    } else if (master.includes("master/data")) {
        document.getElementById("sidemenuData").classList.add("bg-blue-600");
    } else if (master.includes("master/input")) {
        document.getElementById("sidemenuInput").classList.add("bg-blue-600");
    } else if (master.includes("process-entry")) {
        document.getElementById("sidemenuProcessEntry").classList.add("bg-blue-600");
    } else if (master.includes("notifikasi/report") && !master.includes("notifikasi/report/approval")) {
        document.getElementById("sidemenuNotifikasiReport").classList.add("bg-blue-600");
    } else if (master.includes("notifikasi/report/approval")) {
        document.getElementById("sidemenuNotifikasiReportApproval").classList.add("bg-blue-600");
    }
</script>
