@extends('admin.layout.index')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <a href="admin/location/addcity"><button type="button" class="btn btn-primary btn-sm"><i class='fa fa-plus'></i> Tỉnh thành</button></a>
            <a href="admin/location/adddistrict"><button type="button" class="btn btn-primary btn-sm"><i class='fa fa-plus'></i> Quận huyện</button></a>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
@include('admin.errors.alerts')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tỉnh thành / quận huyện
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
            	<table width="100%" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
							<th>Name</th>
							<th>Alias</th>
							<th>date</th>
							<th>date up</th>
						    <th>Actions</th>
                        </tr>
                        @foreach($city as $val)
					  	<tr>
					  		<td>{{$val->name}}</td>
					  		<td>{{$val->slug}}</td>
					  		<td>{{$val->date}}</td>
					  		<td>{{$val->date_up}}</td>
					  		<td>
								<a href="admin/location/editcity/{{$val->id}}">
									<i class="fa fa-pencil"></i> sửa
								</a>
								<a href="admin/location/deletecity/{{$val->id}}">
									<i class="fa fa-trash-o"></i> xóa
								</a>
					  		</td>
					  	</tr>
						  	<?php $district = $val->district; ?>
						  	@foreach($district as $val2)
						  	<tr>
						  		<td>---| {{$val2->name}}</td>
						  		<td>{{$val2->slug}}</td>
						  		<td>{{$val2->date}}</td>
						  		<td>{{$val2->date_up}}</td>
						  		<td>
									<a href="admin/location/editdistrict/{{$val2->id}}">
										<i class="fa fa-pencil"></i> sửa
									</a>
									<a href="admin/location/deletedistrict/{{$val2->id}}">
										<i class="fa fa-trash-o"></i> xóa
									</a>
						  		</td>
						  	</tr>
					  		@endforeach
					  	@endforeach
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection