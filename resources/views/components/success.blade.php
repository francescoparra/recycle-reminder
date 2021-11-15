@if (session()->has('success'))
    <div x-data="{ show: true }" 
    x-init="setTimeout(() => show = false, 4000)" 
    x-show="show" 
    class="success-message">
        <p>{{ session('success') }}</p>
    </div>
@endif
