<x-app-layout>
  <div class="flex flex-col gap-5"
  x-data="{
    licence: @js($licence),
    test:'',
    get route() { return `/licence/${this.licence?.id}/operations` },  
    get action(){ return `/licenceOperationApplication/${this.licence?.id}/${this?.test}` },
  }"
  @licence-card-updated.window="licence = event.detail; route"
  >
    <div class="flex flex-col items-center w-full">
      <h1 class="text-white text-xl font-bold m-5">Recent issued licence</h1>
      <x-custom.search
      event_name="licence-card-updated"
      :filter="false"
      :routes="$routes"
      :searchBy="$searchBy"
      />
      <x-driving-licence-card id="licence"  :licence="$licence" :hideOperationsButton="false"/>
      {{-- <x-custom.dropdown-button :enableNamedRoutes="false" :title="$menu['title']" :menuItems="$menu['options']"/> --}}
      <form x-bind:action="action" method="post">
        @csrf
        <input type="hidden" name="licence_id" value="{{ $licence['id'] }}">
        <x-input-error :messages="$errors->get('licence_id')"/>
        {{-- <input type="hidden" name="licence_action" value="release"> --}}
        <x-input-error :messages="$errors->get('licence_action')"/>
        <h1 class="m-5 font-bold text-white">selected value: <span x-text="action"></span></h1>
          <select 
          name="service_type"
           x-model="test"
          class="inline-flex items-center justify-center text-white bg-[#1e2838] shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5"
           >
            <option value="0" disabled selected>Select Licence service</option>
            <option value="{{ $renew }}">renew</option>
            <option value="{{ $lost }}">lost</option>
            <option value="{{ $damaged }}">damaged</option>
            <option value="{{ $release }}">release</option>
          </select>
        <button class="cursor-pointer text-white bg-[#1e2838] shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5" 
        type="submit">test Application</button>
      </form>
      <button 
        id="btn" 
        class="cursor-pointer rounded-md w-fit mt-2 bg-red-500 text-white font-medium p-2.5 hover:bg-zinc-200 transition"
        onclick="downloadPDF()">
        Download Licence pdf
      </button>
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