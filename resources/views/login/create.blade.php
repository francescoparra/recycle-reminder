<x-layout>
    <section class="register-section">
        <main class="register-main">
            <h1>Login!</h1>

            <form method="POST" action="/login" class="register-form">
                @csrf

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