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
