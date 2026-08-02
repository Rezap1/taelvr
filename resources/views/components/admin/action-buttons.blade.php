@props(['id', 'routePrefix', 'show' => true, 'edit' => true, 'delete' => true, 'deleteMessage' => 'Apakah Anda yakin ingin menghapus data ini?'])

<div class="d-flex justify-content-end gap-1">
    @if($show)
        <a href="{{ route($routePrefix . '.show', $id) }}" class="btn btn-sm btn-outline-info" title="Detail">
            <i class="fas fa-eye"></i>
        </a>
    @endif
    
    @if($edit)
        <a href="{{ route($routePrefix . '.edit', $id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
            <i class="fas fa-edit"></i>
        </a>
    @endif
    
    @if($delete)
        <form action="{{ route($routePrefix . '.destroy', $id) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ $deleteMessage }}')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endif
</div>
