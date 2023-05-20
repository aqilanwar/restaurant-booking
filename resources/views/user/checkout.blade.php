<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
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
        @if(session('error'))
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
              <strong class="font-bold">Error!</strong>
              <span class="block sm:inline">{{ session('error') }}</span>
          </div>
        @endif
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-5 sm:p-6">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight py-6">
            Make payment
          </h2>       
                    
          <p class="">Please proceed your payment to the details below and upload your payment receipt:</p>
          <div class="flex justify-center py-6 w-24">
            <img src="{{ asset('storage/qr.png') }}" alt="qrpay" class="flex items-center w-32">
          </div>
          <div class="bg-white shadow-md rounded my-4">

          </div>
          <div class="py-4">
            <div class="flex justify-between items-center bg-gray-200 py-4 px-4">
              <p class="text-lg font-bold">Total : RM {{ number_format($total_food, 2);  }}</p>
              <div class="float-end">
                  <a class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" href="{{ route('cart') }}">
                    Back to cart
                  </a>
                  <a  href="#upload-receipt"  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Upload receipt
                  </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="modal" id="upload-receipt">
      <div class="modal-box">
        <form action="{{ route('upload.receipt') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <h3 class="font-bold text-lg">Upload receipt</h3>
    
          <label for="receipt" class="block font-medium text-gray-700 mt-4">Receipt:</label>
          <input type="file" id="receipt" name="receipt" accept="image/*,application/pdf" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
    
          <div class="modal-action">
            <a href="#" class="btn">Cancel</a>
            <button type="submit" class="btn btn-active btn-primary">SAVE</button>
          </div>
        </form>
      </div>
    </div>
    
    
  
      
</x-app-layout>
