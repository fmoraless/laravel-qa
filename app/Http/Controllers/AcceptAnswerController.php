<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        // TODO: Implement __invoke() method.
        //dd('accept the answer'); Testea si pasa la accept
        $this->authorize('accept', $answer);
        $answer->question->acceptBestAnswer($answer);

        return back();
    }
}
