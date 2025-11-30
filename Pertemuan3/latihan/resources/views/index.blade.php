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
