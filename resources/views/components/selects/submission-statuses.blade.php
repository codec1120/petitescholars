@props(['model','label' => 'Submission Status'])
<div>
    <x-forms.select
        :id="Str::slug($label)"
        :label="$label"
        :options="[
            [
                'label' => 'Submitted',
                'value' => 'Submitted'
            ],
            [
                'label' => 'Not Submitted',
                'value' => 'Not Submitted'
            ]
        ]"
        placeholder="Select"
        :error="$model"
        wire:model.defer="{{ $model }}"
    />
</div>