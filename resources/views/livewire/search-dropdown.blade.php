<div class="relative mt-3 md:mt-8" x-data="{ isOpen: true}" @click.away="isOpen = false">
    <input
        wire:model.debounce.500ms="search"
        type="text"
        class="bg-gray-800 rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline"
        placeholder="Search"
        x-ref="search"
        @keydown.window="
            if(event.keyCode === 191){
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shit.tab="isOpen = false"
    >
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 30 30"><path d="M10.5 0C4.71 0 0 4.71 0 10.5S4.71 21 10.5 21c2.725 0 5.203-1.052 7.071-2.76c.022.039.042.08.076.114l2.151 2.151a1.976 1.976 0 0 0 .304 2.425l8.485 8.485c.377.377.879.585 1.413.585s1.036-.208 1.414-.586S32 30.534 32 30s-.208-1.036-.586-1.414l-8.485-8.485c-.634-.634-1.659-.729-2.42-.299l-2.155-2.155c-.034-.034-.074-.054-.114-.076A10.448 10.448 0 0 0 21 10.5C21 4.71 16.29 0 10.5 0zm11.722 20.808l8.485 8.485c.189.189.293.44.293.707s-.104.518-.293.707a1.025 1.025 0 0 1-1.414 0l-8.485-8.485a.997.997 0 0 1 0-1.414a.997.997 0 0 1 1.414 0zM10.5 20C5.262 20 1 15.738 1 10.5S5.262 1 10.5 1S20 5.262 20 10.5S15.738 20 10.5 20z"/><path d="M10.5 3C6.364 3 3 6.364 3 10.5S6.364 18 10.5 18s7.5-3.364 7.5-7.5S14.636 3 10.5 3zm0 14C6.916 17 4 14.084 4 10.5S6.916 4 10.5 4S17 6.916 17 10.5S14.084 17 10.5 17z"/></svg>
    </div>
    <div wire:loading class="spinner top-0 right-0 mr-4 mt-3"></div>
    @if (strlen($search) >= 2)
    <div class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4" x-show.transition.opacity="isOpen">
        @if ($searchResults->count() > 0)
            <ul>
                @foreach ($searchResults as $result)

                    <li class="border-b border-gray-700">
                        <a
                            href="{{route('movies.show', $result['id'])}}" class="block hover:bg-gray-700 px-3 py-3 flex items-center"
                            @if ($loop->last) @keydown.tab.exact="isOpen = false" @endif
                        >
                            @if ($result['poster_path'])
                                <img src="https://image.tmdb.org/t/p/w92/{{$result['poster_path']}}" alt="poster" class="w-8">
                            @else
                                <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                            @endif
                            <span class="ml-4">{{$result['title']}}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
        <div class="px-3 py-3">No results for: "{{ $search }}"</div>
        @endif
    </div>
    @endif
</div>
