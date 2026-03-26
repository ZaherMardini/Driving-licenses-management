<x-app-layout>
  <x-custom.register-user>
    <x-custom.search 
      event_name="person-id-updated"
      :filter="false"
      :routes="$searchRoutes"
      :searchBy="$searchBy"
    />
    <x-custom.person-card mode="read"/>
  </x-custom.register-user>
</x-app-layout>