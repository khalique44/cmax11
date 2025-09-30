@extends('layouts.app')

@section('head')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<style>
    .media-thumb { cursor: pointer; margin: 10px; position: relative; display: inline-block; }
    .media-thumb img { border-radius: 10px; border: 2px solid #ddd; }
    .media-thumb .delete-btn {
        position: absolute; top: 5px; right: 5px;
        background: red; color: white;
        border: none; padding: 2px 6px; border-radius: 50%;
    }
</style>
@endsection

@section('content')
<h2>Media Library</h2>

<input type="file" name="file" id="fileUpload" multiple>

<hr>

<button onclick="openMediaLibrary()">📁 Open Media Library</button>

<!-- Modal -->
<div id="mediaModal" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.7); z-index:1000;">
    <div style="background:white; padding:20px; width:90%; max-width:1000px; margin:50px auto; border-radius:8px;">
        <h3>Media Library</h3>
        <div id="mediaGallery" style="display:flex; flex-wrap:wrap;"></div>
        <button onclick="closeMediaLibrary()">Close</button>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script>
    FilePond.registerPlugin(FilePondPluginImagePreview);
    const pond = FilePond.create(document.querySelector('#fileUpload'));

    FilePond.setOptions({
        server: {
            process: {
                url: '{{ route("admin.media.upload") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            }
        }
    });

    function openMediaLibrary() {
        document.getElementById('mediaModal').style.display = 'block';
        fetchMedia();
    }

    function closeMediaLibrary() {
        document.getElementById('mediaModal').style.display = 'none';
    }

    function fetchMedia() {
        fetch('{{ route("admin.media.list") }}')
            .then(res => res.json())
            .then(data => {
                const gallery = document.getElementById('mediaGallery');
                gallery.innerHTML = '';
                data.forEach(media => {
                    const div = document.createElement('div');
                    div.className = 'media-thumb';
                    div.innerHTML = `
                        <img src="${media.url}" width="150">
                        <button class="delete-btn" onclick="deleteMedia(${media.id})">&times;</button>
                    `;
                    div.onclick = () => alert("Selected Media ID: " + media.id); // or fire event
                    gallery.appendChild(div);
                });
            });
    }

    function deleteMedia(id) {
        if (!confirm('Delete this image?')) return;
        fetch(`/admin/media/delete/${id}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        }).then(() => fetchMedia());
    }
</script>
@endsection
