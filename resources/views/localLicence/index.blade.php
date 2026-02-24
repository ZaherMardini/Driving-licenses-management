@php
  use App\Global\ListOptions;
  // ListOptions::localLicence($appointment['local_licence_id'])
@endphp

<x-app-layout>
  <div x-data="{licence: ''}" @licence-id-updated.window = "licence = event.detail">
    <x-custom.search :filter="true" :searchBy="$searchBy" :routes="$searchRoutes"/>
    <x-custom.list
    :items="$items"
    :columns="$columns"
    />
  </div>
</x-app-layout>