<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-muted mb-4">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="mb-3">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <div class="form-text">{{ __('Your full name as you\'d like others to see it.') }}</div>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required autocomplete="username" />
            <div class="form-text">{{ __('This email will be used for notifications and login.') }}</div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-3">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="btn btn-link p-0 ms-2 text-decoration-none">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div class="alert alert-success mt-2">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ __('A new verification link has been sent to your email address.') }}
                    </div>
                @endif
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-primary px-4">
                <i class="fas fa-save me-2"></i>{{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-success mb-0"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                >
                    <i class="fas fa-check me-1"></i>{{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>