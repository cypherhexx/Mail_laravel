<!-- Secondary sidebar -->
<div class="sidebar sidebar-secondary sidebar-default">
    <div class="sidebar-content">
        <!-- Sub navigation -->
        <div class="sidebar-category">
            <div class="category-title">
                <span>
                    Navigation
                </span>
                <ul class="icons-list">
                    <li>
                        <a data-action="collapse" href="#">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="category-content no-padding">
                <ul class="navigation navigation-alt navigation-accordion">
                    <li class="navigation-header">
                        Tickets Dashboard
                    </li>
                    <li class="{{set_active('admin/helpdesk/tickets-dashboard')}}">
                        <a href="{{url('admin/helpdesk/tickets-dashboard')}}">
                            <i class="icon-ticket">
                            </i>
                           Tickets Dashboard
                        </a>
                    </li>
                    <li class="navigation-header">
                        Tickets
                    </li>
             
                       <li class="{{set_active('admin/helpdesk/tickets/add')}}">
                            <a href="{{url('admin/helpdesk/tickets/add?create=true')}}">
                                <i class="icon-folder-open3 text-success">
                                </i>
                               Create a ticket
                            </a>
                        </li> 
                  
                    <li class="{{set_active('admin/helpdesk/tickets/open')}}">
                        <a href="{{url('admin/helpdesk/tickets/open/?status=Open')}}">
                            <i class="icon-folder-open3 text-success">
                            </i>
                           Open
                        </a>
                    </li>  
                         
                                        
                    <li class="{{set_active('admin/helpdesk/tickets/resolved')}}">
                        <a href="{{url('admin/helpdesk/tickets/resolved/?status=Resolved')}}">
                            <i class="icon-folder-open3 text-success">
                            </i>
                           Resolved
                        </a>
                    </li>                     
                  
                    <li class="{{set_active('admin/helpdesk/tickets/closed')}}">
                        <a href="{{url('admin/helpdesk/tickets/closed/?status=Closed')}}">
                            <i class="icon-folder-open3 text-success">
                            </i>
                           Closed
                        </a>
                    </li>    


                    <li class="navigation-header">
                        Management
                    </li>

                                         
                  


                            <li class="{{set_active('admin/helpdesk/tickets/department')}}">
                                <a href="{{url('admin/helpdesk/tickets/department')}}">
                                <i class="icon-tree6"></i>
                                Departments
                                </a>
                            </li>                            
                           
                            <li class="{{set_active('admin/helpdesk/tickets/category')}}">
                                <a href="{{url('admin/helpdesk/tickets/category')}}">
                                <i class="icon-tree6"></i>
                                Categories
                                </a>
                            </li>                            
                           

                                                      
                           

                    


                            <li class="{{set_active('admin/helpdesk/tickets/priority*')}}">
                                <a href="{{url('admin/helpdesk/tickets/priority')}}">
                                <i class="icon-move-up2"></i>
                                    Priority
                                </a>
                            </li>   
                                              


                           

                             <li class="{{set_active('admin/helpdesk/tickets/ticket-type*')}}">
                                <a href="{{url('admin/helpdesk/tickets/ticket-type')}}">
                                <i class="icon-move-up2"></i>
                                    Ticket Types
                                </a>
                            </li> 
                           
                      



                </ul>
            </div>
        </div>
        <!-- /sub navigation -->
    </div>
</div>
<!-- /secondary sidebar -->