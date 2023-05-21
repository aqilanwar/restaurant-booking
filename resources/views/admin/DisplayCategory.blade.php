<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Category') }}
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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Add new category') }}
          </h2>           <form action="{{ route('category.create') }}" method="POST">
          <div class="flex flex-wrap justify-between">
            @csrf
              <div class="w-full py-3 px-3">
                <label for="category" class="block font-medium text-gray-700">Category Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter category name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
              </div>
              <div class="w-full py-3 flex justify-end">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Create category</button>
              </div>
          </div>
        </form>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Category list') }}
          </h2>           <div class="bg-white shadow-md rounded my-6">
          <table class="min-w-max w-full table-auto">
            <thead>
              <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Name</th>
                <th class="py-3 px-6 text-center">Status</th>
                <th class="py-3 px-6 text-center">Number Of Food</th>
                <th class="py-3 px-6 text-center">Action</th>

              </tr>
            </thead>
            
            <tbody class="text-gray-600 text-sm font-light">
              @foreach ($data as $key => $category)
              <tr class="border-b border-gray-200 hover:bg-gray-100">
                  <td class="py-3 px-6 text-left whitespace-nowrap">
                    {{ $key + 1 }}. {{ $category->name }}
                  </td>

                  <td class="py-3 px-6 text-center">
                    <span class="{{ $category->status ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600' }} py-1 px-3 rounded-full text-xs">
                      {{ $category->status ? 'Active' : 'Disabled' }}
                    </span>
                  </td>
                  <td class="py-3 px-6 text-center">
                    1
                  </td>
                  <td class="py-3 px-6 text-center">
                    <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                    <a href="#" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</a>
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
