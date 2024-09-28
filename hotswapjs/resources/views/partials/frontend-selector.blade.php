<style>
    /* Topbar wrapper */
    .topbar {
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #f8f9fa; /* Light background */
        border-bottom: 1px solid #ddd; /* Add a subtle bottom border */
        z-index: 1000; /* Ensure it stays on top */
        padding: 0.5rem 1rem; /* Add some padding */
        box-sizing: border-box;
        display: flex;
        justify-content: center; /* Center the selector horizontally */
        align-items: center; /* Align the items in the center vertically */
    }

    /* Form styling inside the topbar */
    form.frontend-selector {
        max-width: 20rem; /* Limit the width of the form */
        width: 100%;
    }

    /* Ensure select element is styled properly */
    form.frontend-selector select {
        padding: 0.5rem;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        font-size: 1rem;
        color: #333;
    }

    /* Add some spacing for the rest of the page content */
    body {
        padding-top: 3rem; /* Ensure content doesn’t overlap with the topbar */
    }

</style>

<div class="topbar">
    <form action="{{ route('frontend') }}" method="POST" id="frontend-selector-form" class="frontend-selector">
        @csrf
        <select name="frontend" id="frontend-selector" onchange="document.getElementById('frontend-selector-form').submit()">
            @foreach(config('hotswapjs.frontends') as $frontend)
                <option value="{{ $frontend }}" {{ session('frontend') === $frontend ? 'selected' : '' }}>
                    @if($frontend === 'welcome')
                        Laravel Blade
                    @else
                        {{ ucfirst($frontend) }}
                    @endif
                </option>
            @endforeach
        </select>
    </form>
</div>


