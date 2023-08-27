<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body>
    {{-- Navbar --}}
    @include('partials.nav')

    {{-- Alert --}}
    @include('partials.alert')

    {{-- Content --}}
    @yield('body')

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Script --}}
    @yield('before-script')
    @include('partials.script')
    @yield('alert-script')
    @yield('after-script')
</body>

</html>
