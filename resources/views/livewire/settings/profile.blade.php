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
        $user = \App\Models\User::find(Auth::id());

        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
        } else {
            $this->name = '';
            $this->email = '';
        }
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = \App\Models\User::find(Auth::id());

        if (! $user) {
            return;
        }

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
        $user = \App\Models\User::find(Auth::id());

        if (! $user) {
            return;
        }

        // Regular file upload
        $this->validate([
            'photo' => ['required', 'image', 'max:2048'],
        ]);

        // Build a safe filename and move the uploaded file into public/img
        $extension = strtolower($this->photo->getClientOriginalExtension() ?: $this->photo->extension() ?: 'png');
        $filename = uniqid('profile_', true) . '.' . $extension;

        $destinationDir = public_path('img');

        // Ensure destination directory exists and is writable
        if (! is_dir($destinationDir)) {
            @mkdir($destinationDir, 0755, true);
        }

        $moved = false;

        try {
            // Try the built-in move() first
            $this->photo->move($destinationDir, $filename);
            $moved = true;
        } catch (\Throwable $e) {
            // Fall back to copying the temporary uploaded file if move() fails
            $tempPath = $this->photo->getRealPath() ?: $this->photo->getPathname();

            if ($tempPath && is_file($tempPath)) {
                $destPath = $destinationDir . DIRECTORY_SEPARATOR . $filename;
                @copy($tempPath, $destPath);
                $moved = is_file($destPath);
            }
        }

        if (! $moved) {
            // If we still failed, abort silently (or you can add an error)
            $this->addError('photo', 'Failed to save uploaded image.');
            return;
        }

        // Save relative web path (public/img/<file>) on the model
        $user->profile_photo = 'img/' . $filename;
        $user->save();

        // Dispatch browser event with the new public patha
        $this->dispatch('profile-photo-updated', path: $user->profile_photo);
    }

    

    /**
     * Send an email verification notification to the current user.
     */
    // Email verification has been removed from this application.
    // Previous `resendVerificationNotification` logic intentionally removed.

    /**
     * Return the authenticated user as an Eloquent model instance, or null.
     */
    private function getUser(): ?\App\Models\User
    {
        $id = Auth::id();

        if (! $id) {
            return null;
        }

        return \App\Models\User::find($id);
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name, email, and profile photo.')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Profile photo</label>
                <div wire:ignore>
                <div class="flex items-center gap-4">
                    <div>
                        @php $pp = auth()->user()->profile_photo ?? null; @endphp
                        @if ($pp)
                            <img id="profilePreview" src="{{ asset($pp) }}" alt="avatar" class="w-14 h-14 rounded-full object-cover border" />
                        @else
                            <img id="profilePreview" src="{{ asset('img/default.jpg') }}" alt="avatar" class="w-10 h-10 rounded-full object-cover border" />
                        @endif
                    </div>
                    <div>
                        <input class="text-sm text-zinc-400" id="photoInput" type="file" accept="image/*" wire:model="photo" />
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

                {{-- Email verification UI removed --}}
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
