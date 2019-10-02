@extends(('layouts/fixed_menu_header'))
{{-- Page title --}}
@section('title')
    {{ $links['title'] }}
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!--Plugin css-->
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/jasny-bootstrap/css/jasny-bootstrap.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/fullcalendar/css/fullcalendar.min.css')}}"/>
    <!--End off plugin css-->
    <!--Page level css-->
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/timeline2.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/calendar_custom.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/profile.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/gallery.css')}}"/>
    <!--end of page level css-->
@stop
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-user"></i>
                        {{ $links['title'] }}
                    </h4>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb float-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="index1">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{ $links['title'] }}</a>
                        </li>
                        <li class="active breadcrumb-item">{{$links['sub_title']}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 m-t-35">
                            <div class="text-center">
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumb_zoom zoom admin_img_width">
                                            <img src="{{asset('img/admin.jpg')}}" alt="admin" class="admin_img_width"></div>
                                        <div class="fileinput-preview fileinput-exists thumb_zoom zoom admin_img_width"></div>
                                        <div class="btn_file_position">
                                                    <span class="btn btn-primary btn-file">
                                                        <span class="fileinput-new">Change image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="Changefile">
                                                    </span>
                                            <a href="#" class="btn btn-warning fileinput-exists"
                                               data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-lg-6 m-t-25">
                            
                           <div class="card">
                               <div class="card-header">
                                   Profile Details
                               </div>
                               <div class="card-body m-t-15">
                                    <form action="{{route('members.update', $member)}}" method="POST" enctype="multipart/form-data">
                                        @method('PATCH')
                                        @csrf
        
                                        <div class="row">
                                                <div class="col">
                                                        <input id="name" name="name" type="text" placeholder="State Code" class="form-control" required value="{{ $member->name }}"@if(!auth()->user()->hasRole('Member')||auth()->user()->hasRole('Official'))   @endif >
                                                        <span class="col text-success">State Code</span>
                                                
                                                    
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                
                                                    <input id="first_name" name="first_name" type="text" placeholder="First Name" class="form-control" required value="{{ $member->profile->first_name }}" >
                                                    <span class="col text-success">First Name</span>
                                                
                                            </div>
                                            <div class="col">
                                                    
                                                        <input id="last_name" name="last_name" type="text" placeholder="Last Name" class="form-control" value="{{ $member->profile->last_name }}"  required>
                                                        <span class="col text-success">Last Name</span>
                                                    
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                    <input id="email" name="email" type="text" placeholder="E-Mail" class="form-control" value="{{ $member->email }}"  required>
                                                    <span class="col text-success">E-Mail</span>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="row">
                                                <div class="col">
                                                        <input id="phone_number" name="phone_number" type="tel" placeholder="Phone Number" class="form-control" value="{{ $member->profile->phone_number }}"  required>
                                                        <span class="col text-success">Phone Number</span>
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col">
                                                        <input id="ppa" name="ppa" type="tel" placeholder="PPA" class="form-control" value="{{ $member->profile->ppa }}"  required>
                                                        <span class="col text-success">Place of Primary Assignment </span>
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col">
                                                        @if(!(auth()->user()->hasRole('Member') || auth()->user()->hasRole('Official')) )
                                                        <select type="text" placeholder="state" name="state" id="state" class="form-control {{ $errors->has('state') ? ' is-invalid' : '' }}"  value="{{ $member->profile->state }}" required aria-readonly="true">
                                                            <option value="*">Select State</option>
                                                        </select>
                                                        @endif
                                                        <span class="col text-success">State: {{ $member->profile->state }}</span>
                                                    
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col">
                                                        @if(!(auth()->user()->hasRole('Member') || auth()->user()->hasRole('Official')) )
                                                        <select type="text" class="form-control  {{ $errors->has('lga') ? ' is-invalid' : '' }}" name="lga" id="lga" placeholder="LGA" value="{{ $member->profile->lga }}" required autofocus>
                                                            <option value="*">Select LGA</option>
                                                        </select>
                                                        @endif
                                                        <span class="col text-success">LGA: {{ $member->profile->lga }}</span>

                                            </div>
                                        </div>
                                            
                                            <div class="row">
                                                    <div class="col">
                                                            @if(!(auth()->user()->hasRole('Member') || auth()->user()->hasRole('Official')) )
                                                            <select type="text" class="form-control  {{ $errors->has('cds_group') ? ' is-invalid' : '' }}" name="cds_group" id="cds_group" placeholder="CDS Group" value="{{ $member->profile->group->name }}" required autofocus>
                                                            <option value="*">Please Select CDS Group</option>
                                                            @foreach ($groups as $group)
                                                            <option value="{{ $group->id }}">  {{ $group->name }} @if($group->code != ""){{ "(".$group->code.")" }}@endif</option>
                                                            @endforeach
                                                            </select>
                                                            @endif
                                                            <span class="col text-success">CDS Group: {{ $member->profile->group->name }}</span>
                                                    
                                                </div>
                                            </div>
                                            
                                            
                                            

                                            <div class="text-center">
                                                <button class="btn btn-primary" type="submit">Update Profile</button>
                                            </div>
        
                                       </form>
                               </div>
                               
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!auth()->user()->hasRole('Member'))
            <div class="row">
                    <div class="col-lg-12">
                    <div class="card m-t-35">
                            <div class="card-header bg-white">
                                <i class="fa fa-table"></i>CDS Attendance
                            </div>
                            <div class="card-body m-t-35">
                                    <div class="table-responsive">
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
                                        @foreach ($member->attendance as $value)
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
            
                    </div>
            </div>
            @endif
            <div class="card m-t-35">
                <div class="card-header bg-white">
                    <i class="fa fa-fw fa-clock-o"></i> Timeline
                </div>
                <div class="card-body m-t-35">
                    <!--timeline-->
                    <div>
                        <ul class="timeline">
                            <li>
                                <div class="timeline-badge primary">
                                    <i class="fa fa-tag"></i>
                                </div>
                                <div class="timeline-panel bg-primary">
                                    <div class="timeline-heading text-white">
                                        <h5 class="timeline-title">Timeline Event One</h5>
                                        <p>
                                            <small>13 hours ago</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body text-white">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.  gravida tempor justo, at  justo fringilla at.
                                            .
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge danger">
                                    <i class="fa fa-fw fa-check-square-o"></i>
                                </div>
                                <div class="timeline-panel bg-danger">
                                    <div class="timeline-heading text-white">
                                        <h5 class="timeline-title">Timeline Event Two</h5>
                                        <p>
                                            <small>June 20,2016</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body text-white">
                                        <p> gravida tempor justo, at  justo fringilla at. gravida tempor justo, at justo fringilla at.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge info">
                                    <i class="fa fa-thumbs-o-up"></i>
                                </div>
                                <div class="timeline-panel bg-info">
                                    <div class="timeline-heading text-white">
                                        <h5 class="timeline-title">Timeline Event Three</h5>
                                        <p>
                                            <small>June 10 , 2016</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body text-white">
                                        <p>
                                            Lorem ipsum dolor sit amet.  gravida tempor justo, at bibendum justo fringilla  justo fringilla at.
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge warning">
                                    <i class="fa fa-fw fa-indent"></i>
                                </div>
                                <div class="timeline-panel bg-warning">
                                    <div class="timeline-heading text-white">
                                        <h5 class="timeline-title">Timeline Event Four</h5>
                                        <p>
                                            <small>Apr 20,2016</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body text-white">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.  gravida tempor justo,  justo fringilla at.
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge success">
                                    <i class="fa fa-pencil-square-o"></i>
                                </div>
                                <div class="timeline-panel bg-success">
                                    <div class="timeline-heading text-white">
                                        <h5 class="timeline-title">Timeline Event Five</h5>
                                        <p>
                                            <small>Mar 15,2016</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body text-white">
                                        <p>
                                            Lorem Ipsum is simply dummy, vidis litro abertis. Consectetur adipiscing elit.  gravida tempor justo, at  justo fringilla at.
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge mint">
                                    <i class="fa fa-paperclip"></i>
                                </div>
                                <div class="timeline-panel bg-mint">
                                    <div class="timeline-heading text-white">
                                        <h5 class="timeline-title">Timeline Event Six</h5>
                                        <p>
                                            <small>Jan 1,2016</small>
                                        </p>
                                    </div>
                                    <div class="timeline-body text-white">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.  gravida tempor justo, at  justo fringilla at.
                                            fringilla at.
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--timeline ends-->
                </div>
            </div>
        </div>
    </div>
    <!-- /.inner -->
@stop
@section('footer_scripts')
    <!--Plugin scripts-->
    <script type="text/javascript" src="{{asset('vendors/slimscroll/js/jquery.slimscroll.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/jasny-bootstrap/js/jasny-bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/bootstrap_calendar/js/bootstrap_calendar.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/moment/js/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/fullcalendar/js/fullcalendar.min.js')}}"></script>
    <!--End of Plugin scripts-->
    <!--Page level scripts-->
    <script type="text/javascript" src="{{asset('js/pages/mini_calendar.js')}}"></script>

<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
    <!--End of Page level scripts-->
    <script>

        $("#content-tab li a").click(function () {
            $("#clothing-nav-content .tab-pane").removeClass("show active");
        })
    </script>
@stop
