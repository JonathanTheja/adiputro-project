<!-- Dropdown menu -->
<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="multiLevelDropdownButton">
    <li class="flex">
        <button id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown{{ $item->item_level_id }}"
            data-dropdown-placement="right-start" type="button"
            class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">LV
            {{ $level }} {{ $item->name }}
            @if (count($item->children) > 0)
                <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            @endif
        </button>
        <div id="doubleDropdown{{ $item->item_level_id }}"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
            @foreach ($item->children as $it)
                <x-menu-item :item="$it" :level="$level + 1"></x-menu-item>
            @endforeach
        </div>
    </li>
    <li class="flex">
        <button onclick="tambah('{{ $item->item_level_id }}', '{{ $item->name }}', '{{ $level }}');"
            type="submit"
            class="text-white bg-blue-700 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-5 py-2.5 text-center max-w-32 rounded-lg">Tambah
        </button>
        <form action="/master/data/update" method="get" class="m-0">
            <input type="text" class="hidden" value="{{ $item->item_level_id }}" name="item_level_id">
            <button type="submit"
                class="text-white bg-yellow-600 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium text-sm px-5 py-2.5 text-center rounded-xl">Edit
            </button>
        </form>
        <form action="/master/data/delete" method="post" class="m-0">
            @csrf
            <input type="text" class="hidden" value="{{ $item->item_level_id }}" name="item_level_id">
            <div onclick="confirmDelete({{ $item->item_level_id }})"
                class="text-white bg-red-700 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium text-sm px-5 py-2.5 text-center max-w-32 cursor-pointer rounded-xl">
                Hapus
            </div>
            <button type="submit" id="btnDelete{{ $item->item_level_id }}"></button>
        </form>
    </li>
</ul>
