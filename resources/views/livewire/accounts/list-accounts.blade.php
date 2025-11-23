<div>
    <flux:table :paginate="$accounts">
        <flux:table.columns>
            <flux:table.column>{{ __('Name') }}</flux:table.column>
            <flux:table.column>{{ __('Account #') }}</flux:table.column>
            <flux:table.column>{{ __('Credit Card') }}</flux:table.column>
            <flux:table.column>{{ __('Actions') }}</flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @foreach($accounts as $account)
                <flux:table.row>
                    <flux:table.cell>
                        <flux:link :href="route('accounts.edit', $account)">
                            {{ $account->name }}
                        </flux:link>
                    </flux:table.cell>
                    <flux:table.cell>{{ $account->account_number }}</flux:table.cell>
                    <flux:table.cell>{{ $account->credit_card }}</flux:table.cell>
                    <flux:table.cell>

                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>

    <flux:button :href="route('accounts.create')" variant="primary" class="mt-4">
        {{ __('Create') }}
    </flux:button>
</div>
