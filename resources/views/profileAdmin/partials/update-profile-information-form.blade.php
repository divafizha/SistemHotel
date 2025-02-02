<section>
    <header>
        <h2 class="text-lg font-medium text-gray-700">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-700">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profileAdmin.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="Nama" :value="__('Nama')" />
            <x-text-input id="Nama" name="Nama" type="text" class="mt-1 block w-full text-gray-700" :value="old('Nama', $user->Nama)" required autofocus autocomplete="Nama" />
            <x-input-error class="mt-2" :messages="$errors->get('Nama')" />
        </div>

        <div>
            <x-input-label for="Email" :value="__('Email')" />
            <x-text-input id="Email" name="Email" type="email" class="mt-1 block w-full text-gray-700" :value="old('Email', $user->Email)" required autocomplete="Email" />
            <x-input-error class="mt-2" :messages="$errors->get('Email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
