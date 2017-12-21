@if (count($favorites) > 0)
<ul class="media-list">
@foreach ($favorites as $favorite)
    <?php $user = $favorite->user; ?>
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <span class="text-muted">posted at {{ $favorite->created_at }}</span>
            </div>
            <div>
                <p>{!! nl2br(e($favorite->content)) !!}</p>
            </div>
            <div>
                @if (Auth::user()->is_favorite($favorite->id))
                    {!! Form::open(['route' => ['micropost.remove_favorite', $favorite->id], 'method' => 'delete', 'style' => 'margin-right: 1rem;']) !!}
                        {!! Form::submit('unfavorite', ['class' => 'btn btn-success btn-xs']) !!}
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['route' => ['micropost.add_favorite', $favorite->id], 'method' => 'post', 'style' => 'margin-right: 1rem;']) !!}
                        {!! Form::submit('favorite', ['class' => 'btn btn-default btn-xs']) !!}
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </li>
@endforeach
</ul>
{!! $favorites->render() !!}
@endif