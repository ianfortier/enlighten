<div class="flex items-center bg-gray-800 my-1 px-2 mb-4">

    <x-enlighten-status-badge size="8" :model="$example"/>

    <h2 id="{{ $example->method_name }}" class="text-xl text-gray-100 semibold block w-full my-3 flex items-center">
        @if($failed)
            {{ ucwords($example->test_status) . ':' }}
        @endif

        {{ $example->title }}

        @if($developer_mode)
            <a href="{{ $example->file_link }}" class="rounded-full text-teal-700 hover:text-teal-500 transition-al ease-in-out duration-200 p-1 mx-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            </a>
        @endif
    </h2>

</div>

<div class="grid grid-cols-2 gap-4 w-full mb-12">
    <div>
        <p class="text-gray-100 mb-4">{{ $example->description }}</p>

        @if($example->is_http)
            <x-enlighten-request-info :example="$example" />
            <span class="mb-8 w-full block"></span>
            <x-enlighten-response-info :example="$example" />
        @endif
    </div>

    <x-enlighten-response-preview :code-example="$example"/>
</div>
