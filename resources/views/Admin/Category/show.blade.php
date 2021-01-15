@extends('Admin.Commont.index')
@section('inner_content')
    <div class="card">
        <div class="card-header text-center">
            <h1>{{333}}</h1>
        </div>
        <table class="table table-striped">
            <thead class="table table-success">
                <tr>
                    <th>关键词</th>
                    <th>描述</th>
                    <th>创建时间</th>
                </tr>
            </thead>
            <tbody id="body">
                <tr>
                    <td>{{$category['cate_keywords']}}</td>
                    <td>{{$category['cate_description']}}</td>
                    <td>{{$category['created_at']}}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
