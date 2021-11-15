<x-layout>
    <section class="category-section">
        <main class="category-main">
            <h1>Now Select The Categories</h1>
            <form method="POST" action="/category" class="category-form">
                @csrf
                <div class="category-div">
                    @foreach ($standard_categories as $standard_categories)
                        <div class="category-input-div">
                            <input type="checkbox" name="cat_name[]" value="{{ $standard_categories }}" 
                            @if (in_array(strtolower($standard_categories), $existing_categories, true)) disabled @endif >
                            <h2>{{ ucfirst($standard_categories) }}</h2>
                        </div>
                    @endforeach
                    @foreach ($diff as $created)
                        <div class="category-input-div">
                            <input type="checkbox" name="cat_name[]" value="{{ $created }}" 
                            @if (in_array($created, $existing_categories, true)) disabled @endif >
                            <h2>{{ ucfirst($created) }}</h2>
                        </div>
                     @endforeach
                    <div class="category-input-div">
                        <h2>Other: </h2>
                        <input class="textbar" type="text" name="cat_name[]" value="{{ old('cat_name[]') }}"
                            placeholder="Something, something, something">
                    </div>
                    <div class="error">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="category-buttons">
                    <button type="submit" class="submit-button">
                        Submit
                    </button>
                    @if ($category->count())
                        <a class="complete-button" href="/complete">Complete</a>
                    @endif
                    <a class="delete-button" href="/categorydelete">Delete Category</a>
                </div>
            </form>
        </main>
    </section>
</x-layout>
