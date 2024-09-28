<form action="{{ route('frontend') }}" method="POST" id="frontend-selector-form">
    @csrf
    <select name="frontend" id="frontend-selector" onchange="document.getElementById('frontend-selector-form').submit()">
        <option value="welcome" {{ session('frontend', 'welcome') === 'welcome' ? 'selected' : '' }}>Default</option>
        <option value="angular" {{ session('frontend') === 'angular' ? 'selected' : '' }}>Angular</option>
        <!-- Add options for other frameworks -->
    </select>
</form>


{{--<form class="frontend-selector">--}}
{{--    <label for="countries">Select an option</label>--}}
{{--    <select id="countries">--}}
{{--        <option selected="">Choose a country</option>--}}
{{--        <option value="US">United States</option>--}}
{{--        <option value="CA">Canada</option>--}}
{{--        <option value="FR">France</option>--}}
{{--        <option value="DE">Germany</option>--}}
{{--    </select>--}}
{{--</form>--}}

{{--form.frontend-selector {--}}
{{--max-width: var(--tw-width-sm);--}}
{{--margin-left: auto;--}}
{{--margin-right: auto;--}}
{{--}--}}

{{--form.frontend-selector > label {--}}
{{--display: block;--}}
{{--margin-bottom: var(--tw-size-2);--}}
{{--font-size: var(--tw-font-size-sm);--}}
{{--line-height: var(--tw-line-height-5);--}}
{{--font-weight: var(--tw-font-weight-medium);--}}
{{----tw-text-opacity: 1;--}}
{{--color: rgb(var(--tw-color-gray-900) / var(--tw-text-opacity));--}}
{{--}--}}

{{--:is(.dark form.frontend-selector > label) {--}}
{{----tw-text-opacity: 1;--}}
{{--color: rgb(var(--tw-color-white) / var(--tw-text-opacity));--}}
{{--}--}}

{{--form.frontend-selector > select {--}}
{{----tw-bg-opacity: 1;--}}
{{--background-color: rgb(var(--tw-color-gray-50) / var(--tw-bg-opacity));--}}
{{--border-width: 1px;--}}
{{----tw-border-opacity: 1;--}}
{{--border-color: rgb(var(--tw-color-gray-300) / var(--tw-border-opacity));--}}
{{----tw-text-opacity: 1;--}}
{{--color: rgb(var(--tw-color-gray-900) / var(--tw-text-opacity));--}}
{{--font-size: var(--tw-font-size-sm);--}}
{{--line-height: var(--tw-line-height-5);--}}
{{--border-radius: var(--tw-border-radius-lg);--}}
{{--}--}}

{{--form.frontend-selector > select:focus {--}}
{{----tw-ring-opacity: 1;--}}
{{----tw-ring-color: rgb(var(--tw-color-blue-500) / var(--tw-ring-opacity));--}}
{{----tw-border-opacity: 1;--}}
{{--border-color: rgb(var(--tw-color-blue-500) / var(--tw-border-opacity));--}}
{{--}--}}

{{--form.frontend-selector > select {--}}
{{--display: block;--}}
{{--width: 100%;--}}
{{--padding: var(--tw-size-2_5);--}}
{{--}--}}

{{--:is(.dark form.frontend-selector > select) {--}}
{{----tw-bg-opacity: 1;--}}
{{--background-color: rgb(var(--tw-color-gray-700) / var(--tw-bg-opacity));--}}
{{----tw-border-opacity: 1;--}}
{{--border-color: rgb(var(--tw-color-gray-600) / var(--tw-border-opacity));--}}
{{--}--}}

{{--:is(.dark form.frontend-selector > select)::-moz-placeholder {--}}
{{----tw-placeholder-opacity: 1;--}}
{{--color: rgb(var(--tw-color-gray-400) / var(--tw-placeholder-opacity));--}}
{{--}--}}

{{--:is(.dark form.frontend-selector > select)::placeholder {--}}
{{----tw-placeholder-opacity: 1;--}}
{{--color: rgb(var(--tw-color-gray-400) / var(--tw-placeholder-opacity));--}}
{{--}--}}

{{--:is(.dark form.frontend-selector > select) {--}}
{{----tw-text-opacity: 1;--}}
{{--color: rgb(var(--tw-color-white) / var(--tw-text-opacity));--}}
{{--}--}}

{{--:is(.dark form.frontend-selector > select:focus) {--}}
{{----tw-ring-opacity: 1;--}}
{{----tw-ring-color: rgb(var(--tw-color-blue-500) / var(--tw-ring-opacity));--}}
{{----tw-border-opacity: 1;--}}
{{--border-color: rgb(var(--tw-color-blue-500) / var(--tw-border-opacity));--}}
{{--}--}}
