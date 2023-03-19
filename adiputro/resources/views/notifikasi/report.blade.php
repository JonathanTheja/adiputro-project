@extends('main')
@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Notifikasi Report</h1>

    <div class="text-gray-900">
        <div class="p-4 flex">
            <h1 class="text-3xl">
                Daftar Report
            </h1>
        </div>
        <div class="py-4 flex justify-start overflow-x-auto">
            <table class="w-full text-md bg-white shadow-md rounded mb-4">
                <tbody>
                    <tr class="border-b">
                        <th class="text-left p-2">Nomor Laporan</th>
                        <th class="text-left p-2 w-32">Tanggal</th>
                        <th class="text-left p-2">Pelapor</th>
                        <th class="text-left p-2">Departemen</th>
                        <th class="text-left p-2">Kategori</th>
                        <th class="text-left p-2">Jenis</th>
                        <th class="text-left p-2">Temuan</th>
                        <th class="text-left p-2">Reply</th>
                        <th class="text-left p-2 w-32">Diselesaikan Tanggal</th>
                        <th class="text-left p-2">Oleh</th>
                    </tr>
                    @foreach ($form_reports as $form_report)
                        <tr class="border-b hover:bg-orange-100 bg-gray-100 text-md">
                            <td class="p-2 py-4 whitespace-nowrap"><a class="hover:bg-blue-200" href="/dashboard/{{ $form_report->item_level_id }}">{{ $form_report->nomor_laporan }}</a>
                            </td>
                            <td class="p-2 py-4">{{ date('d-m-Y h:i A', strtotime($form_report->tanggal)) }}
                            </td>
                            <td class="p-2 py-4">{{ $form_report->pelapor->full_name }}</td>
                            <td class="p-2 py-4">{{ $form_report->pelapor->department->name }}</td>
                            <td class="p-2 py-4">{{ $form_report->kategori_report->name }}</td>
                            <td class="p-2 py-4">{{ $form_report->jenis }}</td>
                            <td class="p-2 py-4">{{ $form_report->temuan }}</td>

                            @if (isset($form_report->tanggal_diselesaikan))
                                <td class="p-2 py-4">{{ $form_report->reply }}</td>
                                <td class="p-2 py-4">
                                    @if (isset($form_report->tanggal_diselesaikan))
                                        {{ date('d-m-Y h:i A', strtotime($form_report->tanggal_diselesaikan)) }}
                                    @endif
                                </td>
                                <td class="p-2 py-4">
                                    @if (isset($form_report->penyelesai->full_name))
                                        {{ $form_report->penyelesai->full_name }}
                                    @endif
                                </td>
                            @else
                                <form action="/notifikasi/report/update" method="POST">
                                    @csrf
                                    <input class="hidden" type="text" name="form_report_id"
                                        value="{{ $form_report->form_report_id }}">
                                    <td class="p-2 py-4"><input type="text"
                                            class="bg-transparent border w-20 border-black border-collapse" name="reply">
                                    </td>
                                    <td class="p-2 py-4 ">
                                        <button type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium px-1 py-2.5 text-center max-w-32 cursor-pointer w-full">Update</button>
                                    </td>
                                </form>
                                <td class="p-2 py-4 bg-yellow-700 text-center text-white">Dalam Proses..</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
