<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-12">
            <h1
                class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                JSAnnonces</h1>
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Here at
                Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and
                drive economic growth.</p>
            <div class="flex flex-col mb-8 space-y-4 lg:mb-16 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
            </div>

            <form>
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Recherche</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="search" id="default-search"
                        class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Recherche Annonce ..." required>
                    <button type="submit"
                        class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>

            <div class="pt-4 inline-flex rounded-md shadow-sm rounded-l-lg" role="group">
                <a href="{{ route('home') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                    Toutes les annonces
                </a>
            </div>
            @forelse ($categories as $item)
                <div class="pt-4 inline-flex rounded-md shadow-sm rounded-l-lg" role="group">
                    <a href="{{ route('home.tri', ['id' => $item->id]) }}"
                        class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                        {{ $item->nom }}
                    </a>
                </div>
            @empty
                <p>Il y a aucune catégorie</p>
            @endforelse

            <div class="mt-5 flex justify-center max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="a">
                    <h5 class="text-sm font-semibold tracking-tight text-gray-900 dark:text-white">Annonces récentes
                    </h5>
                </div>
            </div>

            <div class="mt-5 flex justify-center max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
                    @forelse ($annonces as $itemannonces)
                        {{-- @dump($itemannonces->category->nom) --}}
                        <div
                            class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 relative">
                            @if (auth()->check() &&
                                    auth()->user()->favoris->contains('annonce_id', $itemannonces->id))
                                <a href="{{ route('profile.favoris.add', ['id' => $itemannonces->id]) }}"
                                    class="!absolute top-4 right-4 h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-full text-center align-middle font-sans text-xs font-medium uppercase text-red-500 transition-all hover:bg-red-500/10 active:bg-red-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    <span class="absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            aria-hidden="true" class="h-6 w-6">
                                            <path
                                                d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z">
                                            </path>
                                        </svg>
                                    </span>
                                </a>
                            @else
                                <a href="{{ route('profile.favoris.add', ['id' => $itemannonces->id]) }}"
                                    class="!absolute top-4 right-4 h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-full text-center align-middle font-sans text-xs font-medium uppercase text-white-500 transition-all hover:bg-white-500/10 active:bg-white-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button" data-ripple-dark="true">
                                    <span class="absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            aria-hidden="true" class="h-6 w-6">
                                            <path
                                                d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z">
                                            </path>
                                        </svg>
                                    </span>
                                </a>
                            @endif

                            <p class="text-sm font-semibold tracking-tight text-gray-900 dark:text-white">
                                {{ $itemannonces->category->nom }}</p>

                            <a href="{{ route('annonce.show', ['id' => $itemannonces->id]) }}">
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
                                    <span
                                        class="text-3xl font-bold text-gray-900 dark:text-white">{{ $itemannonces->prix }}€</span>
                                    <a href="{{ route('annonce.show', ['id' => $itemannonces->id]) }}"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Détails</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Il y a aucune annonce</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-5 flex justify-center max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="a">
                    {{ $annonces->links() }}
                </div>
            </div>

        </div>
    </section>
</x-app-layout>
