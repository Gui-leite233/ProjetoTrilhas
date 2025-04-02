<section>
    <div class="alert alert-danger">
        <h4 class="alert-heading">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ __('Atenção!') }}
        </h4>
        <p class="mb-0">
            {{ __('Assim que sua conta for deletada, todos os seus recursos e dados serão excluídos permanentemente. Antes de excluir sua conta, por favor, faça o download de qualquer informação ou dados que deseja manter.') }}
        </p>
    </div>

    <button class="btn btn-danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        <i class="fas fa-trash-alt me-2"></i>{{ __('Deletar Conta') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
            @csrf
            @method('delete')

            <div class="text-center mb-4">
                <i class="fas fa-exclamation-circle text-danger" style="font-size: 48px;"></i>
                <h4 class="mt-3">{{ __('Tem certeza que deseja deletar sua conta?') }}</h4>
                <p class="text-muted">{{ __('Esta ação não poderá ser desfeita.') }}</p>
            </div>

            <div class="mb-3">
                <x-input-label for="password" value="{{ __('Confirm your password') }}" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control"
                    placeholder="{{ __('Enter your password') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" class="btn btn-secondary me-2" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="btn btn-danger">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>