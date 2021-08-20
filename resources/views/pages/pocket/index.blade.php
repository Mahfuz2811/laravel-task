@extends('layouts.master')

@section('content')
    <div class="col-md-9">
        @foreach($contents as $content)
            <div class="panel panel-default">
                <div class="panel-heading cursor" data-toggle="collapse" data-target="#collapse{{$content->id}}" aria-expanded="false" aria-controls="collapse{{ $content->id }}">
                    Content Link: <a href="{{ $content->url }}">{{ $content->url }}</a>
                    <br>
                    <span class="badge">{{ $content->pocket->title }}</span>
                </div>
                <div class="panel-body collapse" id="collapse{{$content->id}}">
                    <h2>{{ $content->scrapingData->title ?? '' }}</h2>
                    <div class="heading-image">
                        @if($image = $content->scrapingData->image_url ?? '')
                            <img src="{{ $content->scrapingData->image_url ?? '' }}" alt="Heading Image">
                        @endif
                    </div>

                    {{ $content->scrapingData->content ?? '' }}
                </div>
            </div>
        @endforeach
        {{ $contents->links() }}
    </div>
@stop
