<tr class="border-2 border-collapse w-32 border-gray-300">
    @for ($i = 0; $i < $level; $i++)
        <td class="border-2 border-collapse border-gray-300">
            <div data-tooltip-target="tooltip1"
                class="whitespace-nowrap text-ellipsis px-2 font-medium text-sm cursor-default w-32 overflow-hidden">

            </div>
        </td>
    @endfor
    <td class="border-2 border-collapse border-gray-300">
        <div data-tooltip-target="tooltip{{ $item->item_level_id }}"
            class="whitespace-nowrap text-ellipsis px-2 font-medium text-sm cursor-default w-32 overflow-hidden">
            {{ $item->name }}
        </div>
        <div id="tooltip{{ $item->item_level_id }}" role="tooltip"
            class="absolute z-10 invisible inline-block px-3 py-1 font-medium text-white bg-gray-900 transition-opacity duration-300 rounded-lg shadow-sm opacity-0 tooltip text-lg max-w-[13rem]">
            {{ $item->name }}
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </td>
    <td class="border-2 border-collapse border-gray-300">
        <button onclick="tambah('{{ $item->item_level_id }}', '{{ $item->name }}', '{{ $level }}');" type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-5 py-2.5 text-center w-32">Tambah
        </button>
    </td>
    <form action="/master/data/update" method="get">
        <td class="border-2 border-collapse border-gray-300">
            {{-- <button onclick="update('{{ $item->item_level_id }}', '{{ $item->name }}', '{{ $level }}');" type="submit"
                class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium text-sm px-5 py-2.5 text-center w-32">Edit
            </button> --}}
            <input type="text" class="hidden" value="{{ $item->item_level_id }}" name="item_level_id">
            <button type="submit"
                class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium text-sm px-5 py-2.5 text-center w-32">Edit
            </button>
        </td>
    </form>
    <form action="/master/data/delete" method="post">
        <td class="border-2 border-collapse border-gray-300">
            @csrf
            <input type="text" class="hidden" value="{{ $item->item_level_id }}" name="item_level_id">
            <div onclick="confirmDelete({{ $item->item_level_id }})"
                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium text-sm px-5 py-2.5 text-center w-32 cursor-pointer">Hapus
            </div>
            <button type="submit" id="btnDelete{{ $item->item_level_id }}"></button>
        </td>
    </form>
    <td
        class="border-2 border-collapse focus:ring-4 focus:outline-none font-medium text-sm px-5 py-2.5 text-center min-w-[8rem]">
        Level {{ $level }}
    </td>
</tr>
@foreach ($item->children as $it)
    <x-data-item :item="$it" :level="$level + 1" />
@endforeach
