<div class="space-y-4">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('dashboard')">{{ __('Home') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('accounts.index')">{{ __('Accounts') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('accounts.edit', $field->account)">{{ $field->account->name }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $field->destination_field }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>
</div>
