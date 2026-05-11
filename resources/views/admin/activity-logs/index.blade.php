<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Activity Logs</h2>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b">
                                    <th class="p-4 font-semibold text-gray-600">Time</th>
                                    <th class="p-4 font-semibold text-gray-600">User</th>
                                    <th class="p-4 font-semibold text-gray-600">Action</th>
                                    <th class="p-4 font-semibold text-gray-600">Model</th>
                                    <th class="p-4 font-semibold text-gray-600">Properties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activities as $activity)
                                    <tr class="border-b hover:bg-gray-50 transition-colors">
                                        <td class="p-4 text-sm text-gray-500">
                                            {{ $activity->created_at->format('M d, Y H:i:s') }}
                                        </td>
                                        <td class="p-4">
                                            @if($activity->causer)
                                                <div class="font-bold text-sm">{{ $activity->causer->name }}</div>
                                                <div class="text-xs text-gray-400">{{ $activity->causer->email }}</div>
                                            @else
                                                <span class="text-gray-400 italic text-sm">System</span>
                                            @endif
                                        </td>
                                        <td class="p-4">
                                            <span class="px-2 py-1 rounded text-xs font-bold uppercase tracking-wider
                                                {{ $activity->description === 'created' ? 'bg-green-100 text-green-700' : '' }}
                                                {{ $activity->description === 'updated' ? 'bg-blue-100 text-blue-700' : '' }}
                                                {{ $activity->description === 'deleted' ? 'bg-red-100 text-red-700' : '' }}
                                            ">
                                                {{ $activity->description }}
                                            </span>
                                        </td>
                                        <td class="p-4">
                                            <div class="text-sm font-medium">{{ class_basename($activity->subject_type) }}</div>
                                            <div class="text-xs text-gray-400">ID: {{ $activity->subject_id }}</div>
                                        </td>
                                        <td class="p-4">
                                            @if($activity->changes)
                                                <button @click="$dispatch('open-modal', 'activity-details-{{ $activity->id }}')" class="text-xs font-bold text-indigo-600 hover:underline">
                                                    View Changes
                                                </button>
                                                
                                                <!-- Simple modal or expandable row could be here. For now, showing raw JSON in a small block -->
                                                <div class="hidden mt-2 p-2 bg-gray-50 rounded text-[10px] font-mono overflow-auto max-w-xs">
                                                    {{ json_encode($activity->changes) }}
                                                </div>
                                            @else
                                                <span class="text-gray-300">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-8 text-center text-gray-400 italic">No activity logs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $activities->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
