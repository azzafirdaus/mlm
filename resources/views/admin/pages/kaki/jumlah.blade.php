@extends('admin.layout.default')

@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12">
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->   
    <h3 class="page-title">
      Laporan Jumlah Registrasi Kaki
    </h3>
    
    <br /><br /><br />
      
    <!-- BEGIN PAGE CONTENT-->
		<div class="row">
            <form class="top-tanggal-form" action="{{ url('admin/kaki') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <br /><br /><br />
    			<div class="col-md-12">
    				<div class="portlet">
    					<div class="portlet-body">
                            <p class="hidden">{{ $count = 1 }}</p>
                            
                            <div class="table-container">
    							<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th width="5%" class="text-center">
                                                 No.
                                            </th>
                                            <th class="text-center">
                                                 No. Kartu
                                            </th>
                                            <th class="text-center">
                                                 Jumlah
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($data as $item)
                                        <tr>
                                            <td class="text-center">
                                                {{ $count++ }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->idkepala }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->total }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
    							</table>
    						</div>
                            
    					</div>
    				</div>
    				<!-- End: life time stats -->
    			</div>
            </form>
		</div>
		<!-- END PAGE CONTENT-->

      
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER-->
<!-- CONTENT BODY GOES HERE >>>> -->
@stop