<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Update Password') }}</h2>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="updatePassword">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                            <input id="current_password" type="password" class="form-control" wire:model="state.current_password" autocomplete="current-password" />
                            <x-input-error for="current_password" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('New Password') }}</label>
                            <input id="password" type="password" class="form-control" wire:model="state.password" autocomplete="new-password" />
                            <x-input-error for="password" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password_confirmation" type="password" class="form-control" wire:model="state.password_confirmation" autocomplete="new-password" />
                            <x-input-error for="password_confirmation" class="mt-2" />
                        </div>

                        <div>
                            <button class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                            <x-action-message class="ms-3" on="saved">
                                {{ __('Saved.') }}
                            </x-action-message>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>