@extends('admin.layout.default')

@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title" style="font-size:28px;">
        Ubah Data Tarif
        </h3>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->
<br>
<div class="portlet-body form">
    <!-- BEGIN FORM-->
    <form action="{{ url('admin/fasilitas/update') }}" class="form-horizontal" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        <div class="form-body">

            <input type="" class="hidden" placeholder="" value="{{ $id }}" name="id">
            
            <div class="form-group">
                <label class="col-md-3 control-label">Nama Fasilitas</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Enter text" value="{{ $nama }}" name="nama">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Harga</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Enter text" value="{{ $harga }}" name="harga">
                </div>
            </div>
        </div>
        <div class="form-actions fluid">
            <div class="col-md-offset-3 col-md-9">
                <button type="button" onclick="location.href = '{{ url('admin/fasilitas') }}';" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
    <!-- END FORM-->
</div>
@stop



