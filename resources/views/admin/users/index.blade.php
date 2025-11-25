<x-app-layout title='All Users' action="/admin/users/create" button="New User">

    <div class="w-full pl-4 top-32 sticky bg-gray-100">
        {{ $users->links() }}
    </div>

    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($users as $user)
            <li class="h-full">
                <div class="bg-gray-200 transition rounded-lg h-full p-4 flex flex-col items-start justify-between gap-2">
                    <x-admin.actions class="w-full">
                        <a href="/admin/users/{{ $user->id }}/edit" class="hover:text-red-400" title="Edit">
                            <x-fas-edit class="w-4 h-4" />
                        </a>
                        <form method="POST" action="/admin/users/{{ $user->id }}" class="flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hover:text-red-400 cursor-pointer" title="Delete">
                                <x-fas-trash class="w-4 h-4" />
                            </button>
                        </form>
                    </x-admin.actions>
                    <div class="flex gap-4 items-start justify-start h-full w-full">
                        <x-media-image :model="$user" class="w-12 h-12 rounded-full object-cover mb-2 border border-gray-300" alt="Avatar" />
                        <div>
                            <h3 class="font-bold text-lg">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</x-app-layout>
