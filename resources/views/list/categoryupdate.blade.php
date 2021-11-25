<x-layout>
    <section class="category-update-section">
        <main class="category-update-main">
            <h1>Modify Your Categories!</h1>
            <div class="category-update-div">
                @foreach ($existingCategories as $category)
                    <form method="POST"
                        action="/categoryupdate/{{ $category->id }}"
                        id="category-update-form" class="category-update-form">
                        <div class="category-update-input-div">
                            @csrf
                            @method('PUT')
                            <input class="input-update" name="category" placeholder="Old value: {{ ucfirst($category->cat_name) }}" value="{{ ucfirst($category->cat_name) }}">
                            <button class="update-button" type="submit"><i class="far fa-edit"></i></button>
                        </div>
                    </form>
                @endforeach
                <div class="error">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="category-update-buttons">
                <a href="/list" class="back-button">Go Back</a>
            </div>
        </main>
    </section>
</x-layout>