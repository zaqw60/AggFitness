@props(['class' => $class, 'type' => 'submit'])

<button {{ $attributes->class([$class])->merge([$type]) }}>{{ $slot }}</button>
