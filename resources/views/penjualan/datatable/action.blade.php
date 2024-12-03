<div class="btn-group" role="group">
    <div class="mx-1">
        <button type="button" data-id="{{ $model->id }}" class="btn btn-primary btn-sm penjualan-detail"
            data-bs-toggle="modal" data-bs-target="#showPenjualanModal">
            <i class="bi bi-search"></i>
        </button>
    </div>

    @auth
        <div class="mx-1">
            <button type="button" data-id="{{ $model->id }}" class="btn btn-success btn-sm penjualan-edit"
                data-bs-toggle="modal" data-bs-target="#editPenjualanModal">
                <i class="bi bi-pencil-square"></i>
            </button>
        </div>

        <div class="mx-1">
            <form action="{{ route('penjualans.destroy', $model->id) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm delete-notification">
                    <i class="bi bi-trash-fill"></i>
                </button>
            </form>
        </div>
    @endauth
</div>
