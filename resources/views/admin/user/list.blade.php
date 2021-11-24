@extends('admin.layout.index')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            <a href="admin/user/add"><button type="button" class="btn btn-primary btn-sm"><i class='fa fa-plus'></i> ADD</button></a>
        </h1>
    </div>
</div>
@include('admin.errors.alerts')
<div class="row">
  	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-default">
            <div class="panel-heading">
                User
            </div>
			<div class="panel-body">
				@if(count($user) == 0)
                    <h2 style="color:red">The list is empty !!</h2>
                @else
				<table width="100%" class="table table-striped table-bordered table-hover" >
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Permission</th>
							<th>Email</th>
							<th>Email</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody>
						@foreach($user as $val)
						<tr>
							<th scope="row">1</th>
							<td>{{$val->name}}</td>
							<td>{{$val->permission}}</td>
							<td>{{$val->email}}</td>
							<td>{{$val->email}}</td>
							<td  class="text-center">
								<a href="admin/user/edit/{{$val->id}}">
									<i class="fa fa-pencil"></i> sửa
								</a> |
								<a onClick="javascript:return window.confirm('Bạn muốn xóa sản phẩm này?');" href="admin/user/delete/{{$val->id}}">
									<i class="fa fa-trash-o"></i> xóa
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@endif
			</div>
		</div>
  	</div>
</div>
@endsection