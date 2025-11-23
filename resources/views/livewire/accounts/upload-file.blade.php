@php use App\Enums\Filetype; @endphp
<div class="space-y-4">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('dashboard')">{{ __('Home') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('accounts.index')">{{ __('Accounts') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('accounts.edit', $account)">{{ $account->name }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ __('Upload File') }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <form wire:submit.prevent="submit" class="space-y-4">
        <flux:file-upload wire:model="file" :label="__('Upload transactions')">
            <flux:file-upload.dropzone
                heading="Drop transaction list here"
                text="Must match the filetype specified for the account"
            />
        </flux:file-upload>

        <flux:button type="submit" variant="primary">
            {{ __('Upload') }}
        </flux:button>
    </form>
</div>
