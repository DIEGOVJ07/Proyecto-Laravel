<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CodeBattle - Proyecto</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        :root {
            --dark-card: #1a2332;
            --dark-border: #2d3748;
            --dark-input: #0f1824;
            --brand: #10b981;
            --badge-green: #10b981;
            --badge-blue: #3b82f6;
            --badge-red: #ef4444;
            --badge-gray: #6b7280;
        }
        
        .bg-dark-card { background-color: var(--dark-card); }
        .bg-dark-input { background-color: var(--dark-input); }
        .border-dark-border { border-color: var(--dark-border); }
        .text-brand { color: var(--brand); }
        .border-brand { border-color: var(--brand); }
        .text-badge-green { color: var(--badge-green); }
        .bg-badge-green\/10 { background-color: rgba(16, 185, 129, 0.1); }
        .border-badge-green\/20 { border-color: rgba(16, 185, 129, 0.2); }
        .text-badge-blue { color: var(--badge-blue); }
        .bg-badge-blue\/10 { background-color: rgba(59, 130, 246, 0.1); }
        .border-badge-blue\/20 { border-color: rgba(59, 130, 246, 0.2); }
        .text-badge-red { color: var(--badge-red); }
        .border-badge-red\/20 { border-color: rgba(239, 68, 68, 0.2); }
        .text-badge-gray { color: var(--badge-gray); }
        .bg-badge-gray\/10 { background-color: rgba(107, 114, 128, 0.1); }
        .border-badge-gray\/20 { border-color: rgba(107, 114, 128, 0.2); }
    </style>
</head>

<body class="bg-slate-950 text-white antialiased">

    @include('partials.navbar')

    <main>
        {{ $slot }}
    </main>

    @include('partials.footer')

</body>

</html>
