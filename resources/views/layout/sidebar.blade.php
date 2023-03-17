<sidebar>
  <div class="flex flex-col gap-3">
    <h3 class="font-bold mb-2">Menu</h3>
    <a href="{{ route('criterias.index') }}" class="py-3 border-b hover:bg-blue-100 {{ request()->is('/') ? 'font-bold text-blue-400' : '' }}">Data Kriteria</a>
    <a href="{{ route('alternatives.index') }}" class="py-3 border-b hover:bg-blue-100 {{ request()->is('alternatives*') ? 'font-bold text-blue-400' : '' }}">Data Alternatif</a>
    <a href="{{ route('rankings.index') }}" class="py-3 border-b hover:bg-blue-100 {{ request()->is('rankings*') ? 'font-bold text-blue-400' : '' }}">Perangkingan</a>
  </div>
</sidebar>