    {{-- <div class="modal fade" id="createModal{{ $user->id }}" tabindex="-1" data-bs-backdrop="false">
        <form method="POST" onSubmit="if(!confirm('Yakin ingin membuat password ?')){return false;}" action="{{ route('admin.users.create-password', $user->id) }}">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Password User {{ $user->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" value="{{ old('password') }}"></input>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            </div>
        </div>
        </form>
    </div> --}}

<div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" onSubmit="if(!confirm('Yakin ingin membuat password ?')){return false;}" action="{{ route('admin.users.create-password', $user->id) }}">
            @csrf
            <div class="modal-body">
               <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" value="{{ old('password') }}"></input>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>
