@can('accept', $model)
    <a title="Marcar como mejor respuesta."
       class="{{ $answer->status }} mt-2"
       onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit();"
    >
        <i class="fas fa-check fa-2x"></i>
    </a>
    <form id="accept-answer-{{ $model->id }}" action="{{ route('answers.accept', $model->id) }}" method="POST" style="display: none">
        @csrf
    </form>
@else
    @if($answer->is_best)
        <a title="El creador de la pregunta aceptó esta respuesta como mejor respuesta."
           class="{{ $model->status }} mt-2"
           onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit();"
        >
            <i class="fas fa-check fa-2x"></i>
        </a>
    @endif
@endcan
