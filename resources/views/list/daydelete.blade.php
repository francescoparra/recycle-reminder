<x-layout>
    <section class="days-delete-section">
        <main class="days-delete-main">
            <h1>Delete Days</h1>
            <div class="days-delete-div">
                @foreach ($days as $day)
                    <form method="POST"
                        action="/daysdelete/{{ $existingDays->where('day_name', $day)->first()->id }}"
                        id="days-delete-form" class="days-delete-form">
                        <div class="days-delete-input-div">
                            @csrf
                            @method('DELETE')
                            <h2>{{ ucfirst($day) }}</h2>
                            <button class="delete-button" type="submit"><i class="far fa-window-close"></i></button>
                        </div>
                    </form>
                @endforeach
            </div>
            @if (!$existingDays)
                <div class="no-delete">
                    <h2>No Days To Delete</h2>
                </div>
                @endif
            <div class="buttons-div">
                <a href="/list" class="back-button">Go List</a>
                <a href="/days" class="next-button">Go Days</a>
                <a href="/categorydelete" class="next-button">Delete Category</a>
            </div>
        </main>
    </section>
</x-layout>
