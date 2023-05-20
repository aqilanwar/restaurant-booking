<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Edit Menu') }}
      </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-5 sm:p-6">
        <ul class="flex border-b">
          <li class="mr-1">
            <a href="#" class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold">Drinks</a>
          </li>
          <li class="-mb-px mr-1">
            <a href="#" class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold">Coffee</a>
          </li>
          <li class="mr-1">
            <a href="#" class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold">Juice</a>
          </li>
          <li class="mr-1">
            <a href="#" class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold">Spaghetti</a>
          </li>
          <li class="mr-1">
            <a href="#" class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold">Burger</a>
          </li>
          <li class="mr-1">
            <a href="#" class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold">Soup</a>
          </li>
          {{-- <li class="mr-1">
            <a href="#" class="bg-white inline-block py-2 px-4 text-gray-400 cursor-not-allowed font-semibold" aria-disabled="true">Disabled</a>
          </li> --}}
        </ul> 
        </div>
      </div>
    </div>
  </div>

    
</x-app-layout>
