    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <form class="flex-col p-3" wire:submit="loadingButton">
            @csrf
            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Select a gender</label>
            <div class="flex flex-row gap-5">
            <select wire:model="genderSelect" name="genderSelect"
            class="basis-2/4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="neutral" selected>Neutral</option>
                <option value="boy" >Male</option>
                <option value="girl" >Female</option>
            </select>
            <button type="submit"
            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 
            focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 
            text-center mr-2 mb-2">{{ $buttonName }}</button>
            </div>
        </form>
        
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Baby name
                    </th>
                </tr>
            </thead>
            <tbody>

                @if ($apiData != null)
                    @foreach ($apiData as $data)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $data }}
                            </th>
                        </tr>
                    @endforeach
                @else
                    <tr class="px-6 py-4">
                        <td> No Data </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>