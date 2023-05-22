<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservation History') }}
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
            {{ __('History') }}
            </h2>        

          <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-max w-full table-auto mt-4">
              <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                  <th class="py-3 px-6 text-left">Booking ID</th>
                  <th class="py-3 px-6 text-center">Date</th>
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
                      {{ \Carbon\Carbon::parse($order->booking_date)->format('d F Y') }} - {{ $order->booking_time }}
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
                        <a href="#order-detail-{{ $order->id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Order Detail</a>
                        @if($order->status == 1 && $order->feedback == null)
                          <a href="#order-review-{{ $order->id }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Leave review</a>
                        @elseif ($order->status == 2)
                        <a href="{{ route('checkout', ['order_id' => $order->id ]) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Retry payment</a>
                        @endif
                    </td>
                  </tr>

                  <div class="modal" id="order-detail-{{ $order->id }}">
                    <div class="modal-box">
                      <div class="flex flex-col">
                        <div class="flex items-center font-bold bg-gray-100 p-2">
                          <div class="px-4">Order detail</div>
                        </div>
                        @php
                          $total = 0;
                        @endphp
                        @foreach ($order->orders as $food_detail)
                        <div class="flex justify-between items-center p-2">
                          <div class="px-4">
                            <h3 class="text-lg font-semibold">{{ $food_detail->food->food_name }}</h3>
                            <img src="{{ asset('storage/' . $food_detail->food->image) }}" alt="Product Image" class="w-16 h-16 rounded-full">
                          </div>
                          <div class="px-4">
                            <p class="text-gray-500">Price: RM{{ $food_detail->price }}</p>
                            <p class="text-gray-500 text-end">Quantity: {{ $food_detail->quantity }}</p>
                          </div>
                        </div>
                        @php
                          $total += $food_detail->price* $food_detail->quantity;
                        @endphp
                        @endforeach
                        <div class="flex justify-end font-bold bg-gray-100 p-2">
                          <div class="px-4">Total : RM {{number_format($total, 2)}}</div>
                        </div>

                      </div>

                      @if($order->feedback)
                      <div class="flex flex-col py-6">
                        <div class="w-full px-4">
                          <p class="text-lg font-semibold">Customer Review:</p>
                          <p>{{ $order->feedback }}</p>
                        </div>
                      </div>
                      
                      @endif
  
                      <div class="modal-action">
                        <a href="{{ asset('storage/'. $order->receipt) }}" target="_blank" class="btn btn-primary">View receipt</a>
                        <a href="#" class="btn">Close</a>
                      </div>
                      
                    </div>
                  </div>

                  <div class="modal" id="order-review-{{ $order->id }}">
                    <div class="modal-box">
                      <div class="flex flex-col">
                        <div class="flex items-center font-bold bg-gray-100 p-2">
                          <div class="w-1/3 px-4">Leave review</div>
                        </div>
                        <form action="{{ route('review') }}" method="POST">
                          @csrf
                          <input type="hidden" name="order_id" value="{{ $order->id  }}">
                          <div class="w-full py-3 px-3">
                            <label for="review" class="block text-sm font-medium text-gray-700">Review:</label>
                            <input class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" name="review" required>
                          </div>
                        </div>
                        
                        
                        <div class="modal-action">
                          <a href="#" class="btn">Close</a>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                      
                    </div>
                  </div>
                  
                  
                @endforeach
              </tbody>
            </table>
          </div>
        </div>        
      </div>
    </div>



  </x-app-layout>
  