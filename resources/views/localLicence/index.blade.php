<x-app-layout>
  {{-- {{ dd($items->toArray()) }} --}}
  <x-custom.list
    :enableSearch="false"
    :columns="$columns"
    :items="$items"
  />
</x-app-layout>