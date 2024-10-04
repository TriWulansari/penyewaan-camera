<?php

namespace App\Livewire;

use App\Models\Camera;
use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class TransaksiComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $addPage, $lihatPage = false;
    public $nama, $noponsel, $alamat, $lama, $tanggal, $camera_id, $harga, $total;
    public function render()
    {
        $data['camera'] = Camera::paginate(5);
        return view('livewire.transaksi-component', $data);
    }

    public function create($id, $harga)
    {
        $this->camera_id = $id;
        $this->harga = $harga;
        $this->addPage = true;
    }

    public function hitung()
    {
        $lama = $this->lama;
        $harga = $this->harga;
        $this->total = $lama * $harga;    
    }

    public function store()
    {
    
        $this->validate([
            'nama' => 'required',
            'noponsel' => 'required',
            'alamat' => 'required',
            'lama' => 'required',
            'tanggal' => 'required'
        ]);
        $cari = Transaksi::where('camera_id',$this->camera_id)
        ->where('tgl_pesan',$this->tanggal)->where('status', '!=', 'SELESAI',)->count();
        if($cari == 1){
            session()->flash('error' , 'Camera sudah ada yang memesan!');
        }
        else{
            Transaksi::create([
                'camera_id' => $this->camera_id,
                'nama' => $this->nama,
                'noponsel' => $this->noponsel,
                'alamat' => $this->alamat,
                'lama' => $this->lama,
                'tgl_pesan' => $this->tanggal,
                'total' => $this->total,
                'status' => 'WAIT'
            ]);
            session()->flash('success', 'Transaksi berhasil di simpan !');
        }
        $this->dispatch('lihat-transaksi');
        $this->reset();
    }

    public function lihat()
    {
        $data['transaksi']=Transaksi::paginate(10);
        return view('tran');
    }
}
