@props(['id' => ''])

<tr {{ $attributes->merge(['id' => $id]) }}>
    {{ $slot }}
</tr>
