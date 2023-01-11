@extends('layouts.app')

@section('content')
    @livewire('components.modal')
    <div id="map" class="h-screen min-h-screen"></div>

    <!-- Form Search -->
    <form action="" method="POST" class="absolute z-[9999] top-5 right-5">
        <div x-data="search">
            <div x-data="{ location: '', resultLocation: resultLocation }" class="bg-white rounded-lg w-[316px]">
                <div class="flex items-center w-full py-1 pl-4 pr-2 bg-white rounded-lg shadow-md">
                    <div class="w-[6%] h-[40px] flex justify-start items-center">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <input type="text" x-model="location" x-on:input="findLocation"
                        class="rounded-xl h-[40px] w-[84%] border-none text-sm focus:ring-transparent"
                        placeholder="Search location ...">
                    <button type="submit"
                        class="w-8 h-8 duration-300 rounded-lg shadow-xl bg-slate-500 hover:bg-slate-500/80">
                        <i class="text-white fa-solid fa-arrow-right"></i>
                    </button>
                </div>
                <div class="max-h-[560px] overflow-y-scroll">
                    <template x-if="location.length > 0">
                        <template x-for="value in resultLocation">
                            <div class="py-3 px-4 flex items-center overflow-x-hidden  max-w-[316px]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                <p x-text="value.display_name"
                                    class="nameLocation ml-[11px] text-sm w-full overflow-y-hidden"></p>
                            </div>
                        </template>
                    </template>
                </div>
            </div>
        </div>
    </form>
    
    <!-- loading screen -->
    <div id='loading' class="absolute top-5 border-2 px-2 py-1.5 border-gray-700 rounded left-5 flex items-center justify-center bg-white z-[999]">
        <svg aria-hidden="true" class="w-6 h-6 mr-2 text-black animate-spin dark:text-gray-600 fill-blue-700" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            <span class="text-gray-700">loading</span>
        </svg>
    </div>

    <div id='errorScreen' class="absolute top-5 left-5 z-[999] hidden items-center justify-center py-1.5 px-2 rounded bg-red-700"><h1 class="text-sm italic font-bold text-white">!! Something went wrong</h1></div>

    <div x-data="dataOrdinal">
        <!-- Button Display Property -->
        <div class="legend bottom-[10%] left-5 bg-white fixed w-[300px] h-[350px] z-[999] flex flex-col justify-center gap-1 pl-5 rounded-lg">
            <template x-for="value in ordinal">
                <div x-on:click="showHeatmap(value.index)" class="flex items-center gap-4 cursor-pointer">
                    <div x-bind:class="'bg-range-' + value.index" class="w-[50px] h-[30px] border border-slate-700"></div>
                    <p class="text-sm" x-text="value.l + ' - ' + value.g "></p>
                </div>
            </template>
            <button x-on:click="showHeatmap()"
                class="mt-3 mr-5 text-white duration-300 rounded-lg bg-slate-600 hover:bg-slate-600/80">Reset
                filter</button>
            <button x-on:click="resetHeatmap()" class="mt-3 mr-5 text-white duration-300 rounded-lg bg-slate-600 hover:bg-slate-600/80">Reset heatmap</button>
            <button class="mt-3 mr-5 text-white duration-300 rounded-lg bg-slate-600 hover:bg-slate-600/80" x-on:click="showProperty()">Tampilkan Property</button>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script src="{{ url(asset('scripts/script.js')) }}"></script>
    <script src="{{ url(asset('scripts/alpine.js')) }}"></script>
@endpush
