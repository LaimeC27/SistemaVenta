<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Profile Information') }}</h2>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="updateProfileInformation">
                        <!-- Profile Photo -->
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div x-data="{photoName: null, photoPreview: null}">
                            <!-- Profile Photo File Input -->
                            <input type="file" id="photo" class="form-control hidden" wire:model.live="photo" x-ref="photo" x-on:change="
                                                photoName = $refs.photo.files[0].name;
                                                const reader = new FileReader();
                                                reader.onload = (e) => {
                                                    photoPreview = e.target.result;
                                                };
                                                reader.readAsDataURL($refs.photo.files[0]);
                                        " />

                            <x-label for="photo" value="{{ __('Photo') }}" />

                            <!-- Current Profile Photo -->
                            <div class="mt-2" x-show="! photoPreview">
                                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                            </div>

                            <!-- New Profile Photo Preview -->
                            <div class="mt-2" x-show="photoPreview" style="display: none;">
                                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center" x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                </span>
                            </div>

                            <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                                {{ __('Select A New Photo') }}
                            </x-secondary-button>

                            @if ($this->user->profile_photo_path)
                            <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                                {{ __('Remove Photo') }}
                            </x-secondary-button>
                            @endif

                            <x-input-error for="photo" class="mt-2" />
                        </div>
                        @endif

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control" wire:model="state.name" required autocomplete="name" />
                            <x-input-error for="name" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control" wire:model="state.email" required autocomplete="username" />
                            <x-input-error for="email" class="mt-2" />

                            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                            <p class="text-sm mt-2">
                                {{ __('Your email address is unverified.') }}

                                <button type="button" class="btn btn-link text-sm text-gray-600" wire:click.prevent="sendEmailVerification">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if ($this->verificationLinkSent)
                            <p class="mt-2 font-medium text-sm text-success">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                            @endif
                            @endif
                        </div>

                        <div>
                            <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="photo">
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