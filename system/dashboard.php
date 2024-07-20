<?php
ob_start();
include_once 'init.php';
?>  
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box" style="border-left: 3px solid #17a2b8 !important; background: #ffff !important;">
            <div class="inner">
                <h3 style="color: #17a2b8">150</h3>

                <p>New Appointments</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag" style="color: #17a2b8"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box" style="border-left: 3px solid #28a745 !important; background: #ffff !important;">
            <div class="inner">
                <h3 style="color: #28a745">53<sup style="font-size: 20px">%</sup></h3>

                <p>Pending Appointments</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars" style="color: #28a745"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box" style="border-left: 3px solid #ffc107 !important; background: #ffff !important;">
            <div class="inner">
                <h3 style="color: #ffc107">44</h3>

                <p>Approved Appointments</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add" style="color: #ffc107"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box" style="border-left: 3px solid #dc3545 !important; background: #ffff !important;">
            <div class="inner">
                <h3 style="color: #dc3545">65</h3>

                <p>Invoices</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph" style="color: #dc3545"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
</div>
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box" style="border-left: 3px solid #17a2b8 !important; background: #ffff !important;">
            <div class="inner">
                <h3 style="color: #17a2b8">150</h3>

                <p>Customers</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag" style="color: #17a2b8"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box" style="border-left: 3px solid #28a745 !important; background: #ffff !important;">
            <div class="inner">
                <h3 style="color: #28a745">53<sup style="font-size: 20px">%</sup></h3>

                <p>Users</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars" style="color: #28a745"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box" style="border-left: 3px solid #ffc107 !important; background: #ffff !important;">
            <div class="inner">
                <h3 style="color: #ffc107">44</h3>

                <p>Products</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add" style="color: #ffc107"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box" style="border-left: 3px solid #dc3545 !important; background: #ffff !important;">
            <div class="inner">
                <h3 style="color: #dc3545">65</h3>

                <p>Services</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph" style="color: #dc3545"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<div class="row pt-4">
    <div class="col-lg-4 col-4">

    </div>

    <div class="col-lg-4 col-4">

    </div>

    <div class="col-lg-4 col-4">
        <div class="card" style="background-color:">
            <div class="card-header border-0 ui-sortable-handle" style="cursor: move; background-color: #0c1e2a; color: #fff;">

                <h3 class="card-title">
                    <i class="far fa-calendar-alt"></i>
                    Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52" style="color:#000; background-color:#dfc27d; border-color: #000000; box-shadow: none;">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a href="#" class="dropdown-item">Add new event</a>
                            <a href="#" class="dropdown-item">Clear events</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">View calendar</a>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse" style="color:#000; background-color:#dfc27d; border-color: #000000; box-shadow: none;">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove" style="color:#000; background-color:#dfc27d; border-color: #000000; box-shadow: none;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body pt-0" style="display: block;">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"><div class="bootstrap-datetimepicker-widget usetwentyfour"><ul class="list-unstyled"><li class="show"><div class="datepicker"><div class="datepicker-days" style=""><table class="table table-sm"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Month"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Month">July 2024</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Month"></span></th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td data-action="selectDay" data-day="06/30/2024" class="day old weekend">30</td><td data-action="selectDay" data-day="07/01/2024" class="day">1</td><td data-action="selectDay" data-day="07/02/2024" class="day">2</td><td data-action="selectDay" data-day="07/03/2024" class="day">3</td><td data-action="selectDay" data-day="07/04/2024" class="day">4</td><td data-action="selectDay" data-day="07/05/2024" class="day">5</td><td data-action="selectDay" data-day="07/06/2024" class="day weekend">6</td></tr><tr><td data-action="selectDay" data-day="07/07/2024" class="day weekend">7</td><td data-action="selectDay" data-day="07/08/2024" class="day">8</td><td data-action="selectDay" data-day="07/09/2024" class="day">9</td><td data-action="selectDay" data-day="07/10/2024" class="day">10</td><td data-action="selectDay" data-day="07/11/2024" class="day">11</td><td data-action="selectDay" data-day="07/12/2024" class="day">12</td><td data-action="selectDay" data-day="07/13/2024" class="day weekend">13</td></tr><tr><td data-action="selectDay" data-day="07/14/2024" class="day weekend">14</td><td data-action="selectDay" data-day="07/15/2024" class="day">15</td><td data-action="selectDay" data-day="07/16/2024" class="day">16</td><td data-action="selectDay" data-day="07/17/2024" class="day">17</td><td data-action="selectDay" data-day="07/18/2024" class="day">18</td><td data-action="selectDay" data-day="07/19/2024" class="day active today">19</td><td data-action="selectDay" data-day="07/20/2024" class="day weekend">20</td></tr><tr><td data-action="selectDay" data-day="07/21/2024" class="day weekend">21</td><td data-action="selectDay" data-day="07/22/2024" class="day">22</td><td data-action="selectDay" data-day="07/23/2024" class="day">23</td><td data-action="selectDay" data-day="07/24/2024" class="day">24</td><td data-action="selectDay" data-day="07/25/2024" class="day">25</td><td data-action="selectDay" data-day="07/26/2024" class="day">26</td><td data-action="selectDay" data-day="07/27/2024" class="day weekend">27</td></tr><tr><td data-action="selectDay" data-day="07/28/2024" class="day weekend">28</td><td data-action="selectDay" data-day="07/29/2024" class="day">29</td><td data-action="selectDay" data-day="07/30/2024" class="day">30</td><td data-action="selectDay" data-day="07/31/2024" class="day">31</td><td data-action="selectDay" data-day="08/01/2024" class="day new">1</td><td data-action="selectDay" data-day="08/02/2024" class="day new">2</td><td data-action="selectDay" data-day="08/03/2024" class="day new weekend">3</td></tr><tr><td data-action="selectDay" data-day="08/04/2024" class="day new weekend">4</td><td data-action="selectDay" data-day="08/05/2024" class="day new">5</td><td data-action="selectDay" data-day="08/06/2024" class="day new">6</td><td data-action="selectDay" data-day="08/07/2024" class="day new">7</td><td data-action="selectDay" data-day="08/08/2024" class="day new">8</td><td data-action="selectDay" data-day="08/09/2024" class="day new">9</td><td data-action="selectDay" data-day="08/10/2024" class="day new weekend">10</td></tr></tbody></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Year"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Year">2024</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Year"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectMonth" class="month">Jan</span><span data-action="selectMonth" class="month">Feb</span><span data-action="selectMonth" class="month">Mar</span><span data-action="selectMonth" class="month">Apr</span><span data-action="selectMonth" class="month">May</span><span data-action="selectMonth" class="month">Jun</span><span data-action="selectMonth" class="month active">Jul</span><span data-action="selectMonth" class="month">Aug</span><span data-action="selectMonth" class="month">Sep</span><span data-action="selectMonth" class="month">Oct</span><span data-action="selectMonth" class="month">Nov</span><span data-action="selectMonth" class="month">Dec</span></td></tr></tbody></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Decade"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Decade">2020-2029</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Decade"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectYear" class="year old">2019</span><span data-action="selectYear" class="year">2020</span><span data-action="selectYear" class="year">2021</span><span data-action="selectYear" class="year">2022</span><span data-action="selectYear" class="year">2023</span><span data-action="selectYear" class="year active">2024</span><span data-action="selectYear" class="year">2025</span><span data-action="selectYear" class="year">2026</span><span data-action="selectYear" class="year">2027</span><span data-action="selectYear" class="year">2028</span><span data-action="selectYear" class="year">2029</span><span data-action="selectYear" class="year old">2030</span></td></tr></tbody></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Century"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5">2000-2090</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Century"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectDecade" class="decade old" data-selection="2006">1990</span><span data-action="selectDecade" class="decade" data-selection="2006">2000</span><span data-action="selectDecade" class="decade" data-selection="2016">2010</span><span data-action="selectDecade" class="decade active" data-selection="2026">2020</span><span data-action="selectDecade" class="decade" data-selection="2036">2030</span><span data-action="selectDecade" class="decade" data-selection="2046">2040</span><span data-action="selectDecade" class="decade" data-selection="2056">2050</span><span data-action="selectDecade" class="decade" data-selection="2066">2060</span><span data-action="selectDecade" class="decade" data-selection="2076">2070</span><span data-action="selectDecade" class="decade" data-selection="2086">2080</span><span data-action="selectDecade" class="decade" data-selection="2096">2090</span><span data-action="selectDecade" class="decade old" data-selection="2106">2100</span></td></tr></tbody></table></div></div></li><li class="picker-switch accordion-toggle"></li></ul></div></div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>



<?php
$content = ob_get_clean();
include 'layouts.php';
?>
