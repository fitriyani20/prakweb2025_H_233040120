<!DOCTYPE html>
<html>
<head>
    <title>All Categories</title>
</head>
<body>
    <h1>Daftar Semua Kategori</h1>

    <ul>
        @foreach ($categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>

</body>
</html>

{{-- Success Alert --}}
@if(session('success'))
<div class="flex items-center p-4 mb-4 text-sm text-fg-success-strong rounded-base bg-success-soft border border-success-subtle" role="alert">
    <svg class="w-4 h-4 me-2 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11.2h2v5m-2-5h2m0 0l-2-2.5 8.5M12 24a9 9 0 1 1 0-18 9 9 0 0 1 0 18Z"/>
    </svg>
    <p class="flex-1">
        <span class="font-medium me-1">Success!</span>
        {{ session('success') }}
    </p>
    <button type="button" onclick="this.parentElement.remove()" class="ms-auto -mx-1.5 -my-1.5 bg-success-soft text-fg-success-strong rounded-base focus:ring-2 focus:ring-success-subtle p-1.5 hover:bg-success-medium inline-flex items-center justify-center h-8 w-8">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6m-6-6L1 13m6-6 6-6"/>
        </svg>
    </button>
</div>
@endif