@props(['person' => null])
@php
  $modes = ['new', 'edit', 'read'];  
  $routes = ['person.store', 'person.update'];
@endphp
@props(['countries', 'mode' => $modes[0]])
<div class="flex flex-col justify-between bg-black p-6 border border-default rounded-base w-250"
    x-data="{
    countryId: @js(old('country_id', $person?->country_id)),
    mode: @js($mode),
    gender:'male',
    get isReadMode(){return this.mode === 'read'},
    img:{
      male: '/images/defaults/male.png',
      female: '/images/defaults/female.png'
    },

    previewImage: null,

    get setImage(){
      if(this.previewImage){
        return this.previewImage
      }
      return this.gender === 'male' ? this.img.male : this.img.female;
    },

    handleImageUpload(event){
      const file = event.target.files[0];
      if(!file) return;
      this.previewImage = URL.createObjectURL(file);
    },
  }"
>
  <h4 class="m-2 text-white">Person_ID:</h4>
  <div class="flex flex-1 p-3 bg-gray-500">
    <form id="form" action="{{ route('person.store') }}" method="post" class="" enctype="multipart/form-data">
      @csrf
      <div id="input_fields" class="flex">
        <div class="mx-2">
          <x-input-label for="name" value="Name"/>        
          <x-text-input id="name" name="name" type="text" :value="old('name', 'john')" x-bind:readonly="isReadMode" required autofocus autocomplete="name" class="mt-1 block w-full"/>
          <x-input-error :messages="$errors->get('name')"/>
          </div>
        <div class="mx-2">
          <x-input-label for="email" value="Email"/>        
          <x-text-input id="email" name="email" type="text" :value="old('email', 'test@gmail.com')" x-bind:readonly="isReadMode" required autocomplete="name" class="mt-1 block w-full"/>
          <x-input-error :messages="$errors->get('email')"/>
        </div>
        <div class="mx-2">
          <x-input-label for="phone" value="Phone"/>        
          <x-text-input id="phone" name="phone" type="number" :value="old('phone', '123456')" x-bind:readonly="isReadMode" required autocomplete="name" class="mt-1 block w-full"/>
          <x-input-error :messages="$errors->get('phone')"/>
        </div>
        <div class="mx-2">
          <x-input-label for="nationalno" value="Nationalno"/>        
          <x-text-input id="nationalno" name="national_no" type="text" :value="old('nationalno', 'n45')" x-bind:readonly="isReadMode" required autocomplete="name" class="mt-1 block w-full"/>
          <x-input-error :messages="$errors->get('nationalno')"/>
        </div>
        <div class="mx-2">
          <x-input-label for="date" value="date of birth"/>        
          <x-text-input 
          id="date" name="date_of_birth" type="date" 
          x-bind:readonly="isReadMode" autocomplete="name" 
          class="mt-1 block w-full bg-[#cdcdcd]"
          :max="now()->subYears(18)->format('Y-m-d')"
          :value="old('date_of_birth', '2008-01-01')"
          />
          <x-input-error :messages="$errors->get('date_of_birth')"/>
        </div>
      </div>
      <div id="country_Address" class="flex">
        <div class="mx-2">
          <x-input-label for="" value="address"/> 
          <textarea name="address" id="" cols="30" x-bind:readonly="isReadMode">{{ old('address', 'syr') }}</textarea>
        </div>
        <div id="country" class="mx-2 flex items-center">
          <select name="country_id" id="" x-model="countryId" x-bind:disabled="isReadMode">
            <option value="0" disabled selected>Select country</option>
            @foreach ($countries as $country)
            <option value="{{ $country['id'] }}">{{$country['name']}}</option>
            @endforeach
          </select>
          <input type="hidden" name="country_id" x-show="isReadMode" x-bind:value="countryId">
        </div>
        <div class="flex gap-3 items-center ml-5">
          <input name="gender" type="radio" id="male" x-model="gender" value="male" x-bind:disabled="isReadMode"/>
          <x-input-label for="male" value="Male"/>        
          <input name="gender" type="radio" id="female" x-model="gender" value="female" x-bind:disabled="isReadMode"/>
          <x-input-label for="female" value="Female"/>        
        </div>
      </div>
      <input id="file" type="file" name="file" hidden @change="handleImageUpload">
    </form>
    <div class="flex flex-col m-2 p-1">
      <div id="img_box" class="p-5 w-35 h-35 bg-gray-700 rounded-md">
        <img x-bind:src="setImage" alt="Person_image" class="object-cover w-full rounded-base md:h-auto md:w-48 mb-4 md:mb-0">
      </div>
      <div>
        <label for="file" class="underline bold text-[15px]" x-bind:hidden="isReadMode">Set Image</label>
        <x-input-error :messages="$errors->get('file')" class="mt-2" />
      </div>
    </div>
  </div>
  <button x-bind:hidden="isReadMode" type="submit" form="form" class="p-2 m-3 w-fit bg-white text-black rounded-md">Submit</button>
</div>
