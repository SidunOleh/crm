@props(['options',])

<div class="mb-3">

  @error($attributes->get('name'))
      <div class="alert alert-danger">{{ $message }}</div>
  @enderror


  <label class="form-label">{{ $slot }}</label>

  <select {{ $attributes->merge([
      
      'class' => 'form-select',
    
    ]) }} >

   
    @foreach (explode(',', $options) as $option)

      @if ($option == old('type'))
         
         <x-select.item value="{{ $option }}" selected>
         
          {{ ucfirst($option) }}
        
         </x-select.item>
     
      @else

        <x-select.item value="{{ $option }}">
          
          {{ ucfirst($option) }}
        
         </x-select.item>
     
      @endif

    @endforeach
     
  
  </select>

</div>
