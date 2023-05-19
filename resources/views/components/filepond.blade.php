@props(['multiple' => false, 'model' => null, 'types' => '*'])
<div
    x-data='{
        multiple: @json($multiple),
        pond: null
    }'
    x-init="
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.registerPlugin(FilePondPluginFileValidateSize);
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.setOptions({
            labelIdle: 'Drag & Drop your file',
            acceptedFileTypes:
            [
                'application/pdf',
                'image/*'
            ],
            allowMultiple: this.multiple,
            maxFileSize: '1MB',
            maxFiles: 4,
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{!! $model !!}', file, load, error, progress)
                },
                revert: (filename, load) => {
                },
            },
        });
        const filepond = FilePond.create(
            $refs.filepond
        );
        pond = filepond;
    "
    wire:ignore
>
    <input type="file" x-ref="filepond" accept="{{ $types }}">
</div>