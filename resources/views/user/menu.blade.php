<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
      @endif
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-5 sm:p-6">
            <ul class="flex border-b">
              <li class="mr-1">
                <a href="{{ route('menu') }}" class="@if(request()->has('id'))  bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold  @else bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold @endif">All</a>
              </li>
              @foreach ($categories as $category)
                @if(request()->has('id') && request()->get('id') == $category->id)
                  <li class="-mb-px mr-1">
                    <a href="{{ route('menu', ['id' => $category->id]) }}" class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold">{{ $category->name }}</a>
                  </li>
                @else
                  <li class="mr-1">
                    <a href="{{ route('menu', ['id' => $category->id]) }}" class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold">{{ $category->name }}</a>
                  </li>
                @endif
              @endforeach
            </ul>
            
          <h2 class="font-semibold text-xl text-gray-800 leading-tight py-6">
            {{ __('Food list') }}
          </h2>        
          <div class="bg-white shadow-md rounded my-4">
            <table class="min-w-max w-full table-auto mt-4">
              <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                  <th class="py-3 px-6 text-left">Name</th>
                  <th class="py-3 px-6 text-center">Price (RM)</th>
                  <th class="py-3 px-6 text-center">Category</th>
                  {{-- <th class="py-3 px-6 text-center">Status</th> --}}
                  {{-- <th class="py-3 px-6 text-center">Action</th> --}}
                </tr>
              </thead>
              
              <tbody class="text-gray-600 text-sm font-light">
                @foreach ($data as $key => $food)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                  <td class="py-3 px-6 text-left whitespace-nowrap flex items-center">
                    <img src="{{ asset('storage/' . $food->image) }}" alt="Uploaded image" class="w-20 flex-shrink-0 mr-4">
                    <span class="font-medium px-3">{{ $key + 1 }}. {{ $food->food_name }}</span>
                </td>
  
                    <td class="py-3 px-6 text-center">
                      RM {{ $food->price }}
                    </td>
                    <td class="py-3 px-6 text-center">
                      {{ $food->category->name }}
                    </td>
        
                  </tr>
                @endforeach
                <!-- Add more rows as needed -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  
      
</x-app-layout>
