@extends('layout.app')

@section('content')
<main>
  <h3 class="font-bold mb-2">Data Kriteria</h3>

  <div class="flex flex-col">
    <form action="{{ route('criterias.store') }}" method="POST" class="flex flex-row gap-3">
      @csrf
      <input type="text" class="px-3 py-1 border border-black rounded" name="criteria_name" placeholder="Tambahkan kriteria..." />
      <div class="flex flex-row gap-3">
        <button type="submit" class="px-2 py-1 bg-blue-400 rounded-md">Tambah</button>
        <button type="button" class="px-2 py-1 bg-red-400 rounded-md">Reset Data</button>
      </div>
    </form>
    <table class="shadow-lg bg-white border-collapse mt-5">
      <thead>
        <tr>
          <th class="bg-blue-100 border text-left px-8 py-4">Kode</th>
          <th class="bg-blue-100 border text-left px-8 py-4">Nama Kriteria</th>
          <th class="bg-blue-100 border text-left px-8 py-4">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($criterias as $criteria)
          <tr>
            <td class="border px-8 py-4">{{ $criteria->criteria_code }}</td>
            <td class="border px-8 py-4">{{ $criteria->criteria_name }}</td>
            <td class="border px-8 py-4">
              <div class="flex flex-row gap-3">
                <a href="#" class="px-2 py-1 bg-blue-400 rounded-md">Edit</a>
                <form action="{{ route('criterias.destroy', $criteria->id) }}" method="POST">
                  @method('delete')
                  @csrf
                  <button type="submit" class="px-2 py-1 bg-red-400 rounded-md">Hapus</button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="3" class="text-center border px-8 py-4">Belum ada data</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</main>
@endsection