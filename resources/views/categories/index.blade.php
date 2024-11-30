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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="px-6 py-4">{{ $category->id }}</td>
                                <td class="px-6 py-4">{{ $category->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
