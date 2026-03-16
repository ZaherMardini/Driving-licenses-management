<x-app-layout>
  <div class="flex gap-3 flex-wrap justify-center m-5">
    <x-driving-licence-card :licence="$licence"/>
    <x-custom.detain-release-licence :licence="$licence" :services="$services" :fines="$fines"/>
    <x-custom.licence-replacement :licence="$licence" :services="$services" :fines="$fines"/>
    <x-custom.renew-licence :licence="$licence" :services="$services" :fines="$fines"/>
  </div>
</x-app-layout>