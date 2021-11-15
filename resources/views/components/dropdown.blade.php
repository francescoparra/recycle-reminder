@props(['category', 'days'])
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
    <input class="textbar" name="time" type="text" placeholder="07:00/09:00 or Morning">
</div>