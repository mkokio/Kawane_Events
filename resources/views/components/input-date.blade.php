<div class="mb-3">
    <label for="{{ $for }}" class="form-label">{{ __($label) }}</label>
    <br/>
    <input type="{{ $type }}" id="{{ $for }}" name="{{ $for }}" class="form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" {{ $attributes }}>
</div>

<!-- The set language of the user's browser will determine the date format
    Japanese -> YYYY/MM/DD
    English -> MM/DD/YYY
-->
