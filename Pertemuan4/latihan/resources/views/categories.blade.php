<x-layout>
    <x-slot:title>Categories</x-slot:title>

    <div class="py-8 max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Semua Kategori</h1>

        <ul class="list-disc pl-6">
            @foreach ($categories as $category)
                <li class="mb-2">
                    {{ $category->name }}
                </li>
            @endforeach
        </ul>
    </div>
</x-layout>
