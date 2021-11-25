<x-layout>
    @if (!$lists->count())
        <h1 class="no-list">No list yet. <br> <a href="/days">Create</a> a new one!</h1>
    @else
        <section class="list-section">
            <main class="list-main">
                <h1>Your List</h1>
                <div class="list-div">
                    <div class="type-list-div">
                        <h3>Day</h3>
                        <h3>Category
                            <a class="update-button" href="/categoryupdate"><i class="far fa-edit"></i></a>
                        </h3>
                        <h3>Time</h3>
                        <h3>Delete</h3>
                    </div>
                    @foreach ($lists as $list)
                        <div day={{ $list->day }} class="single-list-div">
                            <div class="day">
                                <p>{{ $list->day }}</p>
                            </div>
                            <div class="category">
                                <p>{{ $list->category }}</p>
                            </div>
                            <div class="time">
                                <p>{{ ucfirst($list->time) }}</p>
                            </div>
                            <div class="delete">
                                <form method="POST" action="list/{{ $list->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="cancel-button" type="submit"><i
                                            class="far fa-window-close"></i></button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="filter">
                    <input id="filterday" type="checkbox">
                    <p>Show today only</p>
                </div>
                <div class="links">
                    <a class="add" href="/days">Add To Your List</a>
                    <a class="remove" href="/daysdelete">Remove From Your List</a>
                </div>
            </main>
        </section>
    @endif
    <script>
        $(function() {
            $("#filterday").on("change", function getDayName(e) {
                var get = new Date();
                var weekdays = new Array(8);
                weekdays[0] = "Sunday";
                weekdays[1] = "Monday";
                weekdays[2] = "Tuesday";
                weekdays[3] = "Wednesday";
                weekdays[4] = "Thursday";
                weekdays[5] = "Friday";
                weekdays[6] = "Saturday";
                weekdays[7] = "Sunday";
                var today = weekdays[get.getDay()];
                const todayDiv = $(`.single-list-div[day="${today}"`)
                if ($(e.target).is(":checked")) {
                    $(".single-list-div").hide();
                    todayDiv.show();
                } else {
                    $(".single-list-div").show();
                }
            })
        })
    </script>
</x-layout>
