<input type="radio" name="{{ $resource . '.' . $operation }}" class="permission-radio"
       attr-resource="{{ $resource }}"
       attr-operation="{{ $operation }}"
       attr-value="{{ $value}}" {{ $permission == $value ? 'checked' : '' }}>
