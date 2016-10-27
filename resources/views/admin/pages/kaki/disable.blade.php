@extends('admin.layout.default')

@section('content')
<!-- BEGIN PAGE HEADER-->
<div class="row">
  <div class="col-md-12">
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->   
    <h3 class="page-title">
      Laporan Kartu Disable
    </h3>
    
      
    <!-- BEGIN PAGE CONTENT-->
		<div class="row">
            <br /><br />
			<div class="col-md-12">
				<div class="portlet">
					<div class="portlet-body">
                        <p class="hidden">{{ $count = 1 }}</p>
						<!-- print struk -->
                        <div class="struk">
                            <p>Tanggal : {{ isset($date) ? $date : '-' }}</p>
                            <p>Jumlah Kartu Disable : {{ $jumlahDisable }} </p>
                        </div><!-- end of print struk --> 
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
                                             Status
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
                                            {{ $item->id }}
                                        </td>
                                        <td class="text-center">
                                            Disable
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
							</table>
						</div>
					</div>
				</div>
            </div>
				<!-- End: life time stats -->
		</div>
		<!-- END PAGE CONTENT-->

      
    <!-- END PAGE TITLE & BREADCRUMB--> 
  </div>
</div>
<!-- END PAGE HEADER-->
<!-- CONTENT BODY GOES HERE >>>> -->
@stop