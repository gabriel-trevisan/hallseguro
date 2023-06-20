@props(['errors'])

@if ($errors->any())
<div {{ $attributes }}>
    <div class="alert-box danger-alert">
        <div class="alert">
            <h4 class="alert-heading">{{ __('Whoops! Algo está errado.') }}</h4>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600 text-medium">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif