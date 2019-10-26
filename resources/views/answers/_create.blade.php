<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Tu respuesta</h3>
                </div>
                <hr>
                <form action="{{ route('questions.answers.store', $question->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="body" id="" cols="30" rows="7" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"></textarea>
                        @if($errors->has('body'))
                            <div class="invalid-feedback">
                                <stron>{{ $errors->first('body') }}</stron>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-outline-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
