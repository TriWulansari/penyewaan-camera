<div>
    <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                @if (@session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                  </div>
                @endif
                <h6 class="mb-4">Data Camera</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Kapasitas</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Foto</th>
                            <th>
                                Proses
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($camera as $data)  
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data->jenis}}</td>
                            <td>{{ $data->kapasitas}}</td>
                            <td>@rupiah($data->harga)</td>
                            <td>
                                <img src="{{ asset('/public/storage/camera/' . $data->foto) }}" style="width: 100px;" alt="{{$data->jenis}}">
                            </td>
                            <td>
                                <button class="btn btn-info" wire:click="edit({{ $data->id }})">Edit</button>
                                <button class="btn btn-danger" wire:click="destroy({{ $data->id }})">Delete</button>
                            </td>
                        </tr>
                        @empty 
                            <tr >
                                <td colspan="7">Data Camera Belum Ada</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $camera->links() }}
                <button class="btn btn-primary" wire:click="create({{ $data->camera_id }})">Tambah</button>
               
            </div>
        </div>        
    </div>
    </div>
    @if ($addPage)
        @include('camera.create')
    @endif  
    @if ($editPage)
        @include('camera.edit')
    @endif
</div>