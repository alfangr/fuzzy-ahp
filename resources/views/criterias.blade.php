@extends('layout.app')

@section('content')
<main>
  <h3 class="font-bold mb-2">Data Kriteria</h3>

  <div class="flex flex-col">
    <div class="flex flex-row justify-between">
      <form action="{{ route('criterias.store') }}" method="POST" class="flex flex-row gap-3">
        @csrf
        <input type="text" class="px-3 py-1 border border-black rounded" name="criteria_name" placeholder="Tambahkan kriteria..." />
        <div class="flex flex-row gap-3">
          <button type="submit" class="px-2 py-1 bg-blue-400 rounded-md">Tambah</button>
          <button type="button" class="px-2 py-1 bg-red-400 rounded-md">Reset Data</button>
        </div>
      </form>
      <div class="flex flex-row gap-3">
        <input type="text" id="input-filter" class="px-3 py-1 border border-black rounded" placeholder="Masukkan filter..." />
        <div class="flex flex-row gap-3">
          <button type="button" id="btn-filter" class="px-2 py-1 bg-blue-400 rounded-md" onclick="showRows()">Filter</button>
          <button type="button" class="px-2 py-1 bg-red-400 rounded-md" onclick="printTableToPDF()">Print</button>
        </div>
      </div>
    </div>
    <table id="criteria-table" class="shadow-lg bg-white border-collapse mt-5">
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

@section('extra-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  window.jsPDF = window.jspdf.jsPDF;
  window.html2canvas = html2canvas;
  
  function showRows() {
    var inputFilter = document.getElementById('input-filter');
    var table = document.getElementById("criteria-table");
    var rows = table.getElementsByTagName("tr");
    
    for (var i = 0; i < rows.length; i++) {
      if (i <= inputFilter.value) {
        rows[i].style.display = ""; // Show the row
      } else {
        rows[i].style.display = "none"; // Hide the row
      }
    }
  }

  function printTableToPDF() {
    var table = document.getElementById("criteria-table");
    var pdf = new jsPDF();

    pdf.html(table, {
      callback: function(pdf) {
          // Save the PDF
          pdf.save('sample-document.pdf');
      },
        x: 15,
        y: 15,
        width: 170, //target width in the PDF document
        windowWidth: 650 //window width in CSS pixels
      });
    }
</script>
@endsection