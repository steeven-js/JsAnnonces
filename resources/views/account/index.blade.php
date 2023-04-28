<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <p
                    class="mb-4 text-xl font-extrabold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl dark:text-gray-400">
                    Mes annonces
                </p>
                <a href="{{ route('account.annonce.ajouter') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Créer une annonce
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
                @forelse ($userAnnonces as $itemannonces)
                    <div
                        class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="p-8 rounded-t-lg" src="{{ Storage::url($itemannonces->image) }}"
                                alt="{{ $itemannonces->nom }}" />
                        </a>
                        <div class="px-5 pb-5">
                            <a href="#">
                                <p class="text-sm font-semibold tracking-tight text-gray-900 dark:text-white">
                                    {{ Str::limit($itemannonces->nom, 30) }}</p>
                            </a>
                            <div class="flex justify-between mt-2.5 mb-5">
                                <p class="text-sm font-semibold tracking-tight text-gray-900 dark:text-white">
                                    {{ $itemannonces->user->name }}
                                </p>
                                <p class="text-sm font-semibold tracking-tight text-gray-900 dark:text-white">
                                    {{ $itemannonces->updated_at->format('d/m/Y') }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ $itemannonces->prix }}
                                    €</span>
                                <a href="{{ route('account.annonce.edit', ['id' => $itemannonces->id]) }}"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ !empty($userAnnonces) ? 'Modifier' : 'Ajouter' }}
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Il y a aucune annonce</p>
                @endforelse
            </div>
        </div>
    </div>


</x-app-layout>
