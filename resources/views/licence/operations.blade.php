<x-app-layout>
  <div class="flex gap-3 flex-wrap justify-center m-5">
    <x-driving-licence-card :licence="$licence"/>
    <x-custom.detain-release-licence :licence="$licence"/>
    <x-custom.licence-replacement :licence="$licence"/>
    <x-custom.renew-licence :licence="$licence"/>
  </div>
</x-app-layout>