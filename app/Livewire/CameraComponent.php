<?php

namespace App\Livewire;

use App\Models\Camera;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CameraComponent extends Component
{
    use WithFileUploads;
    use WithPagination, WithoutUrlPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $addPage, $editPage = false;
    public $jenis,$kapasitas,$harga,$foto,$id;
    public function render()
    {
        $data['camera']=Camera::paginate(10);
        return view('livewire.camera-component', $data);
    }

    public function create()
    {
        $this->addPage=true;
    }

    public function store()
    {
        $this->validate([
            'jenis' => 'required',
            'kapasitas' => 'required',
            'harga' => 'required',
            'foto' => 'required|image'
        ],[
            'jenis.required' => 'jenis camera tidak boleh kosong !',
            'kapasitas.required' => 'kapasitas tidak boleh kosong  !',
            'harga.required' => 'harga tidak boleh kosong !',
            'foto.required' => 'foto tidak boleh kosong !',
            'foto.image' =>'foto dalam image !'
        ]);

        $this->foto->storeAs('/public/storage/camera', $this->foto->hashName());
        Camera::create([
            'jenis' => $this->jenis,
            'kapasitas' => $this->kapasitas,
            'harga' => $this->harga,
            'foto' => $this->foto->hashName()
        ]);
        session()->flash('succes', 'Berhasil simpan data !');
        $this->reset();
    }

    public function destroy($id)
    {
        $data = Camera::find($id);
        $data->delete();
        session()->flash('succes', 'Berhasil hapus data !');
        $this->reset();
    }

    public function edit($id)
    {
        $data = Camera::find($id);
        $this->editPage = true;
        $this->id = $data->id;
        $this->jenis = $data->jenis;
        $this->kapasitas = $data->kapasitas;
        $this->harga = $data->harga;
        $this->foto = $data->foto;
    }

    public function update()
    {
        $camera = Camera::find($this->id);
       if (empty($this->foto)) {
            $camera->update([
                'jenis' => $this->jenis,
                'kapasitas' => $this->kapasitas,
                'harga' => $this->harga
            ]);
       } else {
            $camera->update([
                'jenis' => $this->jenis,
                'kapasitas' => $this->kapasitas,
                'harga' => $this->harga,
                'foto' => $this->foto
            ]);
       }
        session()->flash('succes', 'Berhasil update data !');
        $this->reset();
    }
}
