
<div
    wire:ignore
    x-data
    x-init="
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.setOptions({
            allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
            acceptedFileTypes: [
                'application/pdf',
                'image/*'
            ],
            maxFileSize: '1MB',
            maxFiles: 4,
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
                },
            },
        });
        FilePond.create($refs.input);
    "
>
    <input type="file" accept="image/*,application/pdf" x-ref="input" >
</div>