<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Add Camera</h6>
            <form>
                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis Camera</label>
                    <select name="" class="form-select" wire:model="jenis">
                        <option value="">--Pilih--</option>
                        <option value="canon">canon</option>
                        <option value="samsung">samsung</option>
                        <option value="sony">sony</option>
                    </select>
                    @error('jenis')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kapasitas" class="form-label">Kapasitas</label>
                    <input type="text" class="form-control" wire:model="kapasitas" id="kapasitas">
                    @error('kapasitas')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control" wire:model="harga" id="harga">
                    @error('harga')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" accept="camera/*" wire:model="foto" id="foto">
                    @error('foto')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="button" wire:click="store" class="btn btn-primary">Simpan</button>
            </form>
        </div>
        </div>
    </div>
</div>
