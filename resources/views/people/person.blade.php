<x-app-layout>
  <div>
    @if ($mode !== 'new')
    <x-custom.search event_name="person-id-updated" :searchBy="$searchBy" :routes="$searchRoutes" :filter="false"/>
    @endif
    <x-custom.person-card :mode="$mode"/>
  </div>
</x-app-layout>