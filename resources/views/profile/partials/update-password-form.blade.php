<section>
    <p class="text-muted mb-4">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>

    <form method="post" action="{{ route('profile.password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="mb-3">
            <x-input-label for="current_password" :value="__('Current Password')" />
            <div class="input-group">
                <x-text-input id="current_password" name="current_password" type="password" 
                    class="form-control" autocomplete="current-password" />
                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('current_password')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="mb-3">
            <x-input-label for="password" :value="__('New Password')" />
            <div class="input-group">
                <x-text-input id="password" name="password" type="password" 
                    class="form-control" autocomplete="new-password" />
                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <div class="form-text">{{ __('Use at least 8 characters with a mix of letters, numbers & symbols.') }}</div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <div class="input-group">
                <x-text-input id="password_confirmation" name="password_confirmation" 
                    type="password" class="form-control" autocomplete="new-password" />
                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation')">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-primary px-4">
                <i class="fas fa-key me-2"></i>{{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-success mb-0"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                >
                    <i class="fas fa-check me-1"></i>{{ __('Updated.') }}
                </p>
            @endif
        </div>
    </form>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</section>