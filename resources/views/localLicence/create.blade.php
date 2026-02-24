<x-app-layout>
  <div>
    <x-custom.search event_name="person-id-updated" :searchBy="$searchBy" :filter="false" :routes="$searchRoutes"/>
    <x-custom.local-licence-card :mode="$mode"/>
  </div>
</x-app-layout>