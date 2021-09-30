<form action="{{ url('/admin/menus/'.$menu->id.'/update') }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="sub-menu-name-create" class="form-control" value="{{ $menu->name }}">
    </div>
    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" name="slug" class="form-control" id="sub-menu-slug-update" value="{{ $menu->slug }}">
    </div>
    <div class="form-group">
        <label for="inputClientCompany">Status</label>
        <select name="status" class="form-control" id="menu-status">
            <option @if($menu->status == 0) selected @endif value="0">UnActive</option>
            <option @if($menu->status == 1) selected @endif value="1">Active</option>
        </select>
    </div>
    <div class="form-group">
        <label for="info">Info</label>
        <textarea id="inputDescription" name="info" class="form-control" rows="4">{{ $menu->info }}</textarea>
    </div>
    <div class="form-group">
        <label for="sort">Sort</label>
        <input type="text" name="sort" id="inputProjectLeader" class="form-control" value="{{ $menu->sort }}">
    </div>
    <div class="form-group">
        <label for="parent_id">Parent menu</label>
        <select name="parent_id" class="form-control" id="parent-menu">
            @if(!empty($menus))
                @foreach($menus as $value)
                    <option @if($value->id == $menu->id) selected @endif value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="Add new" class="btn btn-primary float-right" value="Update">
    </div>
</form>
<!-- /.card-body -->
