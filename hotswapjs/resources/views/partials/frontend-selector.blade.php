<style>
    form.frontend-selector {
        max-width: 24rem;
        margin-left: auto;
        margin-right: auto;
    }

    form.frontend-selector > label {
        display: block;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        color: rgb(17 24 39 / 1);
    }

    :is(.dark form.frontend-selector > label) {
        color: rgb(255 255 255 / 1);
    }

    form.frontend-selector > select {
        background-color: rgb(249 250 251 / 1);
        border-width: 1px;
        border-color: rgb(209 213 219 / 1);
        color: rgb(17 24 39 / 1);
        font-size: 0.875rem;
        line-height: 1.25rem;
        border-radius: 0.5rem;
    }

    form.frontend-selector > select:focus {
        border-color: rgb(59 130 246 / 1);
    }

    form.frontend-selector > select {
        display: block;
        width: 100%;
        padding: 0.625rem;
    }

    :is(.dark form.frontend-selector > select) {
        background-color: rgb(55 65 81 / 1);
        border-color: rgb(75 85 99 / 1);
    }

    :is(.dark form.frontend-selector > select)::-moz-placeholder {
        color: rgb(156 163 175 / 1);
    }

    :is(.dark form.frontend-selector > select)::placeholder {
        color: rgb(156 163 175 / 1);
    }

    :is(.dark form.frontend-selector > select) {
        color: rgb(255 255 255 / 1);
    }

    :is(.dark form.frontend-selector > select:focus) {
        border-color: rgb(59 130 246 / 1);
    }
</style>

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
