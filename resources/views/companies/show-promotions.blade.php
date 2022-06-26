<x-app-layout>
    <div class="flex flex-wrap mx-auto relative justify-center">
        <div class="md:relative fixed md:py-2 py-3 px-10 rounded-b-lg w-full bg-green-300">
            navbar goes here
        </div>
        {{--@dd($company)--}}
        <div
                class="md:p-3 mx-auto md:my-4 mb-5 mt-16 bg-white border-blue-400 rounded-lg shadow-lg px-2 py-1">
            <p class="md:text-lg text-sm"><a
                        href="{{route('company-events.show', $company)}}"
                        class="text-blue-400 capitalize">{{$company->name}}</a>'s promotions</p>
        </div>

        <div
                class="md:shadow-lg md:p-3 mx-auto md:my-4 mb-5 mt-16 border-2 border-blue-200 rounded-lg shadow-2xl px-2 py-1">
            <p class="md:text-lg text-sm">
                <a href="{{route('promotions.create')}}" class="uppercase">add new
                    promotion</a>
            </p>
        </div>

        <table class="container mx-auto text-left">
            <thead>
            <tr class="bg-white">
                <th class="p-3 hidden border lg:table-cell">Name</th>
                <th class="p-3 hidden border lg:table-cell">Promotion Time</th>
                <th class="p-3 hidden border lg:table-cell">Event</th>
                <th class="p-3 hidden border lg:table-cell">Description</th>
                <th class="p-3 hidden border lg:table-cell">Price</th>
                <th class="p-3 hidden border lg:table-cell">Actions</th>
            </tr>
            </thead>

            <tbody>

            @foreach($assignedPromotions as $promotion)
                <tr class="flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0
                    @if ($promotion->date->isBefore(today()))
                        lg:hover:bg-red-300
                            @else
                        lg:hover:bg-green-300
                    @endif">
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center md:text-left border border-b block lg:table-cell relative lg:static capitalize">
                        <span
                                class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Name</span>
                        {{$promotion->name}}</td>

                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center md:text-left border border-b block lg:table-cell relative lg:static capitalize">
                        <span
                                class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Date</span>
                        @if ($promotion->date->isBefore(today()))
                            <p class="text-red-600">Promotion over</p>
                        @else
                            <p class="text-green-600">{{$promotion->date->diffForHumans()}}</p>
                        @endif
                    </td>

                    <td class="w-full lg:w-auto pb-3 pt-5 text-gray-800 text-center md:text-left md:pl-4 border border-b block lg:table-cell relative lg:static ">
                        <span
                                class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Event</span>
                        {{$promotion->event->name}}</td>

                    <td class="w-full lg:w-auto pb-3 pt-5 text-gray-800 text-center md:text-left md:pl-4 border border-b block lg:table-cell relative lg:static ">
                        <span
                                class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Description</span>
                        {{$promotion->description}}</td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center md:text-left border border-b block lg:table-cell relative lg:static">
                        <span
                                class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Price</span>
                        @if(isset($promotion->price))
                            {{$promotion->price}} mkd.
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span
                                class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Actions</span>
                        <a href="{{route('promotions.edit', $promotion)}}"
                           class="rounded-lg bg-white shadow-lg px-2 py-1 border-2 border-orange-400">Edit</a>
                        <a href="{{route('promotions.delete', $promotion)}}"
                           onclick="return confirm('This will delete the product!')"
                           class="rounded-lg bg-white shadow-lg px-2 py-1 border-2 border-red-400">Remove</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    @if ($unassignedPromotions->isNotEmpty())

        <div class="flex flex-wrap mx-auto relative justify-center md:mt-5">
            <p class="text-lg text-sm text-blue-500 rounded-lg bg-white shadow-xl px-2 py-1">Unassigned Promotions</p>
        </div>

        <div class="flex flex-wrap mx-auto relative justify-center mt-5">
            <table class="container mx-auto text-left">
                <thead>
                <tr class="bg-white">
                    <th class="p-3 hidden border lg:table-cell">Name</th>
                    <th class="p-3 hidden border lg:table-cell">Promotion Time</th>
                    <th class="p-3 hidden border lg:table-cell">Description</th>
                    <th class="p-3 hidden border lg:table-cell">Price</th>
                    <th class="p-3 hidden border lg:table-cell">Action</th>
                </tr>
                </thead>

                <tbody>

                @foreach($unassignedPromotions as $promotion)
                    <form action="{{route('event.promotion.add', ['event' => $event, 'promotion' => $promotion])}}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        <tr class="bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0
                            @if ($promotion->date->isBefore(today()))
                                lg:hover:bg-red-300
                                    @else
                                lg:hover:bg-green-300
                            @endif">
                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center md:text-left border border-b block lg:table-cell relative lg:static capitalize">
                        <span
                                class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Name</span>
                                {{$promotion->name}}</td>

                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center md:text-left border border-b block lg:table-cell relative lg:static capitalize">
                        <span
                                class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Date</span>
                                @if ($promotion->date->isBefore(today()))
                                    <p class="text-red-600">Promotion over</p>
                                @else
                                    <p class="text-green-600">{{$promotion->date->diffForHumans()}}</p>
                                @endif
                            </td>

                            <td class="w-full lg:w-auto pb-3 pt-5 text-gray-800 text-center md:text-left md:pl-4 border border-b block lg:table-cell relative lg:static">
                        <span
                                class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Description</span>
                                {{$promotion->description}}</td>
                            <td class="w-full lg:w-auto pb-3 pt-5 text-gray-800 text-center md:text-left md:pl-4 border border-b block lg:table-cell relative lg:static">
                                <input type="hidden" name="date" value="{{$event->date}}">
                                <input type="hidden" name="event_id" value="{{$event->id}}">
                                <div class="pl-5">
                                    <span
                                            class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Price</span>
                                    {{$promotion->price}} mkd.

                                </div>

                            </td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span
                                class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Action</span>
                                <button class="rounded-lg shadow-lg px-2 py-1 border-2 bg-white border-green-400"
                                        type="submit">Add to Menu
                                </button>
                                <span
                                        class="lg:hidden absolute top-0 left-0 bg-gray-200 shadow-lg px-2 py-1 text-xs rounded-br-md font-bold uppercase">Actions</span>
                                <a href="{{route('promotions.edit', $promotion)}}"
                                   class="rounded-lg bg-white shadow-lg px-2 py-1 border-2 border-orange-400">Edit</a>
                                <a href="{{route('promotions.delete', $promotion)}}"
                                   onclick="return confirm('This will delete the product!')"
                                   class="rounded-lg bg-white shadow-lg px-2 py-1 border-2 border-red-400">Remove</a>
                            </td>

                        </tr>
                    </form>
                @endforeach
            </table>
        </div>
    @endif

</x-app-layout>
