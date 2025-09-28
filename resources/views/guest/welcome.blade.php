<x-layout>
    <h1>halaman home</h1>
    @auth
        <h1> hello {{ auth()->user()->name }} </h1>
<h1> role : {{ auth()->user()->role }} </h1>
    <form action="{{ route('auth.logout') }}" method="POST">
        @csrf
        <button type="submit">logout</button>
    </form>
        @endauth

    <a href="{{ route('login') }}">login</a>
    <a href="{{ route('auth.register') }}">register</a>

    a<a href="{{ route('surat.index') }}">halaman surat</a>
</x-layout>
