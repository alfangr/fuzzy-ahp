@extends('layout.app')

@section('content')
<main>
<h3 class="font-bold mb-3">Hasil Perangkingan</h3>

<form action="{{ route('rankings.do') }}" method="POST">
    @csrf
    <div class="flex flex-col gap-5 divide-y-2">

        <div class="flex flex-col pt-3 first:pt-0">
            <h3 class="mb-2">Daftar Kriteria</h3>
            <table class="shadow-lg bg-white border-collapse">
                <thead>
                    <tr>
                        <th class="bg-blue-100 border text-left px-8 py-4">Kode</th>
                        <th class="bg-blue-100 border text-left px-8 py-4">Nama Kriteria</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($criterias as $criteria)
                    <tr>
                        <td class="border px-8 py-4">{{ $criteria->criteria_code }}</td>
                        <td class="border px-8 py-4">{{ $criteria->criteria_name }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center border px-8 py-4">Belum ada data, <a href="{{ route('criterias.index') }}" class="text-blue-400 hover:underline">isi data dahulu</a></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-col pt-3 first:pt-0">
            <h3 class="mb-2">Inputan Nilai Perbandingan Antar Kriteria</h3>
            <table class="shadow-lg bg-white border-collapse">
                <thead>
                <tr>
                    <th class="border border-gray-400 text-left px-8 py-4"></th>
                    @foreach($inputCriterias as $key => $result)
                    <th class="bg-blue-100 border border-gray-400 text-center px-8 py-4">{{ 'C' . ++$key }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($inputCriterias as $inputCriteria)
                        <tr>
                            <td class="bg-blue-100 border border-gray-400 text-center px-8 py-4 font-bold">{{ 'C' . $no++ }}</td>
                            @foreach($inputCriteria as $key => $cell)
                            <td class="bg-gray-100 border text-center px-8 py-4">{{ $cell }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex flex-col pt-3 first:pt-0">
            <h3 class="mb-2">Konversi Nilai Perbandingan Antar Kriteria</h3>
            <table class="shadow-lg bg-white border-collapse">
                <thead>
                    <tr>
                        <th rowspan="2" class="border border-gray-400 text-left px-8 py-4"></th>
                        @foreach($inputCriterias as $key => $result)
                        <th colspan="3" class="bg-blue-100 border border-gray-400 text-center px-8 py-4">{{ 'C' . ++$key }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach($inputCriterias as $key => $result)
                        <th class="bg-blue-100 border border-gray-400 text-center px-8 py-2">L</th>
                        <th class="bg-blue-100 border border-gray-400 text-center px-8 py-2">M</th>
                        <th class="bg-blue-100 border border-gray-400 text-center px-8 py-2">U</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach($conversionCriterias as $conversionCriteria)
                    <tr>
                        <td class="bg-blue-100 border border-gray-400 text-center px-8 py-4 font-bold">{{ 'C' . $no++ }}</td>
                        @foreach($conversionCriteria as $cell)
                        <td class="bg-gray-100 border text-center px-8 py-4">{{ $cell }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</form>
</main>
@endsection