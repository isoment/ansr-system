{{-- Error message --}}
@if (session()->has('error'))
<div x-data="{ livewireFlash: true }"
        x-show="livewireFlash">
    <div class="flex justify-between bg-red-50 rounded overflow-hidden p-2 space-x-1">
        <div class="flex items-baseline">
            <span class="bg-white rounded-full p-1">
            <svg
                class="h-6 w-auto text-red-400"
                fill="currentColor"
                viewBox="0 0 20 20"
            >
                <path
                fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd"
                ></path>
            </svg>
            </span>
        </div>
        <div class="flex flex-grow items-center text-red-400">
            <p class="leading-tight text-xs md:text-sm ml-3">
                {{ session('error') }}
            </p>
        </div>
        <div>
            <button type="button"
                    class="bg-white text-red-500 hover:text-red-700 rounded overflow-hidden 
                        p-1 lg:p-2 focus:outline-none"
                    @click="livewireFlash = false">
            <svg
                class="h-4 w-auto"
                fill="currentColor"
                viewBox="0 0 20 20"
            >
                <path
                fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"
                ></path>
            </svg>
            </button>
        </div>
    </div>
</div>
@endif