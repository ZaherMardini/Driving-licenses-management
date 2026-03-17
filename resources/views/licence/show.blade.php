<x-app-layout>
  <div class="flex flex-col gap-5"
  x-data="{
    licence: @js($licence),
    serviceId:'3',
    get route() { return `/licence/${this.licence?.id}/operations` },  
    get action(){ return `/licenceOperationApplication/${this.licence?.id}/${this?.serviceId}` },
  }"
  @licence-card-updated.window="licence = event.detail; route"
  >
    <div class="flex flex-col items-center w-full">
      <h1 class="text-white text-xl font-bold m-5">
        Recent issued licence for <span class="text-cyan-300">{{ $licence['person']['name'] }}</span>
      </h1>
      <x-custom.search
      event_name="licence-card-updated"
      :filter="false"
      :routes="$routes"
      :searchBy="$searchBy"
      />
      <x-driving-licence-card id="licence"  :licence="$licence"/>
      <div id="options" class="m-3">
        <div id="selectionSubmit" class="flex gap-5 m-3">
          <form x-bind:action="action" method="post">
            @csrf
            <input type="hidden" name="licence_id" value="{{ $licence['id'] }}">
            <x-input-error :messages="$errors->get('licence_id')"/>
            <x-input-error :messages="$errors->get('licence_action')"/>
              <select
                name="service_type"
                x-model="serviceId"
                class="inline-flex items-center justify-center text-white bg-[#1e2838] shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5">
                  <option value="0" disabled selected>Select Licence service</option>
                  <option value="{{ $renew }}">Renew</option>
                  <option value="{{ $lost }}">Lost</option>
                  <option value="{{ $damaged }}">Damaged</option>
                  <option value="{{ $release }}">Release</option>
              </select>
              <button
                class="cursor-pointer text-white bg-[#1e2838] shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5"
                type="submit">Submit Application
              </button>
          </form>
        </div>
        <div id="pdfOperations" class="flex gap-5 m-3">
          <a
            x-bind:href="route"
            class="text-center p-2.5 rounded-md bg-[#3b82f6] text-white font-bold">
            Licence operations
          </a>
          <button
            id="btn"
            class="cursor-pointer rounded-md w-fit bg-red-500 text-white font-medium p-2.5 hover:bg-red-400 transition"
            onclick="downloadPDF()">
            Download Licence pdf
          </button>
        </div>
      </div>
    </div>
    <div>
      <h1 class="text-white text-xl font-bold m-5">Licence history</h1>
      <x-custom.search
      :filter="true"
      :routes="$routes"
      :searchBy="$searchBy"
      />
      <div>
        <x-custom.list :columns="$columns" :items="$licences"/>
      </div>
    </div>
  </div>
  <script>
    function downloadPDF() {
      const element = document.getElementById("licence");
      html2canvas(element, {
        backgroundColor: null,
        useCORS: true,
      }).then(canvas => {
          const imgData = canvas.toDataURL("image/png");
          const pdf = new jspdf.jsPDF();
          pdf.addImage(imgData, 'PNG', 10, 10);
          pdf.save("licence.pdf");
        });
    }
  </script>
</x-app-layout>