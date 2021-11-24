<table width="100%" class="table table-striped table-bordered table-hover" >
    <thead>
        <tr>
            <th class="text-center">Name</th>
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
						<td>
                            @if($val->sort_by == 1) Product @endif
                            @if($val->sort_by == 2) News @endif
                            @if($val->sort_by == 3) Pages @endif
                        </td>
						<td class="text-center">
							<input id="status" name="status" <?php if($val->status == 'true'){echo "checked";} ?> type="checkbox"  />
						</td>
						<td>
							<input id="view" value="{{$val->view}}" style="width: 50px;text-align: center;" type="number"  />
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

<script type="text/javascript">
$(document).ready(function(){
    $("input#view").blur(function(){
        var view = $(this).val();
        var cid = $(this).parents('.editview').find('input[name="cid"]').val();
        // alert(view);
        $.ajax({
            url:  'admin/ajax/updateview/'+cid,
            type: 'GET',
            cache: false,
            data: {
                "view":view,
                "cid":cid
            },
            success: function(data){
                $('#data-cat').html(data);
            }
        });
    });
});
$(document).ready(function(){
    $("input#status").click(function(){
        var status = $(this).is(':checked');
        var cid = $(this).parents('.editview').find('input[name="cid"]').val();
        // alert(cid);
        $.ajax({
            url:  'admin/ajax/updatestatus/'+cid,
            type: 'GET',
            cache: false,
            data: {
                "status":status,
                "cid":cid
            },
            success: function(data){
                $('#data-cat').html(data);
            }
        });
    });
});
</script>