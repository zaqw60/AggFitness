@props(['class' => $class,'href' => '#', 'title' => '', 'style' => '', 'rel' => ''])

<a {{ $attributes->class([$class])->merge(['href' => $href, 'title' => $title, 'style' => $style, 'rel' => $rel]) }}>
    {{ $slot }}
</a>
