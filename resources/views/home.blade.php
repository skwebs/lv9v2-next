@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>

                    @if (Route::has('admitCard.index'))
                        <a class="btn btn-primary mt-2" href="{{ route('admitCard.index') }}">Students Section</a>
                    @endif

                    @if (Route::has('result.index'))
                        <a class="btn btn-primary mt-2" href="{{ route('result.index') }}">Result Section</a>
                    @endif

                    @if (Route::has('set_student_position'))
                        <a class="btn btn-primary mt-2" href="{{ route('set_student_position') }}">Get All Student Details</a>
                    @endif

                    @if (Route::has('set_student_position'))
                        <a class="btn btn-primary mt-2" href="{{ route('set_student_position', ['set' => 'position']) }}">
                            Set Position of Students
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
