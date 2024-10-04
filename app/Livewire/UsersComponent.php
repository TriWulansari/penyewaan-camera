<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UsersComponent extends Component
{   
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $addPage, $editPage = false;
    public $email, $password, $role, $id;
    public function render()
    {
        $data['user'] = User::paginate(2);
        return view('livewire.users-component', $data);
    }

    public function create()
    {
        $this->reset();
        $this->addPage = true;
    }

    public function store()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ],[
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi',
            'role.required' => 'Role harus diisi'
        ]);

        User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role
        ]);
        session()->flash('success', 'Berhasil Simpan Data!!');
        $this->reset();
    }

    public function destroy($id)
    {
        $cari = User::find($id);
        $cari->delete();
        session()->flash('success', 'Berhasil Hapus Data!!');
        $this->reset();
    }

    public function edit($id)
    {
        $this->reset();
        $cari = User::find($id);
        $this->email = $cari->email;
        $this->password = $cari->password;
        $this->role = $cari->role;
        $this->id = $cari->id;
        $this->editPage = true;
    }

    public function update()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ],[
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi',
            'role.required' => 'Role harus diisi'
        ]);

        $cari = User::find($this->id);
        $cari->update([
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role
        ]);
        session()->flash('success', 'Berhasil Update Data!!');
        $this->reset();
    }
}
