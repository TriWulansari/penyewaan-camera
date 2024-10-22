<?php

namespace App\Livewire;

use App\Models\Camera;
use Illuminate\Http\UploadedFile;
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
            'foto' => 'required|image|max:2048'
        ],[
            'jenis.required' => 'jenis camera tidak boleh kosong !',
            'kapasitas.required' => 'kapasitas tidak boleh kosong  !',
            'harga.required' => 'harga tidak boleh kosong !',
            'foto.required' => 'foto tidak boleh kosong !',
            'foto.image' =>'foto dalam image !'
        ]);

        $fillname = $this->foto->store('camera', 'public');
        Camera::create([
            'jenis' => $this->jenis,
            'kapasitas' => $this->kapasitas,
            'harga' => $this->harga,
            'foto' => $fillname
        ]);
        session()->flash('success', 'Berhasil simpan data !');
        $this->reset();
    }

    public function destroy($id)
    {
        $data = Camera::find($id);
        $data->delete();
        session()->flash('success', 'Berhasil hapus data !');
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
    
        // Validasi input
        $this->validate([
            'jenis' => 'required|string',
            'kapasitas' => 'required|string',
            'harga' => 'required|numeric',
            'foto' => 'nullable|image|max:2048', // Izinkan null untuk foto
        ]);
    
        // Jika foto baru diunggah
        if ($this->foto instanceof UploadedFile) {
            $fillname = $this->foto->store('camera', 'public');
            $camera->update([
                'jenis' => $this->jenis,
                'kapasitas' => $this->kapasitas,
                'harga' => $this->harga,
                'foto' => $fillname // Ganti dengan nama file baru
            ]);
        } else {
            // Jika tidak ada foto baru, hanya perbarui atribut lainnya
            $camera->update([
                'jenis' => $this->jenis,
                'kapasitas' => $this->kapasitas,
                'harga' => $this->harga
            ]);
        }
    
        session()->flash('success', 'Berhasil update data !');
        $this->reset();
    }
}
