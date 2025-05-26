<x-filament-panels::page>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Products Section -->
        <div class="md:col-span-2 bg-white rounded-lg shadow p-4">
            <div class="mb-4">
                <input type="text" wire:model.live.debounce.300ms="searchQuery"
                    placeholder="{{ __('message.Search For Product') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach ($products as $product)
                    <div class="bg-gray-50 rounded-lg shadow p-3 cursor-pointer hover:bg-gray-100 transition flex flex-col justify-between min-h-[250px]"
                        wire:click="addToCart({{ $product->id }})">
                        <div class="w-full h-32 rounded-lg overflow-hidden mb-2">
                            @if ($product->images->count() > 0)
                                <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                    alt="{{ $product->name_ar }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-400 text-sm">{{ __('message.No Image') }}</span>
                                </div>
                            @endif
                        </div>
                        <h3 class="font-medium text-sm">
                            {{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}
                        </h3>
                        <div class="flex flex-col mt-1">
                            @if ($product->discount_price)
                                <span class="text-gray-400 line-through text-sm mb-1"><del>{{ $product->price }}</del>
                                    {{ __('message.Currency') }}</span>
                                <span class="text-green-600 font-bold">{{ $product->discount_price }}
                                    {{ __('message.Currency') }}</span>
                            @else
                                <span class="text-green-600 font-bold">{{ $product->price }}
                                    {{ __('message.Currency') }}</span>
                            @endif
                            <span class="text-xs text-gray-500 mt-1">{{ __('message.Stock') }}:
                                {{ $product->quantity }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Cart Section -->
        <div class="bg-white rounded shadow p-4">
            <h2 class="text-lg font-bold mb-4">{{ __('message.Shopping Cart') }}</h2>

            @if (count($cart) > 0)
                <div class="space-y-3 mb-4 max-h-96 overflow-y-auto">
                    @foreach ($cart as $index => $item)
                        <div class="flex justify-between items-center pb-2">
                            <div>
                                <h4 class="font-medium">{{ $item['name'] }}</h4>
                                <div class="flex items-center mt-1">
                                    <button
                                        wire:click="updateQuantity({{ $index }}, {{ $item['quantity'] - 1 }})"
                                        class="bg-gray-200 px-2 rounded">-</button>
                                    <span class="mx-3">{{ $item['quantity'] }}</span>
                                    <button
                                        wire:click="updateQuantity({{ $index }}, {{ $item['quantity'] + 1 }})"
                                        class="bg-gray-200 px-2 rounded">+</button>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold">{{ $item['total'] }} {{ __('message.Currency') }}</div>
                                <button wire:click="removeFromCart({{ $index }})"
                                    class="bg-red-600 text-white py-1 px-2 mt-2 rounded-lg hover:bg-red-700 transition"
                                    style="background-color: red; transition: background-color 0.3s ease;"
                                    onmouseover="this.style.backgroundColor='darkred'"
                                    onmouseout="this.style.backgroundColor='red'">{{ __('message.Remove Product') }}</button>
                            </div>
                        </div>
                        @if (count($cart) > 1 && $index !== count($cart) - 1)
                            <hr>
                        @endif
                    @endforeach
                </div>

                <div class="border-t pt-3">
                    <div class="flex justify-between mb-2">
                        <span>{{ __('message.Subtotal') }}:</span>
                        <span class="font-bold">{{ $subtotal }} {{ __('message.Currency') }}</span>
                    </div>

                    <!-- Add discount input here -->
                    <div class="flex justify-between mb-2">
                        <span>{{ __('message.Discount') }}:</span>
                        <div class="flex items-center gap-2">
                            <input type="number" wire:model.live="discount" min="0" max="{{ $subtotal }}"
                                class="w-24 border-gray-300 rounded-lg shadow-sm" placeholder="0">
                            <span>{{ __('message.Currency') }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between mb-4">
                        <span>{{ __('message.Total') }}:</span>
                        <span class="font-bold text-lg">{{ $total }} {{ __('message.Currency') }}</span>
                    </div>

                    <!-- User and Address Section -->
                    <div class="mb-4">
                        <div class="mb-3">
                            <label
                                class="block text-sm font-medium text-gray-700 mb-1">{{ __('message.Select User') }}</label>
                            <div class="flex gap-2">
                                <select wire:model="selectedUser" class="w-full border-gray-300 rounded-lg shadow-sm"
                                    x-data="{}" x-init="() => {
                                        const initSelect2 = () => {
                                            const el = document.querySelector('[wire\\:model=\'selectedUser\']');
                                            $(el).select2({
                                                placeholder: '{{ __('message.Select User') }}',
                                                allowClear: true,
                                                width: '100%',
                                                minimumResultsForSearch: 0
                                            }).on('change', function(e) {
                                                @this.set('selectedUser', e.target.value);
                                            });
                                        };
                                    
                                        initSelect2();
                                    
                                        Livewire.on('userCreated', initSelect2);
                                        Livewire.hook('message.processed', (message, component) => {
                                            initSelect2();
                                        });
                                    }">
                                    <option value="">{{ __('message.Select User') }}</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name . ' - ' . $user->phone }}
                                        </option>
                                    @endforeach
                                </select>

                                <x-filament::button type="button"
                                    wire:click="$dispatch('open-modal', { id: 'create-user-modal' })"
                                    class="flex-shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </x-filament::button>
                            </div>
                        </div>

                        <!-- Create User Modal -->
                        <x-filament::modal id="create-user-modal">
                            <x-slot name="header">
                                <h2 class="text-lg font-medium">{{ __('message.Create New User') }}</h2>
                            </x-slot>

                            <div class="space-y-4 py-4">
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-1">{{ __('message.Name') }}</label>
                                    <input type="text" wire:model.live="newUser.name"
                                        class="w-full border-gray-300 rounded-lg shadow-sm">
                                    @error('newUser.name')
                                        <span class="text-red-600 text-sm" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-1">{{ __('message.Phone') }}</label>
                                    <input type="text" wire:model.live="newUser.phone"
                                        class="w-full border-gray-300 rounded-lg shadow-sm">
                                    @error('newUser.phone')
                                        <span class="text-red-600 text-sm" style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <x-slot name="footer">
                                <div class="flex justify-end gap-x-4">
                                    <x-filament::button
                                        wire:click="$dispatch('close-modal', { id: 'create-user-modal' })"
                                        color="gray">
                                        {{ __('message.Cancel') }}
                                    </x-filament::button>

                                    <x-filament::button wire:click="createUser" wire:loading.attr="disabled">
                                        {{ __('message.Create') }}
                                    </x-filament::button>
                                </div>
                            </x-slot>
                        </x-filament::modal>
                        <div class="mt-3">
                            <label
                                class="block text-sm font-medium text-gray-700 mb-1">{{ __('message.Address') }}</label>
                            <textarea wire:model="address" rows="2" class="w-full border-gray-300 rounded-lg shadow-sm"></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <button wire:click="clearCart"
                            class="bg-gray-200 text-gray-800 py-2 px-4 rounded-lg hover:bg-gray-300 transition">{{ __('message.Clear Cart') }}</button>
                        <button wire:click="createOrder"
                            class="bg-primary-600 text-white py-2 px-4 rounded-lg hover:bg-primary-700 transition disabled:opacity-50 disabled:cursor-not-allowed">{{ __('message.Create Order') }}</button>
                    </div>
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <p>{{ __('message.Cart is Empty') }}</p>
                    <p class="text-sm mt-2">{{ __('message.Click on a product to add it to cart') }}</p>
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>
