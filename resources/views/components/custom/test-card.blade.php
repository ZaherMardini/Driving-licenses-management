@props(['appointment'])

<div
class="flex flex-col justify-between bg-slate-800 border border-slate-700 rounded-2xl m-8 p-8 w-full max-w-xl shadow-lg"
x-data="{
  appointment: @js($appointment),
  get route() { return `/tests/${this.appointment?.local_licence_id}/${this.appointment?.test_type?.id}/create` },
}"
@items-updated.window="this.appointment = event.detail;"
>

  <!-- INFO SECTION -->
  <div id="info" class="text-slate-200 space-y-4">

    <h1 class="text-2xl font-semibold text-cyan-300 mb-3">
      Test Info
    </h1>

    <div class="space-y-3 text-sm">

      <div class="flex justify-between border-b border-slate-700 pb-2">
        <span class="text-slate-400">Type</span>
        <span class="font-medium text-blue-400" x-text="appointment?.test_type?.title"></span>
      </div>

      <div class="flex justify-between border-b border-slate-700 pb-2">
        <span class="text-slate-400">Fees</span>
        <span class="font-medium text-white">
          <span x-text="appointment?.test_type.fees"></span>$
        </span>
      </div>

      <div class="flex justify-between border-b border-slate-700 pb-2">
        <span class="text-slate-400">Trial</span>
        <span class="font-medium text-white" x-text="appointment?.trials"></span>
      </div>

      <div class="flex justify-between">
        <span class="text-slate-400">Date</span>
        <span class="font-medium text-blue-400" x-text="appointment?.appointment_date"></span>
      </div>

    </div>
  </div>


  <!-- FORM -->
  <form id="test" x-bind:action="route" method="post" class="mt-8 space-y-6">
    @csrf

    <!-- RESULT -->
    <div>
      <x-input-label value="Result" class="text-slate-400 mb-3 block"/>

      <div class="flex items-center gap-5 text-sm">

        <label class="flex items-center gap-2 cursor-pointer text-slate-300">
          <input type="radio" name="result" id="p" value="1"
            class="w-4 h-4 text-blue-500 bg-slate-700 border-slate-600 focus:ring-0">
          Passed
        </label>

        <label class="flex items-center gap-2 cursor-pointer text-slate-300">
          <input type="radio" name="result" id="f" checked value="0"
            class="w-4 h-4 text-blue-500 bg-slate-700 border-slate-600 focus:ring-0">
          Failed
        </label>

      </div>

      <x-input-error :messages="$errors->get('result')" class="mt-2"/>
    </div>


    <!-- NOTES -->
    <div>
      <x-input-label for="n" value="Notes" class="text-slate-400 mb-2 block"/>

      <textarea
        id="n"
        name="notes"
        rows="4"
        class="w-full bg-slate-700 border border-slate-600 rounded-lg p-3 text-sm text-white focus:outline-none focus:border-blue-500"
      >Flowless victory</textarea>

      <x-input-error :messages="$errors->get('notes')" class="mt-2"/>
    </div>


    <!-- HIDDEN FIELDS (unchanged) -->
    <input type="hidden" name="test_appointment_id" value="{{ $appointment['id'] }}">
    <input type="hidden" name="test_type_id" value="{{ $appointment['test_type']['id'] }}">
    <x-input-error :messages="$errors->get('appointment_id')" />
    <x-input-error :messages="$errors->get('test_type_id')" />

    @php
      use Illuminate\Support\Facades\Auth;
      $userId = Auth::id();
    @endphp

    <input type="hidden" name="created_by_user_id" value="{{ $userId }}">
    <x-input-error :messages="$errors->get('created_by_user_id')" />

  </form>


  <!-- BUTTON -->
  <div class="mt-5">
    <x-primary-button
      form="test"
      class="w-full justify-center bg-slate-700 border border-slate-600 hover:bg-slate-600 text-white font-medium tracking-wide py-3 rounded-lg"
    >
      Submit Test Result
    </x-primary-button>
  </div>

</div>