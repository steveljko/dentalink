<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DentaLink')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}"}' class="bg-gray-50">
    <x-modal.container />
    <x-modal.backdrop />

    <div class="w-1/2 p-4 mx-auto rounded-md bg-white shadow">
        <form hx-post="{{ route('login.handle') }}">
            <x-input name="username" label="Korisničko ime" />
            <x-input type="password" name="password" label="Šifra" />
            <x-button type="submit">Uloguj se</x-button>
        </form>
    </div>
</body>

</html>
