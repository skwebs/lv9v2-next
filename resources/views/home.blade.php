@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <a class="btn btn-primary " href="{{route('admitCard.index')}}">Students List / Add Student</a>

                <a class="btn btn-primary " href="{{route('result.index')}}">Result</a>
            </div>
        </div>
    </div>
</div>
@endsection
