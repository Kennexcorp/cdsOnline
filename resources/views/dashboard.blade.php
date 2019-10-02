@extends(('layouts/fixed_menu_header'))
{{-- Page title --}}
@section('title')
        @if (!auth()->user()->hasRole('Member'))
        Admin Dashboard
        @else
        Member Dashboard
        @endif 
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/c3/css/c3.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/toastr/css/toastr.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/switchery/css/switchery.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/new_dashboard.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/select2/css/select2.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/datatables/css/scroller.bootstrap.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/datatables/css/colReorder.bootstrap.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/datatables/css/dataTables.bootstrap.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/dataTables.bootstrap.css')}}" />
    <!-- end of plugin styles -->
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/tables.css')}}" />
    <!--End of page level styles-->
@stop

@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-6">
                    <h4 class="m-t-5">
                        <i class="fa fa-home"></i>
                        @if (!auth()->user()->hasRole('Member'))
                            Admin Dashboard
                        @else
                            Member Dashboard
                        @endif 
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            @role('Admin')
            <section>
                <div class="row">
                    
                </div>
            </section>
            @endrole

            @role('Supervisor')
            <section>
                <div class="row">

                </div>
            </section>
            @endrole


            @role('Official')
            <section>
                
            <div class="row">
            </div>

        </section>
        @endrole

        @role('Member')
            <section>
            <div class="row">
                
                <div class="col-lg-8 col-md col-sm">
                <div class="card m-t-35">
                        <div class="card-header bg-white">
                            <i class="fa fa-table"></i>My CDS Attendance
                        </div>
                        <div class="card-body">
                                
                            <table class="table text-center">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Month/Weeks</th>
                                    <th>Week 1</th>
                                    <th>Week 2</th>
                                    <th>Week 3</th>
                                    <th>Week 4</th>
                                </tr>
                                </thead>
                                <tbody>
                                    {{-- <input type="hidden" value="{{ $i = 0 }}"/> --}}
                                    @foreach ($values as $value)
                                    <tr>
                                        <td>{{ $value->created_at->englishMonth }}</td>
                                        <td><span class="badge badge-{{ isset($value->week_1) ? "success" : ""}} p-2 col">Present</span></td>
                                        <td><span class="badge badge-{{ isset($value->week_2) ? "success" : ""}} p-2 col">Present</span></td>
                                        <td><span class="badge badge-{{ isset($value->week_3) ? "success" : ""}} p-2 col">Present</span></td>
                                        <td><span class="badge badge-{{ isset($value->week_4) ? "success" : ""}} p-2 col">Present</span></td>
                                    </tr>
                                    @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
        
                </div>

                <div class="col-lg-4 col-md col-sm">
                    <div class="card m-t-35">
                        <div class="card-header bg-white">
                                <i class="fa fa-info"></i>CDS Group Info
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                     CDS Name : <span class="text-success">
                                         {{ auth()->user()->profile->group->name}}
                                    </span>
                                </div>
                                <div class="col-12">
                                    CDS Day  : <span class="text-success">
                                            {{ isset($group->day) ? $group->day : "Not Availiable" }}
                                    </span>
                                </div>
                                <div class="col-12">
                                        CDS Time  : <span class="text-success">
                                                {{ isset($group->time) ? $group->time : "Not Availiable" }}
                                        </span>
                                    </div>
                                <div class="col-12">
                                    Supervisor Name : <span class="text-success">
                                            {{ $group->user->profile->first_name." ".$group->user->profile->last_name }}
                                    </span>
                                </div>
                                <div class="col-12">
                                    Supervisor Contact : <span class="text-success">
                                            {{ $group->user->profile->phone_number }}
                                    </span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </section>
        @endrole
            <!-- /.inner -->
        </div>
        <!-- /.outer -->
    </div>
    <!-- /#content -->
@stop
@section('footer_scripts')
    
    <script type="text/javascript" src="{{asset('vendors/countUp.js/js/countUp.min.js')}}"></script>
    <!--end of plugin scripts-->
    <script type="text/javascript" src="{{asset('js/pages/new_dashboard.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/select2/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/pluginjs/dataTables.tableTools.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.colReorder.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.responsive.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.rowReorder.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.colVis.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.html5.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.print.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.scroller.min.js')}}"></script>
    <!-- end of plugin scripts -->
    <!--Page level scripts-->
    <script type="text/javascript" src="{{asset('js/pages/simple_datatables.js')}}"></script>

@stop
