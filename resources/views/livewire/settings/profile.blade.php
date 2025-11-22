<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public $photo = null;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Upload and set profile photo.
     */
    public function uploadProfilePhoto(): void
    {
        $user = Auth::user();

        // Regular file upload
        $this->validate([
            'photo' => ['required', 'image', 'max:2048'],
        ]);

        $path = $this->photo->store('profile-photos', 'public');

        $user->profile_photo = $path;
        $user->save();

        $this->dispatch('profile-photo-updated', path: $path);
    }

    

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Profile photo</label>
                <div wire:ignore>
                <div class="flex items-center gap-4">
                    <div>
                        @if (auth()->user()->profile_photo)
                            <img id="profilePreview" src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="avatar" class="w-20 h-20 rounded-full object-cover border" />
                        @else
                            <img id="profilePreview" src="{{ asset('img/girl.jpg') }}" alt="avatar" class="w-20 h-20 rounded-full object-cover border" />
                        @endif
                    </div>
                    <div>
                        <input id="photoInput" type="file" accept="image/*" wire:model="photo" />
                        <div class="mt-2">
                            <flux:button wire:click.prevent="uploadProfilePhoto" variant="outline">Save photo</flux:button>
                            <flux:button id="selectFileBtn" variant="outline" onclick="document.getElementById('photoInput').click(); return false;">Change photo</flux:button>
                        </div>
                        @error('photo') <div class="text-sm text-red-600 mt-2">{{ $message }}</div> @enderror
                    </div>
                </div>
                </div>

                <!-- Cropping removed: file input will be uploaded directly -->
            </div>
            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full" data-test="update-profile-button">
                        {{ __('Save') }}
                    </flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
