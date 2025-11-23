<div class="space-y-4">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('dashboard')">{{ __('Home') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('accounts.index')">{{ __('Accounts') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('accounts.edit', $field->account)">{{ $field->account->name }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $field->destination_field }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <form class="space-y-4" wire:submit.prevent="save">
        <flux:input :label="__('Source Name')" wire:model="source_name"/>
        <flux:input :label="__('Destination Field')" wire:model="destination_field"/>
        <flux:textarea :label="__('Map')" wire:model="map" rows="20"/>

        <flux:button type="submit" variant="primary">
            {{ __('Save') }}
        </flux:button>
    </form>
</div>
