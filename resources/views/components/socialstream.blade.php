<div class="space-y-6 mt-6 mb-2">
    <x-input-error :messages="$errors->get('socialstream')" class="text-center"/>
    <div class="grid gap-4">
        <div class="main-border-button">
            @foreach (\JoelButcher\Socialstream\Socialstream::providers() as $provider)
                <a class="flex items-center justify-center gap-2 transition duration-200 border border-gray-400 w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md"
                   href="{{ route('oauth.redirect', $provider['id']) }}">
                    <span class="font-medium text-sm text-gray-700 dark:text-gray-300">{{ $provider['buttonLabel'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>
