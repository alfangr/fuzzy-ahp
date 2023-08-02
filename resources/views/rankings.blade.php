@extends('layout.app')

@section('content')
<main>
  <h3 class="font-bold mb-3">Menu Perangkingan</h3>

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
  
      @if($criterias->isNotEmpty())
        <div class="flex flex-col pt-3 first:pt-0">
          <h3 class="mb-2">Perbandingan Antar Kriteria</h3>
          <table class="shadow-lg bg-white border-collapse">
            <thead>
              <tr>
                <th class="border border-gray-400 text-left px-8 py-4"></th>
                @foreach($criterias as $criteria)
                <th class="bg-blue-100 border border-gray-400 text-center px-8 py-4">{{ $criteria->criteria_code }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach($criterias as $column_key => $criteria)
                <tr>
                  <td class="bg-blue-100 border border-gray-400 text-center px-8 py-4 font-bold">{{ $criteria->criteria_code }}</td>
                  @foreach($criterias as $row_key => $criteria)
                    @if($row_key < $column_key)
                    <td class="bg-gray-100 border text-center px-8 py-4">
                      <input class="w-5 h-auto text-center bg-gray-100" type="text" name="input[]" value="0" readonly />
                    </td>
                    @elseif($row_key > $column_key)
                    <td class="border text-center px-8 py-4">
                      <div class="relative">
                        <select class="block appearance-none w-full text-center bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="input[]">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                        </select>
                        <div class="absolute top-4 right-3">
                          <svg
                            class="w-3 h-3"
                            xmlns="http://www.w3.org/2000/svg"
                            width="1200"
                            height="1200"
                            x="0"
                            y="0"
                            version="1.1"
                            viewBox="0 0 1200 1200"
                            xmlSpace="preserve"
                          >
                            <path d="M600.006 989.352l178.709-178.709L1200 389.357l-178.732-178.709L600.006 631.91 178.721 210.648 0 389.369l421.262 421.262 178.721 178.721h.023z"></path>
                          </svg>
                        </div>
                      </div>
                    </td>
                    @else
                    <td class="bg-gray-100 border text-center px-8 py-4">
                      <input class="w-5 h-auto text-center bg-gray-100" type="text" name="input[]" value="1" readonly />
                    </td>
                    @endif
                  @endforeach
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        @foreach($criterias as $criteria)
        <div class="flex flex-col pt-3 first:pt-0">
          <h3 class="mb-2">Perbandingan Sub Kriteria - {{ $criteria->criteria_name }}</h3>
          <table class="shadow-lg bg-white border-collapse">
            <thead>
              <tr>
                <th class="border border-gray-400 text-left px-8 py-4"></th>
                @foreach($criteria->hasSubcriteria as $subcriteria)
                <th class="bg-blue-100 border border-gray-400 text-center px-8 py-4">{{ $subcriteria->subcriteria_code }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach($criteria->hasSubcriteria as $column_key => $subcriteria)
                <tr>
                  <td class="bg-blue-100 border border-gray-400 text-center px-8 py-4 font-bold">{{ $subcriteria->subcriteria_code }}</td>
                  @foreach($criteria->hasSubcriteria as $row_key => $subcriteria)
                    @if($row_key < $column_key)
                    <td class="bg-gray-100 border text-center px-8 py-4">
                      <input class="w-5 h-auto text-center bg-gray-100" type="text" name="sub_input_{{ $subcriteria->criteria_id }}[]" value="0" readonly />
                    </td>
                    @elseif($row_key > $column_key)
                    <td class="border text-center px-8 py-4">
                      <div class="relative">
                        <select class="block appearance-none w-full text-center bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="sub_input_{{ $subcriteria->criteria_id }}[]">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                        </select>
                        <div class="absolute top-4 right-3">
                          <svg
                            class="w-3 h-3"
                            xmlns="http://www.w3.org/2000/svg"
                            width="1200"
                            height="1200"
                            x="0"
                            y="0"
                            version="1.1"
                            viewBox="0 0 1200 1200"
                            xmlSpace="preserve"
                          >
                            <path d="M600.006 989.352l178.709-178.709L1200 389.357l-178.732-178.709L600.006 631.91 178.721 210.648 0 389.369l421.262 421.262 178.721 178.721h.023z"></path>
                          </svg>
                        </div>
                      </div>
                    </td>
                    @else
                    <td class="bg-gray-100 border text-center px-8 py-4">
                      <input class="w-5 h-auto text-center bg-gray-100" type="text" name="sub_input_{{ $subcriteria->criteria_id }}[]" value="1" readonly />
                    </td>
                    @endif
                  @endforeach
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @endforeach
      @endif
  
      <div class="flex flex-col pt-3 first:pt-0">
        <h3 class="mb-2">Daftar Alternatif</h3>
        <table class="shadow-lg bg-white border-collapse">
          <thead>
            <tr>
              <th class="bg-blue-100 border text-left px-8 py-4">Kode</th>
              <th class="bg-blue-100 border text-left px-8 py-4">Nama Alternatif</th>
            </tr>
          </thead>
          <tbody>
            @forelse($alternatives as $alternative)
              <tr>
                <td class="border px-8 py-4">{{ $alternative->alternative_code }}</td>
                <td class="border px-8 py-4">{{ $alternative->alternative_name }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="2" class="text-center border px-8 py-4">Belum ada data, <a href="{{ route('alternatives.index') }}" class="text-blue-400 hover:underline">isi data dahulu</a></td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
  
      @if($criterias->isNotEmpty() && $alternatives->isNotEmpty())
        <div class="flex flex-col pt-3 first:pt-0">
          <h3 class="mb-2">Bobot Nilai Sub-Kriteria</h3>
          <table class="shadow-lg bg-white border-collapse">
            <thead>
              <tr>
                <th rowspan="2" class="bg-blue-100 border text-left px-8 py-4">Bobot</th>
                @foreach($criterias as $criteria_weight)
                <th class="bg-blue-100 border text-left px-8 py-4">{{ $criteria_weight->criteria_name }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="border px-8 py-4">0.5</td>
                <td class="border px-8 py-4">0 - 1.000.000</td>
                <td class="border px-8 py-4">0 - 2 orang</td>
                <td class="border px-8 py-4">0 - 750.000</td>
                <td class="border px-8 py-4">0 - 1 orang</td>
              </tr>
              <tr>
                <td class="border px-8 py-4">0.75</td>
                <td class="border px-8 py-4">1.000.000 - 2.000.000</td>
                <td class="border px-8 py-4">2 - 4 orang</td>
                <td class="border px-8 py-4">750.000 - 1.500.000</td>
                <td class="border px-8 py-4">1 - 2 orang</td>
              </tr>
              <tr>
                <td class="border px-8 py-4">1</td>
                <td class="border px-8 py-4">> 2.000.000</td>
                <td class="border px-8 py-4">> 4 orang</td>
                <td class="border px-8 py-4">> 1.500.000</td>
                <td class="border px-8 py-4">> 2 orang</td>
              </tr>
            </tbody>
          </table>
        </div>
  
        <div class="flex flex-col pt-3 first:pt-0">
          <h3 class="mb-2">Input Bobot Nilai Kriteria untuk setiap Alternatif</h3>
          <table class="shadow-lg bg-white border-collapse">
            <thead>
              <tr>
                <th class="border text-left px-8 py-4"></th>
                @foreach($criterias as $criteria_input)
                <th class="bg-blue-100 border text-left px-8 py-4">{{ $criteria_input->criteria_name }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach($alternatives as $alternative)
                <tr>
                  <td class="border px-8 py-4">{{ $alternative->alternative_code }}</td>
                  <td class="border px-8 py-4">
                    <div class="relative">
                      <select class="block appearance-none w-full text-center bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="value">
                        <option value="">0 - 1.000.000</option>
                        <option value="">1.000.000 - 2.000.000</option>
                        <option value="">> 2.000.000</option>
                      </select>
                      <div class="absolute top-4 right-3">
                        <svg
                          class="w-3 h-3"
                          xmlns="http://www.w3.org/2000/svg"
                          width="1200"
                          height="1200"
                          x="0"
                          y="0"
                          version="1.1"
                          viewBox="0 0 1200 1200"
                          xmlSpace="preserve"
                        >
                          <path d="M600.006 989.352l178.709-178.709L1200 389.357l-178.732-178.709L600.006 631.91 178.721 210.648 0 389.369l421.262 421.262 178.721 178.721h.023z"></path>
                        </svg>
                      </div>
                    </div>
                  </td>
                  <td class="border px-8 py-4">
                    <div class="relative">
                      <select class="block appearance-none w-full text-center bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="value">
                        <option value="">0 - 2 orang</option>
                        <option value="">2 - 4 orang</option>
                        <option value="">> 4 orang</option>
                      </select>
                      <div class="absolute top-4 right-3">
                        <svg
                          class="w-3 h-3"
                          xmlns="http://www.w3.org/2000/svg"
                          width="1200"
                          height="1200"
                          x="0"
                          y="0"
                          version="1.1"
                          viewBox="0 0 1200 1200"
                          xmlSpace="preserve"
                        >
                          <path d="M600.006 989.352l178.709-178.709L1200 389.357l-178.732-178.709L600.006 631.91 178.721 210.648 0 389.369l421.262 421.262 178.721 178.721h.023z"></path>
                        </svg>
                      </div>
                    </div>
                  </td>
                  <td class="border px-8 py-4">
                    <div class="relative">
                      <select class="block appearance-none w-full text-center bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="value">
                        <option value="">0 - 750.000</option>
                        <option value="">750.000 - 1.500.000</option>
                        <option value="">> 1.500.000</option>
                      </select>
                      <div class="absolute top-4 right-3">
                        <svg
                          class="w-3 h-3"
                          xmlns="http://www.w3.org/2000/svg"
                          width="1200"
                          height="1200"
                          x="0"
                          y="0"
                          version="1.1"
                          viewBox="0 0 1200 1200"
                          xmlSpace="preserve"
                        >
                          <path d="M600.006 989.352l178.709-178.709L1200 389.357l-178.732-178.709L600.006 631.91 178.721 210.648 0 389.369l421.262 421.262 178.721 178.721h.023z"></path>
                        </svg>
                      </div>
                    </div>
                  </td>
                  <td class="border px-8 py-4">
                    <div class="relative">
                      <select class="block appearance-none w-full text-center bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="value">
                        <option value="">0 - 1 orang</option>
                        <option value="">1 - 2 orang</option>
                        <option value="">> 2 orang</option>
                      </select>
                      <div class="absolute top-4 right-3">
                        <svg
                          class="w-3 h-3"
                          xmlns="http://www.w3.org/2000/svg"
                          width="1200"
                          height="1200"
                          x="0"
                          y="0"
                          version="1.1"
                          viewBox="0 0 1200 1200"
                          xmlSpace="preserve"
                        >
                          <path d="M600.006 989.352l178.709-178.709L1200 389.357l-178.732-178.709L600.006 631.91 178.721 210.648 0 389.369l421.262 421.262 178.721 178.721h.023z"></path>
                        </svg>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
  
        <div class="pt-3">
          <button type="submit" class="w-full px-2 py-1 bg-green-500 font-bold text-white rounded-md">Mulai Proses Perankingan</button>
        </div>
      @endif
  
    </div>
  </form>
</main>
@endsection