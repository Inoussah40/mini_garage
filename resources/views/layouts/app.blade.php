<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Gestion du garage')</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">

            {{-- Logo --}}
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                🚗 Garage
            </a>

            {{-- Navigation --}}
            <div class="d-flex gap-2">

                <a
                    href="{{ route('vehicules.index') }}"
                    class="btn btn-outline-light btn-sm"
                >
                    🚗 Véhicules
                </a>

                <a
                    href="{{ route('reparations.blade.index') }}"
                    class="btn btn-outline-light btn-sm"
                >
                    🔧 Réparations
                </a>

                <a
                    href="{{ route('reparations.blade.create') }}"
                    class="btn btn-primary btn-sm"
                >
                    + Nouvelle réparation
                </a>

            </div>

        </div>
    </nav>

    <main class="container py-5">

        @yield('content')

    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>