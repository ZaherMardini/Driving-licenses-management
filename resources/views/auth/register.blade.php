@php
  use App\Models\Person;
  $searchBy = Person::searchBy();
  $searchRoutes = Person::$searchRoutes;
@endphp
<x-guest-layout>
  <x-custom.register-user>
    <x-custom.search 
      event_name="person-id-updated"
      :filter="false"
      :routes="$searchRoutes"
      :searchBy="$searchBy"
    />
    <x-custom.person-card mode="read"/>
  </x-custom.register-user>
</x-guest-layout>
