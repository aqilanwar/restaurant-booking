<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Cart') }}
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

          <h2 class="font-semibold text-xl text-gray-800 leading-tight py-6">
            {{ __('Order Detail') }}
          </h2>    
          <div class="bg-gray-200 py-4 px-4">
            <h5 class="text-xl text-gray-800 leading-tight">
              Reservation date: {{ \Carbon\Carbon::createFromFormat('Y-m-d', session('order.booking_date'))->format('d F Y') }} ({{ session('order.booking_time') }})
            </h5>              
            <h5 class="text-xl text-gray-800 leading-tight">
              Number of people : {{ session('order.total_people') }}
            </h5>              
          </div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight py-6">
            {{ __('Order List') }}
          </h2>        
          <div class="bg-white shadow-md rounded my-4">
            <table class="min-w-max w-full table-auto mt-4">
              <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                  <th class="py-3 px-6 text-left">Name</th>
                  <th class="py-3 px-6 text-center">Price (RM)</th>
                  <th class="py-3 px-6 text-center">Quantity</th>
                  <th class="py-3 px-6 text-center">Total Price (RM)</th>
                </tr>
              </thead>
              @php
                $i=1;
                $total = 0 ;
              @endphp
              <tbody class="text-gray-600 text-sm font-light">
                @foreach ($food_details as $food)
                @php
                  $total_food = $food['food']->price * $food['quantity'];
                  $total += $total_food;
                @endphp
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                  <td class="py-3 px-6 text-left whitespace-nowrap flex items-center">
                    <img src="{{ asset('storage/' . $food['food']->image) }}" alt="Uploaded image" class="w-20 flex-shrink-0 mr-4">
                    <span class="font-medium px-3">{{ $i++ }}. {{ $food['food']->food_name }}</span>
                </td>
  
                    <td class="py-3 px-6 text-center">
                      RM {{ $food['food']->price }}
                    </td>
                    <td class="py-3 px-6 text-center">
                      <div class="flex justify-center items-center mt-2">
                        <form action="{{ route('decrease.cart', ['food_id' => $food['food']->id]) }}" method="POST" class="inline">
                            @csrf
                            @method('POST')
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" title="Decrease quantity">
                                -
                            </button>
                        </form>
                        <span class="mx-2 px-3 bg-gray-50">{{ $food['quantity'] }}</span>
                        <form action="{{ route('add.cart', ['food_id' => $food['food']->id]) }}" method="POST" class="inline">
                          @csrf
                          @method('POST')
                          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" title="Increase quantity">
                              +
                          </button>
                      </form>
                    </div>
                    
                  </td>
                  
                    <td class="py-3 px-6 text-center">  
                      RM {{ number_format($total_food, 2) }}
                    </td>
  
                  </tr>
                @endforeach
                <!-- Add more rows as needed -->
              </tbody>
            </table>

          </div>
          <div class="py-4">
            <div class="flex justify-between items-center bg-gray-200 py-4 px-4">
              <p class="text-lg font-bold">Total: RM {{ number_format($total, 2) }}</p>
              <div class="float-end">
                  <a class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" href="{{ route('booking') }}">
                    Back to reservation
                  </a>
                  <a href="{{ route('checkout') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Checkout
                  </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
      
</x-app-layout>
