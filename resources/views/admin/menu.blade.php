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

        <div class="food-list">
          <table class="table-auto w-full">
            <thead>
              <tr>
                <th class="px-4 py-2">Food Name</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Edit</th>
                <th class="px-4 py-2">Delete</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="border px-4 py-2">      
                  <div class="flex">                  
                    <img class="w-20" src="https://img.buzzfeed.com/thumbnailer-prod-us-east-1/8fc00a45259a49d49d9100a34f2087eb/BFV44742_PantryPasta_FB_Final.jpg" alt="Food Image">
                    Hamburger
                  </div>          
                </td>
                <td class="border px-4 py-2">$5.99</td>
                <td class="border px-4 py-2">
                  <span class="inline-block bg-green-500 text-white px-2 py-1 rounded">Active</span>
                </td>
                <td class="border px-4 py-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                </td>
                <td class="border px-4 py-2">
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                </td>
              </tr>
              <tr>
                <td class="border px-4 py-2">Pizza</td>
                <td class="border px-4 py-2">$10.99</td>
                <td class="border px-4 py-2">
                  <span class="inline-block bg-red-500 text-white px-2 py-1 rounded">Disabled</span>
                </td>
                <td class="border px-4 py-2">
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                </td>
                <td class="border px-4 py-2">
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
          
          <div class="w-full py-3 flex justify-end">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">+ Add Food</button>
            
          </div>
        </div>
      </div>
    </div>
  </div>

    
</x-app-layout>
