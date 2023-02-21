<tr class="border-2 border-collapse w-32 border-gray-300">
    @for ($i=0; $i<$level; $i++)
    <td class="border-2 border-collapse border-gray-300">
        <div data-tooltip-target="tooltip1"
            class="whitespace-nowrap text-ellipsis px-2 font-medium text-sm cursor-default w-32 overflow-hidden">

        </div>
    </td>
    @endfor
    <td class="border-2 border-collapse border-gray-300">
        <div data-tooltip-target="tooltip{{ $spk->spk_id }}"
            class="whitespace-nowrap text-ellipsis px-2 font-medium text-sm cursor-default w-32 overflow-hidden">
            {{ $spk->name }}
        </div>
        <div id="tooltip{{ $spk->spk_id }}" role="tooltip"
            class="absolute z-10 invisible inline-block px-3 py-1 font-medium text-white bg-gray-900 transition-opacity duration-300 rounded-lg shadow-sm opacity-0 tooltip text-lg max-w-[13rem]">
            {{ $spk->name }}
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </td>
    <td class="border-2 border-collapse border-gray-300">
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-5 py-2.5 text-center w-32">Tambah
        </button>
    </td>
    <td class="border-2 border-collapse border-gray-300">
        <button type="submit"
            class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium text-sm px-5 py-2.5 text-center w-32">Edit
        </button>
    </td>
    <td class="border-2 border-collapse border-gray-300">
        <button type="submit"
            class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium text-sm px-5 py-2.5 text-center w-32">Hapus
        </button>
    </td>
    <td
        class="border-2 border-collapse focus:ring-4 focus:outline-none font-medium text-sm px-5 py-2.5 text-center min-w-[8rem]">
        Level {{ $level }}
    </td>
</tr>
@foreach ($spk->children as $sp)
    <x-data-item :spk="$sp" :level="$level+1" />
@endforeach
