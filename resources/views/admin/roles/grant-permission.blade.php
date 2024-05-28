<div class="modal fade" id="basicModal{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.roles.grant-permission', ['role_id' => $item->id]) }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Permission</label>
                    @foreach ($permissions as $permission)
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="custom-control-input" id="permission{{ $permission->id . $item->id }}" @if (in_array($permission->id, $item->permissions->pluck('id')->toArray()))
                        checked
                        @endif>
                        <label class="custom-control-label" for="permission{{ $permission->id . $item->id }}">
                            {{ $permission->name }}
                        </label>
                    </div>
                        {{-- <label class="custom-control-label" for="customCheck1"@if (in_array($permission->name, $item->permissions->pluck('name')->toArray()))
                        checked
                        @endif>Check this custom checkbox</label> --}}
                    @endforeach

                    {{-- <select multiple name="permissions[]" class="form-control select2" style="width: 100%;">
                        @foreach ($permissions as $permission)

                            <option value="{{ $permission->id }}" class="font-weight-bold" @if (in_array($permission->name, $item->permissions->pluck('name')->toArray()))
                                selected
                            @endif >{{ $permission->name }}</option>
                        @endforeach
                    </select> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            </form>
        </div>
    </div>
