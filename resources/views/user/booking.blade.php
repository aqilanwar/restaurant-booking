<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make Reservation') }}
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
          @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
              <strong class="font-bold">Error!</strong>
              <span class="block sm:inline">{{ session('error') }}</span>
              </div>
          @endif

          @if (session()->has('order')) 
            @php
              if(session()->has('order')) {
                $order = session('order');
              }
            @endphp
          @endif
         <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-5 sm:p-6">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight py-4">
              {{ __('Reservation detail') }}
          </h2>
          <div class="flex flex-wrap justify-between">
            <div class="w-full sm:w-1/2 py-3 px-3">
                <form action="{{ session()->has('order') ? route('cancel.booking') : route('check.booking') }}" method="POST">
                  @csrf
                  <label for="date" class="block font-medium text-gray-700">Select date:</label>
                  <input type="date"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  id="date" name="booking_date" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                         value="{{ session()->has('order') ? session('order.booking_date') : '' }}" required {{ session()->has('order') ? 'disabled' : ''}}>
                  
                  <label for="date" class="block font-medium text-gray-700">Select time:</label>
                  <select id="time" name="booking_time" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required {{ session()->has('order') ? 'disabled' : ''}}>
                      <option value="" disabled selected>Select time</option>
                      <option value="10.00 am - 12.00 pm" {{ session()->has('order') && session('order.booking_time') == '10.00 am - 12.00 pm' ? 'selected' : '' }}>10.00 am - 12.00 pm</option>
                      <option value="12.00 pm - 2.00 pm" {{ session()->has('order') && session('order.booking_time') == '12.00 pm - 2.00 pm' ? 'selected' : '' }}>12.00 pm - 2.00 pm</option>
                      <option value="2.00 pm - 4.00 pm" {{ session()->has('order') && session('order.booking_time') == '2.00 pm - 4.00 pm' ? 'selected' : '' }}>2.00 pm - 4.00 pm</option>
                      <option value="4.00 pm - 6.00 pm" {{ session()->has('order') && session('order.booking_time') == '4.00 pm - 6.00 pm' ? 'selected' : '' }}>4.00 pm - 6.00 pm</option>
                  </select>
                  
              </div>
              <div class="w-full sm:w-1/2 py-3 px-3">
                  <label for="total_people" class="block font-medium text-gray-700">Total number of people (Maximum is 15 per booking):</label>
                  <input type="number" max="15" id="total_people" value="{{ session()->has('order') ? session('order.total_people') : '' }}" name="total_people" placeholder="Enter the total number of people" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" {{ session()->has('order') ? 'disabled' : ''}}>
              </div>
                @if(session()->has('order'))
                <div class="w-full py-2 flex justify-end">
                  <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" type="submit">Cancel Reservation</button>
                </div>
                  @else
                  <div class="w-full py-3 flex justify-end">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                  </div>
                  @endif
                </form>

                @if(session()->has('order'))
                <div class="w-full flex justify-end">
                  <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href={{ route('cart') }}>View Cart</a>
                </div>
                @endif
            </div>
            
            @if(session()->has('order'))
            <h2 class="font-semibold text-xl text-gray-800 leading-tight py-4">
              {{ __('Food list') }}
            </h2>
              <ul class="flex border-b">
                <li class="mr-1">
                  <a href="{{ route('booking') }}" class="@if(request()->has('id'))  bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold  @else bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold @endif">All</a>
                </li>
                @foreach ($categories as $category)
                  @if(request()->has('id') && request()->get('id') == $category->id)
                    <li class="-mb-px mr-1">
                      <a href="{{ route('booking', ['id' => $category->id]) }}" class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold">{{ $category->name }}</a>
                    </li>
                  @else
                    <li class="mr-1">
                      <a href="{{ route('booking', ['id' => $category->id]) }}" class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold">{{ $category->name }}</a>
                    </li>
                  @endif
                @endforeach
              </ul>
            
            <table class="min-w-max w-full table-auto mt-4">
              <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                  <th class="py-3 px-6 text-left">Name</th>
                  <th class="py-3 px-6 text-center">Price (RM)</th>
                  <th class="py-3 px-6 text-center">Category</th>
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
  
                      <form action="{{ route('add.cart', ['food_id' => $food->id]) }}" method="POST" class="inline">
                        @csrf
                        @method('POST')
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" title="Add to cart">
                            Add to cart
                        </button>
                    </form>                
                  </td>
                  </tr>
                @endforeach
                <!-- Add more rows as needed -->
              </tbody>
            </table>
            @endif
          </div>

        </div>
     </div>  

</x-app-layout>