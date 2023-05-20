<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Food') }}
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
      @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-5 sm:p-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Add new food') }}
          </h2>        
      <form action="{{ route('food.create') }}" method="POST" enctype="multipart/form-data">
          <div class="flex flex-wrap justify-between">
            @csrf
              <div class="w-full py-3 px-3">
                <label for="category" class="block font-medium text-gray-700 mt-4">Category:</label>
                <select id="category" name="category" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                  <option value="" disabled selected>Select a category</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
                <label for="name" class="block font-medium text-gray-700 mt-4">Food name:</label>
                <input type="text" id="food_name" name="food_name" placeholder="Enter food name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

                <label for="price" class="block font-medium text-gray-700 mt-4">Price: (RM)</label>
                <input type="text" id="price" name="price" placeholder="Enter price (RM)" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
              
                <label for="image" class="block font-medium text-gray-700 mt-4">Image:</label>
                <input type="file" id="image" name="image" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
              
              </div>
            
              <div class="w-full py-3 flex justify-end">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">+ Create Food</button>
              </div>
          </div>
        </form>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Food list') }}
        </h2>        
        <div class="bg-white shadow-md rounded my-6">
          <table class="min-w-max w-full table-auto mt-4">
            <thead>
              <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Name</th>
                <th class="py-3 px-6 text-center">Price (RM)</th>
                <th class="py-3 px-6 text-center">Category</th>
                <th class="py-3 px-6 text-center">Status</th>
                <th class="py-3 px-6 text-center">Action</th>
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
                  <td class="py-3 px-6 text-center">
                    <span class="{{ $food->status == 'Active' ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600' }} py-1 px-3 rounded-full text-xs">
                      {{ $food->status }}
                    </span>
                  
                    
                  </td>
                  <td class="py-3 px-6 text-center">

                <!-- The button to open modal -->
                  <a href="#edit-food-{{ $food->id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
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
  @foreach ($data as $food)      
  <!-- Put this part before </body> tag -->
  <div class="modal" id="edit-food-{{ $food->id }}">
    <div class="modal-box">
      <form action="{{ route('food.edit') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <h3 class="font-bold text-lg">Edit food : {{ $food->food_name }}</h3>
      <label for="name" class="block font-medium text-gray-700 mt-4">Food name:</label>
      <input type="text" id="food_name" name="food_name" value="{{ $food->food_name }}" placeholder="{{ $food->food_name }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
      <input type="text" id="food_id" name="food_id" value="{{ $food->id }}" hidden>

      <label for="price" class="block font-medium text-gray-700 mt-4">Price: (RM)</label>
      <input type="text" id="price" name="price" value="{{ $food->price }}" placeholder="Enter price (RM)" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

      <label for="image" class="block font-medium text-gray-700 mt-4">Image:</label>
      <input type="file" id="image" name="image" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
   
      <label for="status" class="block font-medium text-gray-700 mt-4">Status:</label>
      <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <option value="" disabled>Select a status</option>
        <option value="1" @if ($food->status == 'Active') selected @endif>Active</option>
        <option value="0" @if ($food->status == 'Disabled') selected @endif>Disabled</option>
      </select>
      
      <label for="category" class="block font-medium text-gray-700 mt-4">Category:</label>
      <select id="category" name="category" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <option value="" disabled selected>Select a category</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" @if ($category->id == $food->category_id) selected @endif>{{ $category->name }}</option>
        @endforeach
      </select>

      <div class="modal-action">
        <a href="#" class="btn">Cancel</a>
        <button type="submit" class="btn btn-active btn-primary">SAVE</button>
      </div>
      </form>
    </div>
  </div>
  @endforeach
</x-app-layout>
