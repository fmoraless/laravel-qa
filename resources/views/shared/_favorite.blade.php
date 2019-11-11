<a title="Click para marcar como favorita (Click nuevamente para deshacer)"
   class="favorite mt-2 {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '') }} "
   onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $model->id }}').submit();"
>
    <i class="fas fa-star fa-2x"></i>
    <span class="favorites-count">{{ $question->favorites_count }}</span>
</a>
<form id="favorite-question-{{ $model->id }}" action="/{{ $firstURISegment }}/{{ $model->id }}/favorites" method="POST" style="display: none">
    @csrf
    @if($model->is_favorited)
        @method('DELETE')
    @endif
</form>
