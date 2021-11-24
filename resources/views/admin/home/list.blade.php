@extends('admin.layout.index')

@section('home') class="active" @endsection

@section('content')

<form action="admin/home/edit/{{$home->id}}" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <button type="submit" class="btn btn-primary btn-sm"><i class='fa fa-save'></i> SAVE</button>
        </h1>
    </div>
</div>
@include('admin.errors.alerts')
<!-- /.row -->
@for ($i=1; $i <= 7; $i++)
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Section {{$i}}
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <label>Name</label>
                        <input value="<?php echo $home['heading'.$i]; ?>" name='heading{{$i}}' type="text" placeholder="heading ..." class="form-control" />
                    
                        <label>Images</label>
                        <input onclick="BrowseServer{{$i}}();" name='img{{$i}}' id="image{{$i}}" type="text" placeholder="Images ..." class="form-control" />
                    
                        <img style="width:100%" src="<?php echo $home['img'.$i]; ?>">
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content{{$i}}" class="form-control ckeditor"><?php echo $home['content'.$i]; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function BrowseServer{{$i}}()
{
    var finder = new CKFinder();
    finder.BasePath = 'admin_asset/ckeditor/ckfinder/';
    finder.SelectFunction = SetFileField{{$i}};
    finder.Popup();
}
function SetFileField{{$i}}(fileUrl)
{
    document.getElementById('image{{$i}}').value = fileUrl;
}
</script>
@endfor
<!-- /.row -->
</form>

<style type="text/css">
#cke_1_contents {
height: 200px !important;
}
</style>

@endsection
