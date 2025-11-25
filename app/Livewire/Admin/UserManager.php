<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UserManager extends Component
{
    use WithPagination;

    public $search = '';
    public $showCreateModal = false;
    public $showEditModal = false;
    public $editingUserId = null;

    public $name = '';
    public $email = '';
    public $password = '';
    public $usertype = 'user';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'usertype' => 'required|in:user,admin,airline',
    ];

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.admin.user-manager', compact('users'));
    }

    public function openCreateModal()
    {
        $this->resetExcept('search');
        $this->showCreateModal = true;
    }

    public function closeCreateModal()
    {
        $this->showCreateModal = false;
        $this->resetExcept('search');
    }

    public function openEditModal($userId)
    {
        $user = User::findOrFail($userId);
        $this->editingUserId = $userId;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->usertype = $user->usertype;
        $this->password = '';
        $this->showEditModal = true;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->resetExcept('search');
    }

    public function createUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'usertype' => 'required|in:user,admin,airline',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'usertype' => $this->usertype,
        ]);

        $this->closeCreateModal();
        session()->flash('message', 'User created successfully!');
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|max:255|unique:users,email,{$this->editingUserId}",
            'usertype' => 'required|in:user,admin,airline',
        ]);

        $user = User::findOrFail($this->editingUserId);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->usertype = $this->usertype;

        if (filled($this->password)) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        $this->closeEditModal();
        session()->flash('message', 'User updated successfully!');
    }

    public function deleteUser($userId)
    {
        User::findOrFail($userId)->delete();
        session()->flash('message', 'User deleted successfully!');
    }
}
