<label for="{{ $for }}" class="form-label mt-3">{{ __($label) }}</label>
<br/>
<input type="{{ $type }}" id="{{ $for }}" name="{{ $for }}" class="form-control" {{ $attributes }}>


<!-- The set language of the user's browser will determine the date format
    Japanese -> YYYY/MM/DD
    English -> MM/DD/YYY
-->
