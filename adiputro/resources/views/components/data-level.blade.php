<div class="w-full">
    <div class="flex justify-between">
        <div class="flex items-center">
            <a class="sidemenuDashboard hover:bg-gray-200 flex items-center pl-4 text-sm py-2 text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-gray-900 transition duration-300 ease-in-out cursor-pointer min-w-[150px]"
                data-mdb-ripple="true" data-mdb-ripple-color="dark" id="sidemenuDashboard{{ $item->item_level_id }}"
                data-bs-toggle="collapse" onclick="updateLevelData({{ $item->item_level_id }});selectDashboard(this)"
                data-bs-target="#collapseSidenavEx1" aria-expanded="true" aria-controls="collapseSidenavEx1">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3 mr-3" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor"
                        d="M216 0h80c13.3 0 24 10.7 24 24v168h87.7c17.8 0 26.7 21.5 14.1 34.1L269.7 378.3c-7.5 7.5-19.8 7.5-27.3 0L90.1 226.1c-12.6-12.6-3.7-34.1 14.1-34.1H192V24c0-13.3 10.7-24 24-24zm296 376v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h146.7l49 49c20.1 20.1 52.5 20.1 72.6 0l49-49H488c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z">
                    </path>
                </svg>
                <span class="text-gray-700 font-medium text-lg">{{ $item->name }}</span>


                @php
                    $count = 0;
                @endphp
                @foreach ($item->children as $itl)
                    @php
                        $count++;
                    @endphp
                @endforeach
                @if ($count > 0)
                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                        class="rounded-md w-6 h-6 ml-2 bg-gray-200 hover:bg-gray-400 cursor-pointer -rotate-90"
                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                        id="btnDown{{ $item->item_level_id }}"
                        onclick="openMenu('sideNav{{ $item->item_level_id }}', 'btnDown{{ $item->item_level_id }}')">
                        <path fill="currentColor"
                            d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z">
                        </path>
                    </svg>
                @endif
            </a>
        </div>

        <div class="flex">
            <button onclick="tambah('{{ $item->item_level_id }}', '{{ $item->name }}', '{{ $level }}');"
                type="submit"
                class="mr-2 w-10 h-10 flex items-center justify-center text-white bg-blue-500 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                    <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <style>
                        svg {
                            fill: #ffffff
                        }
                    </style>
                    <path
                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                </svg>
            </button>

            <form action="/master/data/update" method="get" class="mr-2">
                <div>
                    <input type="text" class="hidden" value="{{ $item->item_level_id }}" name="item_level_id">
                    <button type="submit"
                        class="w-10 h-10 flex items-center justify-center text-white bg-yellow-500 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-300 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                            <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                svg {
                                    fill: #ffffff
                                }
                            </style>
                            <path
                                d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                        </svg>
                    </button>


                </div>
            </form>
            <form action="/master/data/delete" method="post">
                <div>
                    @csrf
                    <input type="text" class="hidden" value="{{ $item->item_level_id }}" name="item_level_id">
                    <div onclick="confirmDelete({{ $item->item_level_id }})"
                        class="w-10 h-10 flex items-center justify-center text-white bg-red-500 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                            <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <style>
                                svg {
                                    fill: #ffffff
                                }
                            </style>
                            <path
                                d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                        </svg>


                    </div>
                    <button type="submit" id="btnDelete{{ $item->item_level_id }}"></button>
                </div>
            </form>
            <div class="focus:ring-4 focus:outline-none px-5 py-2.5 text-center min-w-[8rem] text-gray-700 font-medium text-lg">
                Level {{ $level }}
            </div>
        </div>
    </div>
    <hr class="my-2 border-t-2 border-gray-200">

    <div class="pl-6 hidden" id="sideNav{{ $item->item_level_id }}">
        @foreach ($item->children as $item)
            <x-data-level :item="$item" :level="$level + 1" :max="$max" />
        @endforeach
    </div>
</div>
