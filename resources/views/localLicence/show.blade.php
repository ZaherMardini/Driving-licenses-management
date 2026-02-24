<x-app-layout>
  <div>
    <x-custom.search event_name="licence-id-updated" :filter="false" :routes="$searchRoutes" :searchBy="$searchBy"/>
    <x-custom.local-licence-card mode="read"/>
  </div>
</x-app-layout>