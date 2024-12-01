<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-8">Manage Categories</h1>

        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('categories.create') }}" 
               class="inline-block bg-blue-600 text-white py-2 px-6 rounded-lg text-lg font-medium hover:bg-blue-700 transition duration-300 ease-in-out">
               Add New Category
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg shadow-md mb-6">
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @endif

        @if($categories->isEmpty())
            <p class="text-lg text-gray-600">Currently, there are no categories available. You can create one by clicking the "Add New Category" button.</p>
        @else
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full text-sm text-left text-gray-500">
                    <thead class="bg-gray-50 text-gray-700">
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200">ID</th>
                            <th class="px-6 py-3 border-b border-gray-200">Category Name</th>
                            <th class="px-6 py-3 border-b border-gray-200">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="px-6 py-4">{{ $category->id }}</td>
                                <td class="px-6 py-4">{{ $category->name }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="flex items-center text-gray-500 hover:text-black">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 013.182 3.182L8.621 18.092a4.5 4.5 0 01-1.682 1.057l-4.135 1.378 1.378-4.135a4.5 4.5 0 011.057-1.682l11.242-11.243z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.006 7.168L16.832 4.994" />
                                        </svg>
                                        Edit Category
                                    </a>

                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 flex items-center"
                                                onclick="return confirm('Are you sure you want to delete this category?')">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
