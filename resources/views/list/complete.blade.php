<x-layout>
    <section class="complete-section">
        <main class="complete-main">
            <h1>Now Complete Your List!</h1>

            <form method="POST" id="complete-form" action="/complete" class="complete-form">
                @csrf
                <div id="row-div">
                    <div id="row" class="complete-div">
                        <div class="complete-input-div">
                            <select class="dropdown-complete" name="list[]" required>
                                <option value="" selected>Select a day</option>
                                @foreach ($days as $day)
                                <option value="{{ $day->id }}">
                                    {{ ucfirst($day->day_name) }}
                                </option>
                                @endforeach
                            </select>
                            <select class="dropdown-complete" name="list[]">
                                <option value="" selected>Select a category type</option>
                                @foreach ($category as $category)
                                    <option value={{ $category->id }}>
                                        {{ ucfirst($category->cat_name) }}
                                    </option>
                                @endforeach
                            </select>
                            <input class="textbar" name="list[]" type="text" placeholder="07:00/09:00 or Morning">
                        </div>
                    </div>
                    <div class="error">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="button-div">
                    <button form="complete-form" type="submit" class="submit-button">
                        Submit
                    </button>
                    @if ($existing_list->count())
                        <a class="complete-button" href="/list">List</a>
                    @endif
                    <button form="none" id="newrow" type="submit" class="row-button">
                        New Row
                    </button>
                </div>
            </form>
        </main>
    </section>
    <script>
        function run() {
            var container = document.getElementById("row");
            var form = document.getElementById("row-div");
            form.appendChild(container.cloneNode(true));
        }
        document.getElementById("newrow").addEventListener("click", run);
    </script>
</x-layout>
