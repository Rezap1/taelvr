@props(['name', 'label' => 'Gambar / Foto', 'value' => null, 'required' => false, 'help' => 'Format: jpg, png, webp. Maks: 2MB.', 'maxHeight' => '200px'])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{!! $label !!} {!! $required ? '<span class="text-danger">*</span>' : '' !!}</label>
    
    @if($value)
        <div class="mb-2">
            <img src="{{ asset('storage/'.$value) }}" alt="Preview" class="img-thumbnail" style="max-height: {{ $maxHeight }}">
        </div>
    @endif
    
    <input class="form-control @error($name) is-invalid @enderror" type="file" id="{{ $name }}" name="{{ $name }}" accept="image/*" {{ $required && !$value ? 'required' : '' }} onchange="previewImage(this, 'preview-{{ $name }}')">
    
    <div class="mt-2 d-none" id="preview-container-{{ $name }}">
        <p class="mb-1 small text-muted">Preview Gambar Baru:</p>
        <img id="preview-{{ $name }}" src="#" alt="Preview" class="img-thumbnail" style="max-height: {{ $maxHeight }}">
    </div>
    
    @if($help)
        <div class="form-text">{!! $help !!}</div>
    @endif
    
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@once
    @push('scripts')
    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const container = document.getElementById('preview-container-' + input.name);
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.classList.remove('d-none');
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                container.classList.add('d-none');
            }
        }
    </script>
    @endpush
@endonce
