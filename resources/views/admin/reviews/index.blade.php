<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Manage Reviews</h2>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b">
                                    <th class="p-4 font-semibold text-gray-600">User</th>
                                    <th class="p-4 font-semibold text-gray-600">Doctor</th>
                                    <th class="p-4 font-semibold text-gray-600">Rating</th>
                                    <th class="p-4 font-semibold text-gray-600">Comment</th>
                                    <th class="p-4 font-semibold text-gray-600">Status</th>
                                    <th class="p-4 font-semibold text-gray-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reviews as $review)
                                    <tr class="border-b hover:bg-gray-50 transition-colors">
                                        <td class="p-4">
                                            <div class="font-bold">{{ $review->user->name }}</div>
                                            <div class="text-xs text-gray-400">{{ $review->user->email }}</div>
                                        </td>
                                        <td class="p-4">
                                            <div class="font-bold text-indigo-600">{{ $review->doctor->user->name }}</div>
                                            <div class="text-xs text-gray-400">{{ $review->doctor->department->name }}</div>
                                        </td>
                                        <td class="p-4">
                                            <div class="flex text-amber-400">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                @endfor
                                            </div>
                                        </td>
                                        <td class="p-4 text-sm text-gray-600 italic">
                                            "{{ Str::limit($review->comment, 50) }}"
                                        </td>
                                        <td class="p-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $review->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $review->status ? 'Approved' : 'Hidden' }}
                                            </span>
                                        </td>
                                        <td class="p-4">
                                            <div class="flex items-center space-x-2">
                                                <form action="{{ route('admin.reviews.toggle', $review) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-sm font-bold {{ $review->status ? 'text-amber-600' : 'text-green-600' }} hover:underline">
                                                        {{ $review->status ? 'Hide' : 'Approve' }}
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-sm font-bold text-red-600 hover:underline">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-8 text-center text-gray-400 italic">No reviews found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $reviews->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
