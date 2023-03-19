@props(['scope' => 'col'])

<th {{ $attributes->merge(['scope' => $scope]) }}>
    {{ $slot }}
</th>
