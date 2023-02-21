@extends('main')

@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master Data</h1>

    <div class="overflow-x-auto">
        <table class="border-2 border-collapse border-gray-300">
            <tr class="border-2 border-collapse w-32 border-gray-300">
                <td class="border-2 border-collapse border-gray-300">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-5 py-2.5 text-center w-32">Tambah
                    </button>
                </td>
            </tr>
            @foreach ($spks as $spk)
                <tr class="border-2 border-collapse w-32 border-gray-300">
                    <td class="">
                        <button type="submit"
                            class="text-white bg-white hover:bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-5 py-2.5 text-center w-32">
                        </button>
                    </td>
                </tr>
                <x-data-item :spk="$spk" :level=0></x-data-item>
            @endforeach
        </table>
    </div>
@endsection
