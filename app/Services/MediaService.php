<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaService
{
    /**
     * Upload a file and create a Media record.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param string|null $title
     * @param string $disk
     * @return Media
     */
    public function upload(UploadedFile $file, string $folder = 'uploads', ?string $title = null, string $disk = 'public'): Media
    {
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mimeType = $file->getClientMimeType();
        $size = $file->getSize();
        
        // Generate safe filename
        $safeName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '-' . time() . '.' . $extension;
        
        // Determine file type category
        $fileType = 'document';
        if (str_starts_with($mimeType, 'image/')) {
            $fileType = 'image';
        } elseif (str_starts_with($mimeType, 'video/')) {
            $fileType = 'video';
        }

        // Store file
        $path = $file->storeAs($folder, $safeName, $disk);

        // Create Media record
        return Media::create([
            'title' => $title ?? pathinfo($originalName, PATHINFO_FILENAME),
            'file_name' => $originalName,
            'file_path' => $path,
            'file_type' => $fileType,
            'mime_type' => $mimeType,
            'file_size' => $size,
            'disk' => $disk,
        ]);
    }

    /**
     * Update an existing Media record with a new file.
     *
     * @param Media $media
     * @param UploadedFile $file
     * @return Media
     */
    public function updateFile(Media $media, UploadedFile $file): Media
    {
        // Delete old file from storage
        $this->deleteFileFromStorage($media);

        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mimeType = $file->getClientMimeType();
        $size = $file->getSize();
        
        $folder = dirname($media->file_path);
        if ($folder === '.') $folder = 'uploads';
        
        $safeName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '-' . time() . '.' . $extension;
        
        $fileType = 'document';
        if (str_starts_with($mimeType, 'image/')) {
            $fileType = 'image';
        } elseif (str_starts_with($mimeType, 'video/')) {
            $fileType = 'video';
        }

        $path = $file->storeAs($folder, $safeName, $media->disk);

        $media->update([
            'file_name' => $originalName,
            'file_path' => $path,
            'file_type' => $fileType,
            'mime_type' => $mimeType,
            'file_size' => $size,
        ]);

        return $media;
    }

    /**
     * Delete file from storage and remove Media record permanently.
     *
     * @param Media $media
     * @return bool
     */
    public function deletePermanently(Media $media): bool
    {
        $this->deleteFileFromStorage($media);
        return $media->forceDelete();
    }

    /**
     * Delete only the physical file from storage.
     *
     * @param Media $media
     * @return bool
     */
    private function deleteFileFromStorage(Media $media): bool
    {
        if (Storage::disk($media->disk)->exists($media->file_path)) {
            return Storage::disk($media->disk)->delete($media->file_path);
        }
        return false;
    }
}
