<!-- resources/views/upload.blade.php -->
@extends('layouts.master')

@section('style')
<style>
    .file-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
        padding-bottom: 6px;
        border-bottom: 1px solid #eee;
    }

    .file-name {
        flex: 1;
        color: #444;
        font-size: 14px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .icon {
        display: inline-block;
        font-size: 1.2em;
        line-height: 1;
        margin-right: 0.5em;
    }

    .icon.success {
        color: green;
        padding-left: 8px;
    }

    .icon.remove {
        color: red;
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-8 col-sm-12 mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="fw-bold py-2">Page Form</div>
            <div class="p-2">
                Page Form -
                <a href="{{ route('home') }}" class="text-decoration-none fw-semibold">Dashboard</a>
            </div>
        </div>

        <div class="card p-3 shadow-sm">
            <div class="container py-3">
                <form id="uploadForm" action="{{ route('form/upload/save') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 row">
                        <label for="fileupload" class="form-label">Upload Files</label>
                        <div class="col-sm-3">
                            <input type="file" class="form-control" id="fileupload" name="fileupload[]" multiple>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-12">
                            <div id="file-list"></div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    const $input = $('#fileupload');
    const $list = $('#file-list');
    const files = [];

    const formatSize = bytes =>
        bytes < 1024 ? `${bytes} B` : `${(bytes / 1024).toFixed(1)} Kb`;

    $input.on('change', function () {
        Array.from(this.files).forEach(file => {
            const exists = files.some(f => f.name === file.name && f.size === file.size);
            if (!exists) {
                files.push(file);
            }
        });
        this.value = null;
        renderFileList();
    });

    $list.on('click', '.remove', e => {
        const index = $(e.target).data('idx');
        files.splice(index, 1);
        renderFileList();
    });

    function renderFileList() {
        const dataTransfer = new DataTransfer();
        $list.empty();

        files.forEach((file, index) => {
            dataTransfer.items.add(file);
            $list.append(`
                <div class="file-row">
                    <span class="file-name">${file.name}</span>
                    <span class="file-size">${formatSize(file.size)}</span>
                    <span class="icon success">✓</span>
                    <span class="icon remove" data-idx="${index}">✕</span>
                </div>
            `);
        });

        $input[0].files = dataTransfer.files;
    }
</script>
@endsection