<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservation History') }}
        </h2>
    </x-slot>
  
  
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- @if(session('success'))
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
        @endif --}}
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-5 sm:p-6">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History') }}
            </h2>        
        {{-- <form action="{{ route('food.create') }}" method="POST" enctype="multipart/form-data"> --}}
            {{-- <div class="flex flex-wrap justify-between"> --}}
              {{-- @csrf --}}
                {{-- <div class="w-full py-3 px-3">
                  <label for="category" class="block font-medium text-gray-700 mt-4">Category:</label>
                  <select id="category" name="category" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="" disabled selected>Select a category</option> --}}
                    {{-- @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach --}}
                  {{-- </select>
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
          </form> --}}
          <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-max w-full table-auto mt-4">
              <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                  <th class="py-3 px-6 text-left">Booking ID</th>
                  <th class="py-3 px-6 text-center">Date</th>
                  <th class="py-3 px-6 text-center">Time</th>
                  <th class="py-3 px-6 text-center">Status</th>
                  <th class="py-3 px-6 text-center">Total people</th>
                  <th class="py-3 px-6 text-center">Action</th>
                </tr>
              </thead>
              
              <tbody class="text-gray-600 text-sm font-light">
                @foreach ($data as $key => $order)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                  <td class="py-3 px-6 text-left whitespace-nowrap flex items-center">
                        {{ $order->id }}
                    </td>
  
                    <td class="py-3 px-6 text-center">
                      {{ \Carbon\Carbon::parse($order->booking_date)->format('d F Y') }}
                    </td>
                    <td class="py-3 px-6 text-center">
                      {{ $order->booking_time }}
                    </td>
                    <td class="py-3 px-6 text-center">
                      @if ($order->status == 0)                          
                      <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">
                        Waiting for approval
                      </span>
                      @elseif ($order->status == 1)
                      <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">
                        Accepted
                      </span>
                      @else
                      <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">
                        Rejected
                      </span>
                      @endif
                      
                    </td>
                    <td class="py-3 px-6 text-center">
                      {{ $order->total_people }}
                    </td>
                    <td class="py-3 px-6 text-center">
                        <!-- The button to open modal -->
                        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Order Detail</a>
                        <a href="#" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
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
  