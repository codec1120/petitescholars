@props(['model','label' => 'Completion Status'])
<div>
    <x-forms.select
        :id="Str::slug($label)"
        :label="$label"
        :options="[
            [
                'label' => 'Completed',
                'value' => 'Completed'
            ],
            [
                'label' => 'Not Complete',
                'value' => 'Not Complete'
            ]
        ]"
        placeholder="Select"
        :error="$model"
        wire:model.defer="{{ $model }}"
    />
</div>