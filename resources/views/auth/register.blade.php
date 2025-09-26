{{-- HALAMAN REGISTER --}}
<x-layout>

    <h1>HALAMAN REGISTER</h1>
    <form action="{{ route('auth.registerStore') }}" method="POST">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" />
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" />
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" />
        </div>
        <div class="">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" />
        </div>
        <button type="submit">Register</button>
    </form>
