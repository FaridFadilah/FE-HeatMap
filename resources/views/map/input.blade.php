@extends('layouts.app')

@section('content')
	<!-- Map container -->
	<div id="map" class="z-10 h-screen min-h-screen"></div>

	<!-- Input data form -->
	<div class="absolute top-[100px] left-[50px] z-50 ">
		<form id="handleForm" method="POST" class=" rounded gap-3 p-4 w-[200px] flex flex-col bg-white">
			<label for="price">Price</label>
			<input type="number" placeholder="Harga" name="price" class="p-2 border-2 border-gray-500 rounded-xl" id='price'
				x-model="formData.price">
				
			<label for="lat">Latitude</label>
			<input type="text" name="lat" id="lat" class="p-2 border-2 border-gray-500 rounded-xl" x-model="formData.lat">

			<label for="long">Longitude</label>
			<input type="text" name="long" id="long" class="p-2 border-2 border-gray-500 rounded-xl"
				x-model="formData.long">
				
			<button id="submit" type='submit' class="p-2 text-white bg-blue-500 rounded-xl">Submit</button>
		</form>
	</div>

	<!-- Loading indicator -->
	<div id='loading' class="absolute bottom-[50%] left-[50%] right-[50%] lg:top-5 lg:left-5 lg:right-0 hidden items-center justify-center z-[999] bg-white w-[100px] h-[50px] rounded">
        <svg aria-hidden="true" class="w-6 h-6 mr-2 text-gray-700 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
        </svg>
        <span class="text-xs italic font-light">Loading</span>
    </div>

	<!-- Message info container -->
	<div id='message' class="absolute bottom-[50%] left-[50%] right-[50%] lg:top-5 lg:left-14 lg:right-0 hidden items-center justify-center z-[999] bg-white w-[200px] h-10 px-2 py-1.5 rounded">
    </div>
@endsection

@push('scripts')
  	<script src="{{ url(asset('scripts/input.js')) }}"></script>
@endpush
