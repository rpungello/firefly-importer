@php use App\Enums\Filetype; @endphp
<div class="space-y-4">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item :href="route('dashboard')">{{ __('Home') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item :href="route('accounts.index')">{{ __('Accounts') }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ __('Create Account') }}</flux:breadcrumbs.item>
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
            {{ __('Create') }}
        </flux:button>
    </form>
</div>
