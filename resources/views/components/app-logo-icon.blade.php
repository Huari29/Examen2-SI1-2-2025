@props(['class' => 'size-9 fill-current text-black dark:text-white'])

<img src="{{ asset('imagenes/uagrm.svg') }}" 
     alt="Logo uagrm" 
     {{ $attributes->merge(['class' => $class]) }}>