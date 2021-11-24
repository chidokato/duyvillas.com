@extends('admin.layout.index')

@section('content')

<form action="admin/location/addcity" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <button type="submit" class="btn btn-primary btn-sm"><i class='fa fa-save'></i> SAVE</button>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
@include('admin.errors.alerts')
<!-- /.row -->
<div class="row">
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                add city
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="control-group">
							<label>Name</label>
						  	<input value="{!! old('name') !!}" name='name' type="text" placeholder="Name ..." class="form-control">
						</div>
						<div class="control-group">
							<label>View</label>
						  	<input name='view' type="number" placeholder="View ..." class="form-control">
						</div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layout.seo-add')
    </div>
</div>
</form>
@endsection
