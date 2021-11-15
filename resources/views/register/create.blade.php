<x-layout>
    <section class="register-section">
        <main class="register-main">
            <h1>Register!</h1>

            <form method="POST" action="/register" class="register-form">
                @csrf

                <div class="input-div">
                    <label class="label" for="name">
                        Name
                    </label>

                    <input class="input-element" type="text" name="name" id="name"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-div">
                    <label class="label" for="username">
                        Username
                    </label>

                    <input class="input-element" type="text" name="username" id="username"
                        value="{{ old('username') }}" required>
                    @error('username')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-div">
                    <label class="label" for="email">
                        Email
                    </label>

                    <input class="input-element" type="email" name="email" id="email"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-div">
                    <label class="label" for="password">
                        Password
                    </label>

                    <input class="input-element" type="password" name="password" id="password"
                        value="{{ old('password') }}" required>
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-div">
                    <button type="submit" class="submit-button">
                        Submit
                    </button>
                </div>
            </form>
        </main>
    </section>
</x-layout>