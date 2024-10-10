<div class="col-md-5">
    <div class="card border-0 shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Permission</h6>
        </div>
        <div class="card-body">
        <form action="{{ route('admin.roles.add-permission') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Permission Name</label>
                <input type="text" name="name" class="form-control" placeholder="Role Name">
            </div>
            <div class="mb-3">
                <label class="form-label">Roles</label>
                <select multiple name="roles[]" class="form-control select2" style="width: 100%;">
                    @foreach ($roles as $item)
                        <option value="{{ $item->id }}" class="font-weight-bold">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary"> Tambah</button>
        </form>
        </div>
    </div>
</div>

