<x-layout>
    <section class="category-delete-section">
        <main class="category-delete-main">
            <h1>Delete Your Categories!</h1>
            <div class="category-delete-div">
                @foreach ($existingCategories as $category)
                    <form method="POST"
                        action="/categorydelete/{{ $categories->where('cat_name', $category)->first()->id }}"
                        id="category-delete-form" class="category-delete-form">
                        <div class="category-delete-input-div">
                            @csrf
                            @method('DELETE')
                            <h2>{{ ucfirst($category) }}</h2>
                            <button class="delete-button" type="submit"><i class="far fa-window-close"></i></button>
                        </div>
                    </form>
                @endforeach
                @if (!$existingCategories)
                    <div class="no-delete">
                        <h2>No Categories To Delete</h2>
                    </div>
                @endif
            </div>
            <div class="category-delete-buttons">
                <a href="/daysdelete" class="back-button">Go Days Delete</a>
                <a href="/category" class="next-button">Go Category</a>
                <a href="/complete" class="next-button">Complete</a>
            </div>
        </main>
    </section>
</x-layout>
