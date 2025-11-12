<x-site-layout title='Projects'>
    <ul>
        @foreach ($projects as $project)
            <li>
                <div class="bg-gray-200 rounded-lg">
                    <h2 class="font-bold text-xl">
                        {{ $project->name }}
                    </h2>
                    <p>
                        {{ $project->description }}
                    </p>
                </div>
            </li>
        @endforeach
    </ul>
</x-site-layout>