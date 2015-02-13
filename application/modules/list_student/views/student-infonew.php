<style>

.student-info { background:#ecf0f3; font-family:Arial, Helvetica, sans-serif;}

.student-info .student_info_header { padding:5px;}

.student-info .student_info_header span { margin-right:15px;}
.student-info .attend-box,
.student-info .grades-box { padding:15px 10px; border-top:1px dotted #000000; overflow:hidden;}
.student-info h3 {
	float:left;
	font-size:12px;
	margin:0px;
	padding-right:1%;
	line-height:1;
	width:11%;
	text-transform:uppercase;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:normal;
	}
.student-info h3 i { font-size:30px; margin-top:10px;}
.student-info .attend-tbl { float:left; width:88%; background:#9f9f9f;}
.student-info table {}
.student-info table tr { text-align:center; font-size:12px;}
.student-info table tr td { padding:8px 1px !important; border:none;}
.student-info .attend-tbl table tr + tr td { border-top:1px solid #323232;}
.student-info .attend-tbl tabel tr:first-child  {background:#9f9f9f !important;} 
.student-info .attend-tbl table tr td:nth-child(odd) {background: #ecf0f3;}
.student-info .attend-tbl table tr td:first-child { border-right:1px solid #323232; background:#9f9f9f;}
.student-info .attend-tbl .table td:last-child {
    border-radius:0px;
}
.student-info .grades-tbl { float:left; width:88%;}
.student-info .grades-tbl table { border:1px solid #7a7a7a;}
.student-info .grades-tbl table tr td + td { border-left:1px solid #7a7a7a;}
.student-info .grades-tbl table tr + tr td { border-top:1px solid #7a7a7a;}
.student-info .grades-tbl ul { margin:0px; padding:0px; list-style-type:none; background:#d1dadf; overflow:hidden; border-radius:5px 5px 0 0; border:0px;}
.student-info .grades-tbl ul li { text-align:center;}
.student-info .grades-tbl ul li.active,
.student-info .grades-tbl ul li:hover { background:#ffffff; border-radius:5px 5px 0 0;}


.student-info .grades-tbl a { text-decoration:none; color:#000000;}

.student-info .tab-content {

	padding:15px 10px;

	background:#ffffff;

	}

</style>

<script src="<?php print base_url(); ?>assets/js/tabs_accordian.js" type="text/javascript"></script>

<div class="student-info">

	<div class="student_info_header">

    	<span>Primary Teacher:teacher name</span>

        <span>Secondary Teacher:secondary teacher name</span>

        <span>Classroom: G304</span>

        <span>Shift:PM</span>

    </div>

    <div class="attend-box">

    	<h3>Attendance <br /><i class="fa fa-th-list"></i></h3>

        <div class="attend-tbl">

        <table width="100%" cellspacing="0" cellpadding="0" border="0">
        	<tbody>
            	<tr>
                	<td>Total</td>
                    <td>%</td>
                    <td>Wk 1</td>
                    <td>Wk 2</td>
                    <td>Wk 3</td>
                    <td>Wk 4</td>
                    <td>Wk 5</td>
                    <td>Wk 6</td>
                    <td>Wk 7</td>
                    <td>Wk 8</td>
                    <td>Wk 9</td>
                    <td>Wk 10</td>
                    <td>Wk 11</td>
                    <td>Wk 12</td>
                    <td>Wk 13</td>
                    <td>Wk 14</td>
                    <td>Wk 15</td>
                    <td>Wk 16</td>
                    <td>Wk 17</td>
                </tr>
                <tr>
                	<td>77</td>
                    <td>26.33</td>
                    <td>15</td>
                    <td>10</td>
                    <td>5</td>
                    <td>0</td>
                    <td>2</td>
                    <td>0</td>
                    <td>1</td>
                    <td>20</td>
                    <td>0</td>
                    <td>0</td>
                    <td>18</td>
                    <td>2</td>
                    <td>0</td>
                    <td>2</td>
                    <td>4</td>
                    <td>5</td>
                    <td>0</td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>

    
    <div class="grades-box">
    	<h3>Grades <br /><i class="fa fa-list-ol"></i></h3>
        <div class="grades-tbl">
        <div class="tabbable">
            <ul class="nav nav-tabs" id="tab-01">
              <li class="active"><a href="#tab2Personal">CA</a></li>
              <li><a href="#tab2Contact">Tab2</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab2Personal">
              	<table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tbody>
						<tr>
							<td>Attendance</td>
							<td>Marks(10)</td>
							<td>%</td>
							<td>Attendance</td>
							<td>Marks(10)</td>
							<td>%</td>
							<td>Total marks (20)</td>
							<td>Percentage (20%)</td>
						</tr>
						<tr>
							<td>Present</td>
							<td>10</td>
							<td>10</td>
							<td>Present</td>
							<td>10</td>
							<td>10</td>
							<td>20</td>
							<td>20</td>
						</tr>
					</tbody>
				</table>
              </div>

              <div class="tab-pane" id="tab2Contact">
                Tab two content 
              </div>
            </div>
          </div>
        </div>
    </div>
</div>