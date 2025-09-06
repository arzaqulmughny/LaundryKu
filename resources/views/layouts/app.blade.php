<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trim($__env->yieldContent('title')) ? $__env->yieldContent('title') . ' - ' : '' }}LaundryKu
    </title>
    @vite(['resources/css/app.css'])

</head>

<body class="bg-slate-100">
    @yield('content')
</body>

@vite(['resources/js/app.js'])

@stack('scripts')

@if(session('success'))
<script>
    alert('{{ session('success') }}');
</script>
@endif

</html>