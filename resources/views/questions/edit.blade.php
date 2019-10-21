@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex alingn-items-center">
                        <h2>Editar pregunta</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Volver a preguntas</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                   <form action="{{ route('questions.update', $question->id) }}" method="POST">
                        {{ method_field('PUT') }}
                       @include("questions._form", ['buttonText' => 'Actualizar Pregunta'])
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection