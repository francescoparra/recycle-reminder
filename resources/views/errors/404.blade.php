<x-layout>
    <section class="error-section">
        <h1>Page not found, sorry for that.</h1>
        <h3>Go back to @auth
            your <a href='/list'>List</a>
            @else
            <a href="/">Home Page</a>
        @endauth</h3>
    </section>
</x-layout>