@extends('main')
@section('container')
    <div style="position: relative; transition: opacity 0.3s ease;">
        <div style="position:absolute;top:10px;left:0;">
            <a href="{{ url('/home') }}">
                <button id="arrowBackBtn" class="flex items-center justify-center w-20 h-10" onclick="">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-900" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="text-gray-900">Kembali</span>
                </button>
            </a>
        </div>
    </div>

    <h1 class="text-center text-5xl font-semibold mb-8">DAFTAR INDUK DOKUMEN</h1>

    <table class="min-w-full border border-collapse">
        <thead>
            <tr>
                <th class="border border-gray-400 px-4 py-2">NO DOKUMEN</th>
                <th class="border border-gray-400 px-4 py-2">NAMA DOKUMEN</th>
                <th class="border border-gray-400 px-4 py-2">REVISI</th>
                <th class="border border-gray-400 px-4 py-2">TANGGAL TERBIT</th>
                <th class="border border-gray-400 px-4 py-2">LEVEL</th>
                <th class="border border-gray-400 px-4 py-2">DETAIL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border border-gray-400 px-4 py-2">AP/TI/1001</td>
                <td class="border border-gray-400 px-4 py-2">PEMBUATAN LIS TRAP JUMBO</td>
                <td class="border border-gray-400 px-4 py-2">0</td>
                <td class="border border-gray-400 px-4 py-2">4 MARET 2021</td>
                <td class="border border-gray-400 px-4 py-2">BUS/SDD/SUB ASSEMBLY</td>
                <td class="border border-gray-400 px-4 py-2"><a href="" class="text-blue-500 underline">CEK</a>
                </td>
            </tr>
            <tr>
                <td class="border border-gray-400 px-4 py-2">AP/TI/1001</td>
                <td class="border border-gray-400 px-4 py-2">PEMBUATAN LIS TRAP JUMBO</td>
                <td class="border border-gray-400 px-4 py-2">1</td>
                <td class="border border-gray-400 px-4 py-2">7 MARET 2021</td>
                <td class="border border-gray-400 px-4 py-2">BUS/SDD/SUB ASSEMBLY</td>
                <td class="border border-gray-400 px-4 py-2"><a href="" class="text-blue-500 underline">CEK</a>
                </td>
            </tr>

        </tbody>
    </table>
@endsection
