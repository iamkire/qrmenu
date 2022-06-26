<x-app-layout>
    <div class="flex flex-wrap space-y-5 mx-auto relative justify-center">
        <div class="md:relative fixed md:py-2 py-3 px-10 rounded-b-lg w-full bg-green-300">
            navbar goes here
        </div>

        {{--        NEED TO FIX MOBILE VIEW --}}

        <div
            class="md:p-3 mx-auto md:my-4 mb-5 mt-16 bg-white border-blue-400 rounded-lg shadow-lg px-2 py-1">
            <p class="md:text-lg text-sm"><a href="{{route('companies')}}" class="text-blue-400 capitalize">
                    {{auth()->user()->name}}</a>'s companies</p>
        </div>

        <div
            class="md:shadow-lg md:p-3 mx-auto md:my-4 mb-5 mt-16 border-2 border-blue-200 rounded-lg shadow-2xl px-2 py-1">
            <p class="md:text-lg text-sm">
                <a href="{{route('companies-company.create')}}" class="uppercase">add new
                    company</a>
            </p>
        </div>

        {{--        NEED TO FIX MOBILE VIEW --}}

        <div class="w-full mx-4">
            <div class="flex flex-wrap lg:space-x-4 space-y-4 lg:space-y-0 lg:flex-nowrap">
                @foreach($companies as $company)
                    {{--                    @dd($company)--}}
                    <div class="w-full lg:w-1/2 bg-gray-200 rounded-lg shadow-lg p-2 space-y-2 p-5 ">
                        <a href="{{route('companies-company.show', $company)}}" >
                            <div class="flex flex-wrap space-x-2 rounded-lg border-2 border-gray-200 mb-4 items-center shadow-lg">
                                <img class="rounded-lg w-10 h-10 m-1" src="{{$company->logo}}" alt="">
                                <p>{{$company->name}}</p>
                            </div>
                        </a>

                        <div
                            class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <a href="{{route('companies-company.edit', $company)}}"
                               class="rounded-lg shadow-lg px-2 py-1 border-2 border-orange-400">Edit</a>
                            <a href="{{route('companies-company.destroy', $company)}}"
                               onclick="return confirm('This will delete the product!')"
                               class="rounded-lg shadow-lg px-2 py-1 border-2 border-red-400">Remove</a>
                        </div>

                        <div class="flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0 place-content-between">
                            <div class="rounded-lg shadow-lg py-2 px-4 space-y-2 border-2 border-gray-200">
                                <p>Active Menus: {{$company->menus_count}}</p>
                                <p>Active Promotions: {{$company->promotions_count}}</p>
                                <p>Active Events: {{$company->events_count}}</p>
                                <p>Opens at {{$company->opens_at}}</p>
                                <p>Closes at {{$company->closes_at}}</p>
                            </div>

                            <div class="py-4 px-4 space-y-2 text-center">
                                <p class="rounded-lg shadow-lg px-3 py-2 border-2 border-blue-200">
                                    <a href="{{route('company-menus.show', $company)}}">Menus</a>
                                </p>
                                <p class="rounded-lg shadow-lg px-3 py-2 border-2 border-blue-200">
                                    <a href="{{route('company-promotions.show', $company)}}">Promotions</a>
                                </p>
                                <p class="rounded-lg shadow-lg px-3 py-2 border-2 border-blue-200">
                                    <a href="{{route('company-events.show', $company)}}">Events</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


</x-app-layout>
