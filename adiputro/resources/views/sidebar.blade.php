<span class="fixed text-white text-4xl top-5 left-4 cursor-pointer" onclick="Open();" id="openSidebar">
    <i class="bi bi-filter-left py-1 px-2 bg-gray-900 rounded-md"></i>
</span>
<div
    class="sidebar fixed top-0 bottom-0 lg:left-0 p-2 w-250px left-[-250px] overflow-y-auto text-center bg-gray-900 duration-300">
    <div class="text-gray-100 text-xl">
        <div class="p-2.5 mt-1 flex items-center">
            <div class="justify-center w-full">
                <img class="mx-auto w-48 bg-white rounded-md" src={{ asset('img/adiputro_logo.svg') }} alt="logo"
                    style="width:80px;height:80px" />
                {{-- <h1 class="text-lg font-semibold mt-1 mb-12 pb-1">ADIPUTRO</h1> --}}
            </div>
            <i class="absolute bi bi-x ml-48 cursor-pointer lg:hidden bg-blue-600 px-1 rounded-md"
                onclick="Open();"></i>
        </div>
        <hr class="my-2 text-gray-600">
    </div>
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-gray-700 text-white">
        <i class="bi bi-search text-sm"></i>
        <input type="text" placeholder="Search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none">
    </div>
    <div class="sidemenu p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white"
        onclick="changeSideMenu(this)">
        <i class="bi bi-people"></i>
        <span class="text-[15px] ml-4 text-gray-200">Master User</span>
    </div>
    <div class="sidemenu p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white"
        onclick="changeSideMenu(this)">
        <i class="bi bi-people"></i>
        <span class="text-[15px] ml-4 text-gray-200">Master Departemen</span>
    </div>
    <div class="sidemenu p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white"
        onclick="changeSideMenu(this)">
        <i class="bi bi-people"></i>
        <span class="text-[15px] ml-4 text-gray-200">Master Stall</span>
    </div>
    <div class="sidemenu p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white"
        onclick="changeSideMenu(this)">
        <i class="bi bi-people"></i>
        <span class="text-[15px] ml-4 text-gray-200">Master Level</span>
    </div>
    <hr class="my-4 text-gray-600">
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white"
        onclick="dropdown();">
        <i class="bi bi-chat-left-text-fill"></i>
        <div class="flex justify-between w-full items-center">
            <span class="text-[15px] ml-4 text-gray-200">Chatbox</span>
            <span class="text-sm rotate-180" id="arrow">
                <i class="bi bi-chevron-down"></i>
            </span>
        </div>
    </div>

    <div class="text-left text-sm font-thin mt-2 w-4/5 mx-auto text-gray-200" id="submenu">
        <h1 class="cursor-pointer p-2 hover:bg-blue-700 rounded md mt-1">Social</h1>
        <h1 class="cursor-pointer p-2 hover:bg-blue-700 rounded md mt-1">Personal</h1>
        <h1 class="cursor-pointer p-2 hover:bg-blue-700 rounded md mt-1">Friends</h1>
    </div>

    <a href="/login">
        <div
            class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
            <i class="bi bi-box-arrow-in-right"></i>
            <span class="text-[15px] ml-4 text-gray-200">Logout</span>
        </div>
    </a>

    <script type="text/javascript">
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

        function changeSideMenu(e) {
            let sidemenu = document.getElementsByClassName("sidemenu");
            for (let i = 0; i < sidemenu.length; i++) {
                sidemenu[i].classList.remove("bg-blue-600");
            }
            e.classList.add("bg-blue-600");
        }
    </script>
</div>
