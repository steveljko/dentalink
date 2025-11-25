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
    <div class="flex items-center justify-center h-screen">
        <div class="w-1/2 lg:w-1/3 p-4 rounded-lg border border-gray-100 bg-white shadow">
            <div class="flex justify-center items-center my-3">
                <i class="fas fa-tooth text-2xl mr-3 text-blue-500"></i>
                <h1 class="text-xl font-bold">DentaLink</h1>
            </div>
            <form hx-post="{{ route('login.handle') }}">
                <x-input name="username" label="Korisničko ime" />
                <x-input type="password" name="password" label="Šifra" />
                <div class="flex justify-end">
                    <x-button type="submit">Uloguj se</x-button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
