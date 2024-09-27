<form action="" method="GET" id="frontend-selector-form">
    <select name="frontend" id="frontend-selector" onchange="document.getElementById('frontend-selector-form').submit()">
        <option value="welcome" {{ session('frontend', 'welcome') === 'welcome' ? 'selected' : '' }}>Default</option>
        <option value="angular" {{ session('frontend') === 'angular' ? 'selected' : '' }}>Angular</option>
        <!-- Add options for other frameworks -->
    </select>
</form>
