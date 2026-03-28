@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm w-fit rounded-md bg-red-600 p-1 dark:text-white space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
