<section>
    @if (isset(Auth::user()->avatar))
        <!-- Afficher l'avatar de l'utilisateur -->
        <img class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0" src="{{ Storage::url(Auth::user()->avatar) }}"
            alt="{{ Auth::user()->name }}" />
    @else
        <!-- Afficher une image par défaut ou un message indiquant qu'aucun avatar n'a été défini -->
    @endif
    <div>
        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Profile picture</h3>
        <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
            JPG, GIF or PNG. Max size of 800K
        </div>
    </div>

    <form action="{{ route('profile.update-avatar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-5">
            <label for="image" class="mb-3 block text-base font-medium text-[#07074D]">
                Ajouter une image
            </label>

            <input type="file" name="image" placeholder="Ajouter une image"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
        </div>
        <button type="submit"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z">
                </path>
                <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
            </svg>
            Upload picture
        </button>
    </form>
</section>
