@extends("main")

@section("container")
<h1 class="text-center text-5xl font-semibold mb-4">Master Process Entry</h1>

<div id="pe_tables" class="my-10">
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            <div class="overflow-auto">
              <table class="min-w-full text-left text-sm font-light table-auto">
                <thead class="border-b font-medium dark:border-neutral-500">
                  <tr>
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Process Number</th>
                    <th class="px-6 py-4">Stall Number</th>
                    <th class="px-6 py-4">Work Description</th>
                    <th class="px-6 py-4">PIC</th>
                    <th class="px-6 py-4">SPK TYPE</th>
                    <th class="px-6 py-4">Departemen</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Timestamp</th>
                    <th class="px-6 py-4">Komponen</th>
                    <th class="px-6 py-4">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($process_entries as $process_entry)
                 <tr class="border-b dark:border-neutral-500">
                    <td class="px-6 py-4 font-medium">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">{{ $process_entry->process_number }}</td>
                    <td class="px-6 py-4">{{ $process_entry->stall_number }}</td>
                    <td class="px-6 py-4">{{ $process_entry->work_description }}</td>
                    <td class="px-6 py-4">{{ $process_entry->pic}}</td>
                    <td class="px-6 py-4">{{ $process_entry->spk_type}}</td>
                    <td class="px-6 py-4">{{ $department}}</td>
                    <td class="px-6 py-4">{{ $process_entry->spk_type}}</td>
                    <td class="px-6 py-4">{{ $process_entry->spk_type}}</td>
                    <td class="px-6 py-4">{{ $process_entry->spk_type}}</td>
                    <td class="px-6 py-4">
                        <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Hapus</button>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</div>

<div id="form-process">
    <h1 class="text-xl text-gray-800 my-5">Form Process Entry</h1>
    <form action="{{ url('doRegister') }}" method="POST">
        @csrf
        <div class="mb-6">
            <label for="process_name" class="block mb-2 text-sm font-medium text-gray-900">Process Name</label>
            <input type="text" name="process_name" id="process_name"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Process Name" required>
            @error('process_name')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-6">
            <label for="process_number" class="block mb-2 text-sm font-medium text-gray-900">Process Number</label>
            <input type="text" name="process_number" id="process_number"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Process Number" required>
            @error('process_number')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-6">
            <label for="stall_number" class="block mb-2 text-sm font-medium text-gray-900">Stall Number</label>
            <input type="text" name="stall_number" id="stall_number"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Stall Number" required>
            @error('stall_number')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-6">
            <label for="work_description" class="block mb-2 text-sm font-medium text-gray-900">Work Description</label>
            <input type="text" name="work_description" id="work_description"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Work description" required>
            @error('work_description')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-6">
            <label for="pic" class="block mb-2 text-sm font-medium text-gray-900">PIC</label>
            <input type="text" name="pic" id="pic"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="PIC" required>
            @error('pic')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-6">
            <label for="skp_type" class="block mb-2 text-sm font-medium text-gray-900">SKP TYPE</label>
            <input type="text" name="skp_type" id="skp_type"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="SKP Type" required>
            @error('skp_type')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-6">
            <label for="departemen" class="block mb-2 text-sm font-medium text-gray-900">Departemen</label>
            <input type="text" name="departemen" id="departemen"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Departemen" required>
            @error('departemen')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-6">
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
            <input type="text" name="status" id="status"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Status" required>
            @error('status')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-6">
            <label for="timestamp" class="block mb-2 text-sm font-medium text-gray-900">Timestamp</label>
            <input type="text" name="timestamp" id="timestamp"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Timestamp" required>
            @error('timestamp')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>


        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Tambah
            process entry baru</button>
    </form>
</div>

@endsection
