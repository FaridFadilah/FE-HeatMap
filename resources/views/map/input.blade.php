@extends('layouts.app')

@section('content')
  <div id="map" class="z-10 h-screen"></div>

  <div class="absolute top-[100px] left-[50px] z-50 ">
    <form id="handleForm" method="POST" class=" rounded gap-3 p-4 w-[200px] flex flex-col bg-white">
      <label for="">Harga</label>
      <input type="number" placeholder="Harga" name="price" class="p-2 border-2 border-gray-500 rounded-xl" id='price'
        x-model="formData.price">
      <label for="">lat</label>
      <input type="text" name="lat" id="lat" class="p-2 border-2 border-gray-500 rounded-xl" x-model="formData.lat">
      <label for="">long</label>
      <input type="text" name="long" id="long" class="p-2 border-2 border-gray-500 rounded-xl"
        x-model="formData.long">
      <button id="submit" type='submit' class="p-2 text-white bg-blue-500 rounded-xl">Submit</button>
    </form>
  </div>
@endsection

@push('scripts')
  <script src="{{ url(asset('scripts/input.js')) }}"></script>
@endpush
