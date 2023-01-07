<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>


	{{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> --}}
		{{-- <nav class="flex" aria-label="Breadcrumb"> --}}
			{{-- <ol class="inline-flex items-center space-x-1 md:space-x-3"> --}}
				{{-- <li class="inline-flex items-center"> --}}
					{{-- <a href="#" --}} {{--
						class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
						--}}
						{{-- Home --}}
						{{-- </a> --}}
					{{-- </li> --}}
				{{-- <li aria-current="page"> --}}
					{{-- <div class="flex items-center"> --}}
						{{-- <svg class="w-6 h-6 text-gray-400" fill="currentColor" --}} {{--
							viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"> --}}
							{{-- <path fill-rule="evenodd" --}} {{--
								d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
								--}} {{-- clip-rule="evenodd"></path> --}}
							{{-- </svg> --}}
						{{-- <span --}} {{--
							class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Flowbite</span>
						--}}
						{{-- </div> --}}
					{{-- </li> --}}
				{{-- </ol> --}}
			{{-- </nav> --}}
		{{-- </div> --}}

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900">
					{{ __("You're logged in!") }}
				</div>
			</div>
		</div>
	</div>


	<div class="py-12 flex justify-center">
		<a href="{{ route('content.create.init')}}"
			class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">新規作成</a>
	</div>

</x-app-layout>
