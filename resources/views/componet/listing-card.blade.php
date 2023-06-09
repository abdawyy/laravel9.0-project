@props(['listing'])

<x-card>

<div  class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">


  <div class="flex">
    <img
        class="hidden w-48 mr-6 md:block"
        src="{{asset('images/no-image.png')}}"
        alt=""/>
    <div>
        <h3 class="text-2xl">
            <a href="/listings/{{$listing->id}}">{{$listing->title}}</a>
        </h3>
        <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
        <x-listing-tags :tagsCsv="$listting->tags" />

        <div class="text-lg mt-4">
            <i class="fa-solid fa-location-dot"></i> {{$listing->location}}

        </div>
    </div>
</div>

</x-card>
