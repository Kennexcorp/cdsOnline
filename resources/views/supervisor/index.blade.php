@extends(('layouts/fixed_menu_header'))
{{-- Page title --}}
@section('title')
{{ $links['title'] }}
@parent
@stop


@section('header_styles')
    <!--Plugin styles-->
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
{{-- Page content --}}
@section('content')
<!-- Content Header (Page header) -->
<header class="head">
    <div class="main-bar">
        <div class="row no-gutters">
            <div class="col-lg-6">
                <h4 class="nav_top_align skin_txt">
                    <i class="fa fa-file-o"></i>
                    {{ $links['title'] }}
                </h4>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb float-right nav_breadcrumb_top_align">
                    <li class="breadcrumb-item">
                        <a href="index1">
                            <i class="fa ti-file" data-pack="default" data-tags=""></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">{{ $links['title'] }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $links['sub_title'] }}</li>
                </ol>
            </div>
        </div>
    </div>
</header>
<div class="outer">
    <div class="inner bg-light lter bg-container">
        <div class="row">
            <div class="col">
                    {{ $errors}}
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('failure'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('failure') }}
                        </div>
                    @endif
                    <div class="data_tables">
                        <div class="card">
                            <div class="card-header bg-white">
                                <i class="fa fa-table"> </i> All Supervisors
                            </div>
                            <div class="text-center p-2">
                                    <a class="btn btn-success btn-md adv_cust_mod_btn" data-toggle="modal"
                                    data-href="#responsive" href="#responsive">Add A Supervisor</a>
                            </div> 
                            
                            <div class="card-body">
                                <div class="m-t-15">
                                        <table id="example1" class="table display table-stripped table-bordered" >
                                        <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>State</th>
                                            <th>LGA</th>
                                            <th>CDS Group(s)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($supervisors as $supervisor)
                                                <tr>
                                                    <td>{{ $supervisor->name }}</td>
                                                    <td>{{ $supervisor->profile->first_name }}</td>
                                                    <td>{{ $supervisor->profile->last_name }}</td>
                                                    <td>{{ $supervisor->email }}</td>
                                                    <td>{{ $supervisor->profile->phone_number}}</td>
                                                    <td>{{ $supervisor->profile->state }}</td>
                                                    <td>{{ $supervisor->profile->lga }}</td>
                                                    <td>@foreach($supervisor->groups as $group)
                                                            {{ $group->group->name }} <br>
                                                        @endforeach</span>
                                                    </td>
                                                    <td><span class="badge badge-{{ $supervisor->status->style }}"> {{$supervisor->status->name }}</span></td>
                                                    <td>
                                                        <form action="{{ route('supervisors.destroy', $supervisor) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a class="btn btn-primary btn-md adv_cust_mod_btn" data-toggle="modal"
                                    data-href="#add_group" href="#add_group{{$supervisor->id}}"><i class="fa fa-plus"></i></a>
                                                            <a class="btn btn-success btn-md adv_cust_mod_btn" data-toggle="modal"
                                    data-href="#responsive" href="#responsive{{$supervisor->id}}"><i class="fa fa-edit"></i></a>
                                                            {{-- <a href="{{ route("supervisors.edit", $supervisor) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a> --}}

                                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                        <div class="modal fade in display_none" id="responsive{{$supervisor->id}}" tabindex="-1" role="dialog" aria-hidden="false">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-success">
                                                                        <h4 class="modal-title text-white">Edit Supervisor</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('supervisors.update', $supervisor) }}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PATCH')
                                                                                <div class="row">
                                                                                        <div class="col">
                                                                                            <p>
                                                                                                <input id="name" name="name" type="text" placeholder="Username" class="form-control" required value="{{ $supervisor->name }}" ></p>
                                                                                            <p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <p>
                                                                                                <input id="first_name" name="first_name" type="text" placeholder="First Name" class="form-control" required value="{{ $supervisor->profile->first_name }}" ></p>
                                                                                            <p>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                                <p>
                                                                                                    <input id="last_name" name="last_name" type="text" placeholder="Last Name" class="form-control" value="{{ $supervisor->profile->last_name }}"  required></p>
                                                                                                <p>
                                                                                            </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <p>
                                                                                                <input id="email" name="email" type="text" placeholder="E-Mail" class="form-control" value="{{ $supervisor->email }}"  required></p>
                                                                                            <p>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                                <p>
                                                                                                    <input id="phone_number" name="phone_number" type="tel" placeholder="Contact" class="form-control" value="{{ $supervisor->profile->phone_number }}"  required></p>
                                                                                                <p>
                                                                                            </div>
                                                                                    </div>
                                                                                    <div class="">
                                                                                        <p>
                                                                                            <select type="text" placeholder="state" name="state" id="state" class="form-control {{ $errors->has('state') ? ' is-invalid' : '' }}"   required>
                                                                                                <option value="{{ $supervisor->profile->state }}">{{ $supervisor->profile->state }}</option>
                                                                                            </select>
                                                                                            <span class="col text-success">Current: {{ $supervisor->profile->state }}</span>
                                                                                        </p>
                                                                                        
                                                                                    </div>
                                                                                    <div class="">
                                                                                            <p>
                                                                                                <select type="text" class="form-control  {{ $errors->has('lga') ? ' is-invalid' : '' }}" name="lga" id="lga" placeholder="LGA"  required autofocus>
                                                                                                    <option value="{{ $supervisor->profile->lga }}">{{ $supervisor->profile->lga }}</option>
                                                                                                </select>
                                                                                                <span class="col text-success">Current: {{ $supervisor->profile->lga }}</span>
                                                                                            </p>

                                                                                    </div>
                                                                                    {{-- <div class="">
                                                                                        <p>
                                                                                        <select type="text" class="form-control  {{ $errors->has('cds_group') ? ' is-invalid' : '' }}" name="cds_group" id="cds_group" placeholder="CDS Group" value="{{ $supervisor->groups->pluck('group_id') }}" required autofocus>
                                                                                                <option value="*">Please Select CDS Group</option>
                                                                                                @foreach ($groups as $group)
                                                                                                <option value="{{ $group->id }}">  {{ $group->name }} @if($group->code != ""){{ "(".$group->code.")" }}@endif</option>
                                                                                                @endforeach
                                                                                                </select>
                                                                                                <span>Groups Assigned To: </span><br>
                                                                                                <span class="text-success"> 
                                                                                                    @foreach($supervisor->groups as $group)
                                                                                                    {{ $group->group->name }} <br>
                                                                                                    @endforeach</span>
                                                                                        </p>
                                                                                        
                                                                                    </div> --}}
                                                                        
                                                                                    <div class="modal-footer">
                                                                                            <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                                                                            <button type="submit" class="btn btn-success">Update</button>
                                                                                        </div>
                                                                                    </form>
                                                                            
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade in display_none" id="add_group{{$supervisor->id}}" tabindex="-1" role="dialog" aria-hidden="false">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-success">
                                                                            <h4 class="modal-title text-white">Add Group</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('supervisors.addGroup') }}" method="POST" enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div>
                                                                                        <input id="supervisor" name="supervisor" type="hidden" value="{{ $supervisor->id }}" >
                                                                                </div>
                                                                                            
                                                                                    <div class="">
                                                                                        <p>
                                                                                                <select type="text" class="form-control  {{ $errors->has('cds_group') ? ' is-invalid' : '' }}" name="cds_group" id="cds_group" placeholder="CDS Group" required autofocus>
                                                                                                <option value="*">Please Select CDS Group</option>
                                                                                                @foreach ($groups as $group)
                                                                                                <option value="{{ $group->id }}">  {{ $group->name }} @if($group->code != ""){{ "(".$group->code.")" }}@endif</option>
                                                                                                @endforeach
                                                                                                </select>
                                                                                                
                                                                                        </p>
                                                                                        
                                                                                    </div>
                                                                            
                                                                                    <div class="modal-footer">
                                                                                            <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                                                                            <button type="submit" class="btn btn-success">Add</button>
                                                                                        </div>
                                                                            </form>
                                                                            <span>Groups Assigned To: </span><br>
                                                                                                
                                                                            @foreach($supervisor->groups as $group)
                                                                            <div>
                                                                                <table>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <span class="text-success"> {{ $group->group->name }} </span>
                                                                                            </td>
                                                                                            <td>
                                                                                                <form action="{{ route('supervisors.removeGroup') }}" method="POST" class="display_none">
                                                                                                    @csrf
                                                                                                    
                                                                                                    <div>
                                                                                                            <input id="group" name="group" type="hidden" value="{{ $group->group->id }}" >
                                                                                                    </div>

                                                                                                    <div>
                                                                                                            <input id="user" name="user" type="hidden" value="{{ $supervisor->id }}" >
                                                                                                    </div>

                                                                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                                                                </form>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                                
                                                                            @endforeach
                                                                                
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!-- /.inner -->
</div>

<div class="modal fade in display_none" id="responsive" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title text-white">Add A Supervisor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('supervisors.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col">
                                    <p>
                                        <input id="username" name="username" type="text" placeholder="Username" class="form-control" required value="{{ old('username') }}" ></p>
                                    <p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p>
                                        <input id="first_name" name="first_name" type="text" placeholder="First Name" class="form-control" required value="{{ old('first_name') }}" ></p>
                                    <p>
                                </div>
                                <div class="col">
                                        <p>
                                            <input id="last_name" name="last_name" type="text" placeholder="Last Name" class="form-control" value="{{ old('last_name') }}"  required></p>
                                        <p>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p>
                                        <input id="email" name="email" type="text" placeholder="E-Mail" class="form-control" value="{{ old('email') }}"  required></p>
                                    <p>
                                </div>
                                <div class="col">
                                        <p>
                                            <input id="phone_number" name="phone_number" type="tel" placeholder="Contact" class="form-control" value="{{ old('phone_nmmber') }}"  required></p>
                                        <p>
                                    </div>
                            </div>
                            <div class="">
                                <p>
                                    <select type="text" placeholder="state" name="state" id="state" class="form-control {{ $errors->has('state') ? ' is-invalid' : '' }}"  value="{{ old('state') }}" required>
                                        <option value="*">Select State</option>
                                    </select>
                                </p>
                                
                            </div>
                            <div class="">
                                    <p>
                                        <select type="text" class="form-control  {{ $errors->has('lga') ? ' is-invalid' : '' }}" name="lga" id="lga" placeholder="LGA" value="{{ old('lga') }}" required autofocus>
                                            <option value="*">Select LGA</option>
                                        </select>
                                    </p>
                                </div>
                            <div class="">
                                <p>
                                        <select type="text" class="form-control  {{ $errors->has('cds_group') ? ' is-invalid' : '' }}" name="cds_group" id="cds_group" placeholder="CDS Group" value="{{ old('cds_group') }}" required autofocus>
                                            <option value="*">Please Select CDS Group</option>
                                            @foreach ($groups as $group)
                                            <option value="{{ $group->id }}">  {{ $group->name }} @if($group->code != ""){{ "(".$group->code.")" }}@endif</option>
                                            @endforeach
                                        </select>
                                </p>
                                
                            </div>
                
                            <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                    <button type="submit" class="btn btn-success">Send Invite</button>
                                </div>
                            </form>
                        
                </div>
                
            </div>
        </div>
    </div>
<!-- /.outer -->
<!-- /.content -->
@stop

@section('footer_scripts')
    <!--plugin scripts-->
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
    <!-- end of global scripts-->
@stop