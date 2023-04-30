@extends('dashboard')

@section('main')
    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="#"
                                class="inline-flex items-center text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <a href="#"
                                    class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">E-commerce</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <a href="{{ route('admin.annonce.index') }}"
                                    class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Annonces</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500"
                                    aria-current="page">Annonces</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ !empty($editAnnonce) ? $editAnnonce->nom : 'Creéer une annonce' }}</h1>
            </div>
        </div>
    </div>

    <form
        action="{{ !empty($editAnnonce) ? route('admin.annonce.edit', $editAnnonce->id) : route('admin.annonce.ajouter') }}"
        method="POST" enctype="multipart/form-data">
        {{-- !empty($editAnnonce) ? route('admin.annonce.edit', $annonce->id) : route('admin.annonce.ajouter') --}}
        @csrf

        <div class="mb-5">
            <label for="nom" class="mb-3 block text-base font-medium text-[#07074D]">
                Titre
            </label>
            <input type="text" name="nom" placeholder="Saisissez un nom"
                value="{{ !empty($editAnnonce) ? $editAnnonce->nom : '' }}"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
        </div>

        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selectionner une
            catégorie</label>

        <select name="category"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @forelse ($categories as $itemCategory)
                @if (!empty($editAnnonce) && $itemCategory->id == $editAnnonce->category->id)
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
                    <img class="h-full w-full object-cover object-center" src="{{ Storage::url($editAnnonce->image) }}"
                        alt="" />
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
            <input type="number" name="prix" placeholder="Saisissez un prix"
                value="{{ !empty($editAnnonce) ? $editAnnonce->prix : '' }}"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
        </div>
        <div class="mt-3">
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ !empty($editAnnonce) ? 'Modifier' : 'Ajouter' }}</button>
        </div>
        {{-- @dd($categories) --}}
    </form>
@endsection
