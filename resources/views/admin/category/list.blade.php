@extends('admin.layout.index')

@section('category') class="active" @endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <a href="admin/category/add"><button type="button" class="btn btn-primary btn-sm"><i class='fa fa-plus'></i> ADD</button></a>
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
                Category
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                @if(count($category) == 0)
                    <h2 style="color:red">The list is empty !!</h2>
                @else
                <table width="100%" class="table table-striped table-bordered table-hover" >
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Sort By</th>
                            <th class="text-center" style="width: 20px;">Status</th>
                            <th class="text-center" style="width: 20px;">View</th>
                            <th class="text-center">User</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Date Up</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php dequycategory ($category,0,$str='',old('parent_id')); ?>  
                    </tbody>
                </table>
                @endif
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
@endsection

@section('function')
<?php 
	function dequycategory ($menulist, $parent_id=0, $str='')
	{
		foreach ($menulist as $val) 
		{
			if ($val['parent'] == $parent_id) 
			{ 
				?>
					<tr class="editview">
						<input name="cid" value="{{$val->id}}" type="hidden" />
                        <td>{{$str}}{{$val->name}}</td>
                        <td>{{$str}}{{$val->slug}}</td>
						<td>
                            @if($val->sort_by == 1) Product @endif
                            @if($val->sort_by == 2) News @endif
                            @if($val->sort_by == 3) Pages @endif
                        </td>
						<td class="text-center">
							<input id="status" name="status" <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox"  />
						</td>
						<td>
							<input id="view" value="{{$val->view}}" style="width: 50px; text-align: center;" type="number"  />
						</td>
						<td>{{$val->user}}</td>
						<td class="text-center">{{$val->date}}</td>
						<td class="text-center">{{$val->date_up}}</td>
						<td  class="text-center">
							<a href="admin/category/edit/{{$val->id}}">
								<i class="fa fa-pencil"></i> sửa
							</a> |
							<a onClick="javascript:return window.confirm('Bạn muốn xóa kênh này?');" href="admin/category/delete/{{$val->id}}">
								<i class="fa fa-trash-o"></i> xóa
							</a>
						</td>
					</tr>
				<?php
				dequycategory ($menulist, $val['id'], $str.'___');
			}
		}
	}
?>
@endsection