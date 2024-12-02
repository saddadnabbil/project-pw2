<div class="btn-group" role="group">
    <div class="mx-1">
        <button type="button" data-id="{{ $model->id }}" class="btn btn-primary btn-sm supplier-detail"
            data-bs-toggle="modal" data-bs-target="#showSupplierModal">
            <i class="bi bi-search"></i>
        </button>
    </div>

    @auth
        <div class="mx-1">
            <button type="button" data-id="{{ $model->id }}" class="btn btn-success btn-sm supplier-edit"
                data-bs-toggle="modal" data-bs-target="#editSupplierModal">
                <i class="bi bi-pencil-square"></i>
            </button>
        </div>

        <div class="mx-1">
            <form action="{{ route('suppliers.destroy', $model->id) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm delete-notification">
                    <i class="bi bi-trash-fill"></i>
                </button>
            </form>
        </div>
    @endauth
</div>
