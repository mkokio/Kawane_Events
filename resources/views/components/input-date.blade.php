<div class="row">
    <div class="col-sm-6">
        <div class="d-flex align-items-center">
            <label for="{{ $for }}" class="form-label mt-4" style="width: 150px;">{{ __($label) }}</label>
            <input type="date" id="{{ $for }}" name="{{ $for }}" class="form-control mt-4" {{ $attributes }}>
        </div>  
    </div>
</div>

<!-- The set language of the user's browser will determine the date format
    Japanese -> YYYY/MM/DD
    English -> MM/DD/YYY
-->