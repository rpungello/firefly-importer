@php use App\Enums\Filetype; @endphp
<div class="space-y-4">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('dashboard')">{{ __('Home') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('accounts.index')">{{ __('Accounts') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $account->name }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <form wire:submit.prevent="submit" class="space-y-4">
        <flux:input :label="__('Name')" wire:model="name"/>
        <flux:input :label="__('Firefly ID')" wire:model="firefly_id" type="number"/>
        <flux:input :label="__('Account #')" wire:model="account_number"/>
        <flux:checkbox :label="__('Credit Card')" wire:model="credit_card"/>
        <flux:checkbox :label="__('Has Headers')" wire:model="headers"/>
        <flux:radio.group wire:model="filetype" :label="__('Filetype')" variant="segmented">
            @foreach(Filetype::cases() as $filetype)
                <flux:radio :value="$filetype->value" :label="$filetype->name"/>
            @endforeach
        </flux:radio.group>

        <flux:button type="submit" variant="primary">
            {{ __('Save') }}
        </flux:button>

        <flux:modal.trigger name="add-field">
            <flux:button>{{ __('Add Field') }}</flux:button>
        </flux:modal.trigger>
    </form>

    <flux:table>
        <flux:table.columns>
            <flux:table.column>{{ __('Source Name') }}</flux:table.column>
            <flux:table.column>{{ __('Destination Field') }}</flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach($account->fields as $field)
                <flux:table.row>
                    <flux:table.cell>
                        <flux:link :href="route('fields.edit', $field)">
                            {{ $field->source_name }}
                        </flux:link>
                    </flux:table.cell>
                    <flux:table.cell>{{ $field->destination_field }}</flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>

    <flux:modal name="add-field">
        <form class="space-y-6" wire:submit.prevent="saveField">
            <div>
                <flux:heading size="lg">Add a new field</flux:heading>
                <flux:text class="mt-2">You'll be able to configure additional settings once created</flux:text>
            </div>
            <flux:input wire:model="newFieldSource" :label="__('Source Name')" />
            <flux:input wire:model="newFieldDestination" :label="__('Destination Field')" />
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary">{{ __('Save') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
