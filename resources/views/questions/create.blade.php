@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex alingn-items-center">
                        <h2>Haz una pregunta</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Volver a preguntas</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                   <form action="{{ route('questions.store')}}" method="POST">
                        @csrf    
                    <div class="form-group">
                                <label for="question-title">Titulo de pregunta</label>
                                <input type="text" name="title" value="{{ old('title') }}" id="question-title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">

                                @if($errors->has('title'))
                                    <div class="class invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                    <label for="question-body">Explicación de pregunta</label>
                                    <textarea name="body" id="question-body" rows="10" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}">{{ old('body') }}</textarea>

                                @if($errors->has('body'))
                                    <div class="class invalid-feedback">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary btn-lg">Haz esta pregunta</button>
                            </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection