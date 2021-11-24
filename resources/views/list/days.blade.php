<x-layout>
    <section class="days-section">
        <main class="days-main">
            <h1>Create Your List!</h1>

            <form method="POST" action="/days" id="days-form" class="days-form">
                @csrf
                <div class="days-div">
                    @foreach ($days as $day)
                        <div class="days-input-div">
                            <input type="checkbox" id="checkbox" name="day_name[]" value="{{ $day }}" @if (in_array($day, $existingDays, true)) disabled @endif>
                            <h2>{{ ucfirst($day) }}</h2>
                        </div>
                    @endforeach
                    <div class="error">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div form="days-form" class="days-buttons">
                    <button class="submit-button" type="submit" form="days-form">
                        Submit
                    </button>
                    @if ($existingDays)
                        <a class="complete-button" href="/category">Categories</a>
                    @endif
                    <a href="/daysdelete" class="delete-button">Delete Days</a>
                </div>
            </form>
        </main>
    </section>
</x-layout>
