@props(['model'])
<div>
    <x-forms.select
        id="role-selector"
        label="Role"
        :options="App\Models\Role::get()->transform(
            fn ($role) => [
                'label' => $role->role_name,
                'value' => $role->role
            ]
        )"
        placeholder="Select Role"
        :error="$model"
        wire:model.defer="{{ $model }}"
    />
</div>