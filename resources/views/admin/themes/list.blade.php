@extends('admin.layout.index')

@section('themes') class="active" @endsection

@section('content')

<style type="text/css">
    .iteam{
        box-shadow: 2px 0 5px #c4c4c4;
        background: #f1f1f1;
    }
    .iteam img {
        width: 100%;
        margin-bottom: 5px;
    }
    .iteam p {
        padding: 5px 10px
    }
</style>

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            <a href="admin/themes/add"><button type="button" class="btn btn-primary btn-sm"><i class='fa fa-plus'></i> ADD</button></a>
        </h1>
    </div>
</div>
@include('admin.errors.alerts')

<!-- logo -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                LOGO
            </div>
            <div class="panel-body">
                <div class="row">
                    @foreach($logo as $val)
                    <div class="col-md-2">
                        <div class="iteam">
                            <img src="data/themes/{{$val->img}}">
                            <p>
                                <a href="admin/themes/edit/{{$val->id}}"><i class="fa fa-pencil"></i> sửa </a>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- slide -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                SLIDER
            </div>
            <div class="panel-body">
                <div class="row">
                    @foreach($slide as $val)
                    <div class="col-md-3">
                        <div class="iteam">
                            <img src="data/themes/{{$val->img}}">
                            <p>
                                <a href="admin/themes/edit/{{$val->id}}"><i class="fa fa-pencil"></i> sửa </a> | 
                                <a onClick="javascript:return window.confirm('Bạn muốn xóa bản ghi này?');" href="admin/themes/delete/{{$val->id}}"><i class="fa fa-trash-o"></i> xóa </a>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Banner -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                BANNER
            </div>
            <div class="panel-body">
                <div class="row">
                    @foreach($banner as $val)
                    <div class="col-md-3">
                        <div class="iteam">
                            <img src="data/themes/{{$val->img}}">
                            <p>
                                <a href="admin/themes/edit/{{$val->id}}"><i class="fa fa-pencil"></i> sửa </a> | 
                                <a onClick="javascript:return window.confirm('Bạn muốn xóa bản ghi này?');" href="admin/themes/delete/{{$val->id}}"><i class="fa fa-trash-o"></i> xóa </a>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- logo đối tác -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                ĐỐI TÁC
            </div>
            <div class="panel-body">
                <div class="row">
                    @foreach($logo_doitac as $val)
                    <div class="col-md-2">
                        <div class="iteam">
                            <img src="data/themes/{{$val->img}}">
                            <p>
                                <a href="admin/themes/edit/{{$val->id}}"><i class="fa fa-pencil"></i> sửa </a> | 
                                <a onClick="javascript:return window.confirm('Bạn muốn xóa bản ghi này?');" href="admin/themes/delete/{{$val->id}}"><i class="fa fa-trash-o"></i> xóa </a>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection