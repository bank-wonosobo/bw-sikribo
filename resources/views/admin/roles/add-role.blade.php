@can('bw:auth:role:add')
<div class="col-md-7">
    <div class="card border-0 shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Role</h6>
        </div>
        <div class="card-body">
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Role Name</label>
                <input type="text" name="name" class="form-control" placeholder="Role Name">
            </div>
            <div class="form-group">
                <label>Label</label>
                <input type="text" name="label" class="form-control" placeholder="Label Role">
            </div>
            <button type="submit" class="btn btn-primary"> Tambah</button>
        </form>
        </div>
    </div>
</div>
@endcan

