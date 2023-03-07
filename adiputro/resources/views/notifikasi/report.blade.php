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
                        <th class="text-left p-2">Temuan</th>
                        <th class="text-left p-2">Reply</th>
                        <th class="text-left p-2 w-32">Diselesaikan Tanggal</th>
                        <th class="text-left p-2">Oleh</th>
                    </tr>
                    @foreach ($form_reports as $form_report)
                        <tr class="border-b hover:bg-orange-100 bg-gray-100 text-md">
                            <td class="p-2 py-4 whitespace-nowrap">{{ $form_report->nomor_laporan }}</td>
                            <td class="p-2 py-4">{{ date('d-m-Y h:i A', strtotime($form_report->tanggal)) }}
                            </td>
                            <td class="p-2 py-4">{{ $form_report->pelapor->full_name }}</td>
                            <td class="p-2 py-4">{{ $form_report->pelapor->department->name }}</td>
                            <td class="p-2 py-4">{{ $form_report->kategori_report->name }}</td>
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
                                <td colspan="3" class="text-center bg-yellow-700 text-white">Dalam Proses..</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
