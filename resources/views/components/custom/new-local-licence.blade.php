  @php
    use App\Models\LicenceClass;
    use App\Enums\CardMode;
    $classes = LicenceClass::get();
  @endphp
  @props(['mode' => CardMode::new->value])
  <div x-data="
  {
    person: '',
    licence: '',
    mode: @js($mode),
    classId: @js(old('licence_class_id', '1')),
    get isReadMode(){ return  {{ $mode }} === '{{ CardMode::read->value }}' },

  }" 
  @items-updated.window = "person = event.detail">
    <form id="local" action="{{ route('LocalLicence.store') }}" method="post">
      @csrf
      <select name="licence_class_id" x-model="classId" class="m-5 rounded-md">
        <option value="0" selected disabled>Select class</option>
        @foreach ($classes as $class)
          <option value="{{ $class['id'] }}">{{ $class['title'] }}</option>
        @endforeach
      </select>
      <x-input-error :messages="$errors->get('licence_class_id')"/>
      <input name="person_id" type="hidden" x-bind:value=" person ? person.id : '' "/>
      <x-input-error :messages="$errors->get('person_id')"/>
    </form>
    <x-custom.person-card :mode="CardMode::read->value"/>
    <button type="submit" form="local" class="p-2 m-2 bg-[#6a7282] text-white rounded-md">create</button>
  </div>


