<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Pockets</title>

    <style>
        .heading-image {
            text-align: center;
            margin-bottom: 20px;
        }
        li {
            border-radius: 0 !important;
        }
        .cursor {
            cursor: pointer;
        }
        a {
            color: #000000;
            text-decoration: none !important;
        }
        .active a{
            color: #ffffff;
        }
    </style>
</head>
<body>

<div class="container">
    <div style="margin-top: 100px;" class="row">
        <div class="col-md-3">
            <ul class="list-group">
                <a href="{{ route('pockets.index') }}">
                    <li class="list-group-item cursor {{ $pocketId == '' ? 'active' : '' }}">All</li>
                </a>

                @foreach($pockets as $pocket)
                    <a href="{{ route('pockets.show', $pocket->id) }}"><li class="list-group-item cursor {{ $pocketId == $pocket->id ? 'active' : '' }}">{{ $pocket->title }}</li></a>
                @endforeach
            </ul>
        </div>
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
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>
