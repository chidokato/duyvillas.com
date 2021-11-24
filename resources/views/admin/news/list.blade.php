@extends('admin.layout.index')

@section('news') class="active" @endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <a href="admin/news/add"><button type="button" class="btn btn-primary btn-sm"><i class='fa fa-plus'></i> ADD</button></a>
        </h1>
    </div>
</div>
@include('admin.errors.alerts')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                News
            </div>
            <div class="panel-body" id="data-cat">
                @if(count($news) == 0)
                    <h2 style="color:red">The list is empty !!</h2>
                @else
                <table width="100%" id="dataTables-example" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
							<th></th>
							<th>Name</th>
							<th>Cat</th>
							<th>Hot</th>
							<th>Status</th>
							<th>Date</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($news as $val)
						<tr class="img">
							<input name="nid" value="{{$val->id}}" type="hidden" />
							<td class="img"><img src="data/news/80-60/{{$val->img}}"></td>
							<td>{{$val->name}}</td>
							<td>@if(isset($val->category->name)) {{$val->category->name}} @endif </td>
							<td class="text-center">
								<input id="newhot" name="hot" <?php if($val->hot == 'true'){echo "checked";} ?> type="checkbox"  />
							</td>
							<td class="text-center">
								<input id="newstatus" name="status" <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox"  />
							</td>
							<td>{{$val->date_up}}<i>({{$val->date}})</i></td>
							<td  class="text-center">
								<a href="admin/news/edit/{{$val->id}}">
									<i class="fa fa-pencil"></i> sửa
								</a> |
								<a onClick="javascript:return window.confirm('Bạn muốn xóa sản phẩm này?');" href="admin/news/delete/{{$val->id}}">
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