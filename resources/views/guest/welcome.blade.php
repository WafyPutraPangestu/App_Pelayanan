<x-layout>
    <h1>halaman home</h1>
    @auth
        <h1> hello {{ auth()->user()->name }} </h1>
    @endauth

    <a href="{{ route('auth.login') }}">login</a>
    <a href="{{ route('auth.register') }}">register</a>
</x-layout>
