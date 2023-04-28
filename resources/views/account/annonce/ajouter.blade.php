<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <p
                class="mb-4 text-xl font-extrabold leading-none tracking-tight text-gray-700 md:text-2xl lg:text-3xl dark:text-gray-400">
                {{ !empty($editUserAnnonce) ? 'Modifier' : 'Ajouter' }} une annonce</p>
            <form
                action="{{ !empty($editUserAnnonce) ? route('account.annonce.edit', $editUserAnnonce->id) : route('account.annonce.ajouter') }}"
                method="POST" enctype="multipart/form-data">
                {{-- !empty($editUserAnnonce) ? route('account.annonce.edit', $annonce->id) : route('account.annonce.ajouter') --}}
                @csrf

                <div class="mb-5">
                    <label for="nom" class="mb-3 block text-base font-medium text-[#07074D]">
                        Titre
                    </label>
                    <input type="text" name="nom" placeholder="Saisissez un nom"
                        value="{{ !empty($editUserAnnonce) ? $editUserAnnonce->nom : '' }}"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>

                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selectionner
                    une
                    catégorie</label>

                <select name="category"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @forelse ($categories as $itemCategory)
                        @if (!empty($editUserAnnonce) && $itemCategory->id == $editUserAnnonce->category->id)
                            <option value="{{ $itemCategory->id }}" selected>{{ $itemCategory->nom }}</option>
                        @else
                            <option value="{{ $itemCategory->id }}">{{ $itemCategory->nom }}</option>
                        @endif
                    @empty
                        <option value="0">Aucune catégories</option>
                    @endforelse
                </select>

                <div class="mb-5">
                    <label for="image" class="mb-3 block text-base font-medium text-[#07074D]">
                        Ajouter une image
                    </label>
                    @isset($editAnnonce)
                        <div class="relative h-20 w-20">
                            <img class="h-full w-full object-cover object-center"
                                src="{{ Storage::url($editAnnonce->image) }}" alt="" />
                        </div>
                    @endisset
                    <input type="file" name="image" placeholder="Ajouter une image"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>

                <div class="mb-5">
                    <label for="description" class="mb-3 block text-base font-medium text-[#07074D]">
                        Description
                    </label>
                    <textarea rows="4" name="description" placeholder="Description"
                        class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">{{ !empty($editAnnonce) ? $editAnnonce->description : '' }}</textarea>
                </div>
                <div class="mb-5">
                    <label for="prix" class="mb-3 block text-base font-medium text-[#07074D]">
                        Prix
                    </label>
                    <input type="text" name="prix" placeholder="Saisissez un prix"
                        value="{{ !empty($editUserAnnonce) ? $editUserAnnonce->prix : '' }}"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                </div>
                <div class="mt-3">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ !empty($editAnnonce) ? 'Modifier' : 'Ajouter' }}</button>
                </div>
                {{-- @dd($categories) --}}
            </form>
        </div>
    </div>
</x-app-layout>
