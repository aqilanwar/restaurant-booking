<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make Reservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-5 sm:p-6">
            <div class="flex flex-wrap justify-between">
              <div class="w-full sm:w-1/2 py-3 px-3">
                <label for="total-people" class="block font-medium text-gray-700">Total number of people:</label>
                <input type="text" id="total-people" name="total-people" placeholder="Enter the total number of people" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
              </div>
              <div class="w-full sm:w-1/2 py-3 px-3">
                <label for="datetime" class="block font-medium text-gray-700">Select Date and Time:</label>
                <input type="datetime-local" id="datetime" name="datetime" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
              </div>
              <div class="w-full py-3 flex justify-end">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
      
</x-app-layout>
