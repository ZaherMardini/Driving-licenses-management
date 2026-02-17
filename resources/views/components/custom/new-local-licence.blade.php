  @php
    use App\Models\LicenceClass;
    use App\Enums\personCardMode;
    $classes = LicenceClass::get();
  @endphp
  <div x-data="{person: ''}" @items-updated.window = "person = event.detail">
    <form id="local" action="{{ route('LocalLicence.store') }}" method="post">
      @csrf
      <select name="licence_class_id" class="m-5 rounded-md">
        <option value="0" selected disabled>Select class</option>
        @foreach ($classes as $class)
          <option value="{{ $class['id'] }}">{{ $class['title'] }}</option>
        @endforeach
      </select>
      <x-input-error :messages="$errors->get('licence_class_id')"/>
      <input name="person_id" type="hidden" x-bind:value=" person ? person.id : '' "/>
      <x-input-error :messages="$errors->get('person_id')"/>
    </form>
    <x-custom.person-card :mode="personCardMode::read->value"/>
    <button type="submit" form="local" class="p-2 m-2 bg-[#6a7282] text-white rounded-md">create</button>
  </div>


