<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trim($__env->yieldContent('title')) ? $__env->yieldContent('title') . ' - ' : '' }}LaundryKu
    </title>
    <link rel="icon" type="image/png" href="{{ appIcon() }}?v=2">
    @vite(['resources/css/app.css'])
    @livewireStyles
</head>

<body class="bg-slate-100">
    @yield('content')
    @livewireScripts
</body>

@vite(['resources/js/app.js'])

@stack('scripts')

<script>
    // Listen event from livewire
    window.addEventListener('show-alert', event => {
        alert(event.detail[0].message);
    });

    console.log('OK');
</script>

@if(session('success'))
<script>
    alert('{{ session('success') }}');    
</script>
@endif

@if(session('error'))
<script>
    alert('{{ session('error') }}');
</script>
@endif

</html>