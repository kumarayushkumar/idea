 @props(['label', 'placeholder', 'name', 'type' => 'text'])

 <div class="space-y-2">
     <label for="{{ $name }}" class="label">{{ $label }}</label>
     <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name) }}" placeholder="{{ $placeholder }}"
         class="input" {{ $attributes }}>

     @error($name)
         <p class="error">{{ $message }}</p>
     @enderror
 </div>
