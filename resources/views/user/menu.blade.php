<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Menu') }}
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
          <div class="flex items-center justify-center w-screen">
            <div class="flex flex-row">
              <div class="max-w-sm w-25 flex-grow-0 flex-shrink-0 rounded overflow-hidden shadow-lg px-3 py-3">
                <img class="w-full" src="https://img.buzzfeed.com/thumbnailer-prod-us-east-1/8fc00a45259a49d49d9100a34f2087eb/BFV44742_PantryPasta_FB_Final.jpg" alt="Food Image">
                <div class="px-6 py-4">
                  <div class="font-bold text-xl mb-2">Food Item Name</div>
                  <p class="text-gray-700 text-base">$10.00</p>
                </div>
                <div class="px-6 py-4">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    Add Quantity
                  </button>
                </div>
              </div>
              <div class="max-w-sm w-25  flex-grow-0 flex-shrink-0 rounded overflow-hidden shadow-lg px-3 py-3">
                <img class="w-full" src="https://img.buzzfeed.com/thumbnailer-prod-us-east-1/8fc00a45259a49d49d9100a34f2087eb/BFV44742_PantryPasta_FB_Final.jpg" alt="Food Image">
                <div class="px-6 py-4">
                  <div class="font-bold text-xl mb-2">Food Item Name</div>
                  <p class="text-gray-700 text-base">$10.00</p>
                </div>
                <div class="px-6 py-4">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    Add Quantity
                  </button>
                </div>
              </div>
              <div class="max-w-sm w-25  flex-grow-0 flex-shrink-0 rounded overflow-hidden shadow-lg px-3 py-3">
                <img class="w-full" src="https://img.buzzfeed.com/thumbnailer-prod-us-east-1/8fc00a45259a49d49d9100a34f2087eb/BFV44742_PantryPasta_FB_Final.jpg" alt="Food Image">
                <div class="px-6 py-4">
                  <div class="font-bold text-xl mb-2">Food Item Name</div>
                  <p class="text-gray-700 text-base">$10.00</p>
                </div>
                <div class="px-6 py-4">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    Add Quantity
                  </button>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  
      
</x-app-layout>
