@extends('Admin.Commont.index')
@section('inner_content')
    <div class="card">
        <div class="card-header text-center">
            <h1>{{$blog['user']['name']}}</h1>
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                {{$blog['content']}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
