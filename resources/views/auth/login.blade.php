<x-layout>

    <h1>HALAMAN LOGIN</h1>
    <form action="{{ route('auth.store') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" />
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" />
        </div>
        <button type="submit">Login</button>
    </form>
</x-layout>
