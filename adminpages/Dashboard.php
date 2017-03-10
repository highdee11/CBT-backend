<?php 
require_once("function.php");
connect();
?>
<?php
	global $connection;
	mysqli_select_db($connection,"cbtonline_db");
	$board_nm=mysqli_query($connection,"SELECT NULL FROM boards");
	$board_num=mysqli_num_rows($board_nm);
	
	$course_nm=mysqli_query($connection,"SELECT NULL FROM courses");
	$course_num=mysqli_num_rows($course_nm);
	
	$questionset=mysqli_query($connection,"SELECT *FROM sets");
	$questionset_num=mysqli_num_rows($questionset);
	  
	 $question_num=0;
	 while($qs=mysqli_fetch_array($questionset))
		{
			 $qs_nm='set_'.$qs['questionset_title'];
			 $result_qs=mysqli_query($connection,"SELECT NULL FROM $qs_nm");
			 $res_qs=mysqli_num_rows($result_qs);
			$question_num+=$res_qs;
		}
		 
		 $q_arry=count(str_split($question_num));
		 $question_num=addzero($q_arry,$question_num);
	function addzero($q_arry,$q)
	{
		if($q_arry>0)
			{
				$q='000'.$q;
			}
		else if($q_arry>1)
			{
				$q='00'.$q;
			}
		else if($q_arry>2)
			{
				$q='0'.$q;
			}
		else if($q_arry>3)
			{
				$q=$q;
			}
			return $q;
	}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UI-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DashBoard</title>
		<style type='text/css'>
			 
	</style>
	<link href="../css/bootstrap.min.css" rel="stylesheet"> 
	<link href="admincss/Dashboard.css" rel="stylesheet"> 
	<script src='adminjs/jquery-3.1.0.min.js'></script>
	<script src='../jquery/jquery-ui.js'></script>
	<script src='adminjs/Chart.min.js'></script>
	<script src='../js/bootstrap.min.js'></script>
	 <script src='adminjs/Dashboard.js'></script>
	

</head>
<body>

	<div class='container '>	
		<div class='row row1 '>
		
	<!-- header row-->
		<div class='row'  id='inner-row1'>
		<header   id='navmenu'>
			<span class='hidden-xs site-name pull-left'><h3 >DashBoard</h3></span>
			<nav class=' pull-left navbar-default' id='nvbar'>
				 
				<button class='navbar-toggle' id='nv-btn' data-target='#side-bar'  data-toggle='collapse' aria-expanded='true'>
					<span class='icon-bar'></span>
					<span class='icon-bar'></span>
					<span class='icon-bar'></span>
			 
				</button> 
				 
			</nav>
			<ul  class='pull-right'>
				<li><a href='#' ><span class='glyphicon glyphicon-bell'></span><span class='label label-warning'>3</span></a></li>
				<li><a href='#' ><span class='glyphicon glyphicon-envelope'></span><span class='label label-success'>7</span></a></li>
 			</ul>
		</header>
			
		</div>
		
		 
	<!-- main content row-->	
		<div class='row  display-table-row' id='inner-row2'>
		<!--side bar-->
	 	
				<div  class='sidebar col-lg-2 col-md-2 col-sm-3 col-xs-12 display-table-cell' id='side-bar' >
				 
					<!-- admin details-->
				<div class='row' id='admin-details'>
					<div class='col-lg-6 col-md-6 admin-img hidden-sm  hidden-xs'>
						<img src='images/1.jpg' class='pull-left img img-responsive img-circle' >
					</div>
					<div class='col-lg-6 col-md-6 admin-name'>
						<ul>
						<li><span class='glyphicon glyphicon-user'></span> Highdee </li>
						<li ><a href='#'><span class='glyphicon glyphicon-log-out'></span> Log out </a></li>
						</ul>
					</div>
					<div class='col-lg-12 col-md-12 col-md-12 'id='online-user'>
						<p><span class='glyphicon glyphicon-user'></span> User Online: <b>0</b></p>

					</div>
					
				</div>
				
				<!--sidebar menu-->
				<div class='row' id='menu'>
					<ul>
						<li class='active'><a href='Dashboard.php'><span class='glyphicon glyphicon-th'></span> DashBoard</a></li>
						<li  >
							<a href='#board-drp'   data-toggle='collapse'>
								<span class='glyphicon glyphicon-folder-close'></span> Board 
								<span class='caret pull-right'></span>
							</a>
							<div id='menu-drp'>
								<ul class='collapse collapseable'  id='board-drp'>
									<li><a href='Board.php?add-board'><span class='glyphicon glyphicon-plus'></span> Add New</a></li>
									<li><a href='Board.php?edit-board'><span class='glyphicon glyphicon-edit'>
									</span> Edit Board<span class='hidden-xs label label-success pull-right'><?php echo $board_num; ?></span></a></li>
								</ul>
							 </div>
						</li>
						
						
						<li>
							<a href='#course-drp' data-toggle='collapse'>
								<span class='glyphicon glyphicon-book'></span> Course 
								<span class='caret pull-right'></span>
							</a>
							<div id='menu-drp'>
								<ul class='collapse collapseable' id='course-drp'>
									<li><a href='Course.php?add-course'><span class='glyphicon glyphicon-plus'></span> Add New</a></li>
									<li><a href='Course.php?edit-course'><span class='glyphicon glyphicon-edit'>
									</span> Edit Course<span class='hidden-xs label label-success pull-right'><?php echo $course_num; ?></span></a></li>
								</ul>
							</div>
						</li>
						<li>
							<a href='#set-drp' data-toggle='collapse'>
								<span class='glyphicon glyphicon-list-alt'></span> Question Set 
								<span class='caret pull-right'></span>
							</a>
							<div id='menu-drp'>
								<ul class='collapse collapseable' id='set-drp'>
									<li><a href='Questionset.php?add-questionset'><span class='glyphicon glyphicon-plus'></span> Add New</a></li>
									<li><a href='Questionset.php?edit-questionset'><span class='glyphicon glyphicon-edit'>
									</span> Edit Set<span class='hidden-xs label label-success pull-right'><?php echo $questionset_num; ?></span></a></li>
								</ul>
							</div>
						</li>
						<li>
							<a href='#question-drp' data-toggle='collapse'>
								<span class='glyphicon glyphicon-question-sign'></span> Question  
								<span class='caret pull-right'></span>
							</a>
							<div id='menu-drp'>
								<ul class='collapse collapseable' id='question-drp'>
									<li><a href='Question.php?add-question'><span class='glyphicon glyphicon-plus'></span> Add New</a></li>
									<li><a href='Question.php?edit-question'><span class='glyphicon glyphicon-edit'>
									</span> Edit question<span class='hidden-xs label label-success pull-right'><?php echo $question_num; ?></span></a></li>
								</ul>
							</div>
						</li>
						
						 <li ><a href='Student.php'><img src='images/student_male-24.png' class='img pull-left tutor1-img img-responsive'> Student</a></li>
						<li ><a href='Tutor.php'><img src='images/tutor_sm_icon.jpg' class='img pull-left tutor1-img img-responsive'> Tutor</a></li>
						
					</ul>
				</div>
				 	
			</div>
			
		<!-- main content-->
			 
			<div  class='maincontent col-lg-10 col-md-10 col-sm-9  col-xs-12 display-table-cell'>
				<div class='alert alert-success'>
					<a href'#' class='close' data-dismiss='alert'>&times;</a>
					<strong>Success</strong> your registeration was success
				</div>
				
				<div class='row'>
					<div id='stats1' class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
							<ul>
							 
								<li class='col-lg-3   col-md-4 col-sm-6 col-xs-12' style='padding:0px'>
								<div class='row'>
									<div class='col-lg-5 col-md-3 col-sm-4 col-xs-7 hidden-xs' >
									<span class='glyphicon glyphicon-user'></span>
									</div>
									<div class='col-lg-7  col-md-9 col-sm-8 col-xs-12'   >
										<div class='row'>
											<div class='col-lg-12'>
											<h1 class='pull-right'>0000</h1>
											</div>
											<div class='col-lg-12'>
											<p class='pull-right'>Population of Student</p>
											</div>
										</div>	
									</div>
									</div>
								</li>
								
								<li class='col-lg-3  col-lg-offset-1 col-md-4 col-sm-6 col-xs-12' style='padding:0px'>
								<div class='row'>
									<div class='col-lg-5 col-md-3 col-sm-4 col-xs-7 hidden-xs' >
									<span class='glyphicon glyphicon-user'></span>
									</div>
									<div class='col-lg-7  col-md-9 col-sm-8 col-xs-12'   >
										<div class='row'>
											<div class='col-lg-12'>
											<h1 class='pull-right'>0000</h1>
											</div>
											<div class='col-lg-12'>
											<p class='pull-right'>Population of Student</p>
											</div>
										</div>	
									</div>
									</div>
								</li>
								
								<li class='col-lg-3  col-lg-offset-1 col-md-4 col-sm-6 col-xs-12' style='padding:0px'>
								<div class='row'>
									<div class='col-lg-4 col-md-3 col-sm-4 col-xs-7 hidden-xs' >
									<span class='glyphicon glyphicon-question-sign'></span>
									</div>
									<div class='col-lg-8  col-md-9 col-sm-8 col-xs-12'   >
										<div class='row'>
											<div class='col-lg-12'>
											<h1 class='pull-right'><?php echo $question_num; ?></h1>
											</div>
											<div class='col-lg-12 '>
											<p class='' style='padding-left:10px'>Number of Questions</p>
											</div>
										</div>	
									</div>
									</div>
								</li>
								
								
								
							
							</ul>
					</div>
				</div>
				<div class='row'>
				<div id='bar-graph' class=' col-lg-4 col-md-4 col-sm-6 col-xs-12'>
					<canvas id='mycanvas' width='600px' height='600px'></canvas>
				</div>
				<div id='line-graph' class=' col-lg-4 col-md-3 col-sm-5 col-xs-12'>
					<canvas id='mycanvas2' width='600px' height='600px'></canvas>
				</div>
				<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>
				<div id='dash-panel' class='panel panel-primary'>
					 <div class='panel-heading'>
						<h4 class='panel-title'> Best Student Score On Board </h4>
					 </div>
					 <div class='panel-body'></div>
						<table class='table table-striped'>
							<thead>
								<tr>
									<th>Reg NO</th>
									<th>Name</th>
									<th>Score</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>031</td>
									<td>Emeka uchuz</td>
									<td>132</td>
								</tr>
								<tr>
									<td>015</td>
									<td>John cart</td>
									<td>90</td>
								</tr>
								<tr>
									<td>128</td>
									<td>Ogunbade bisi</td>
									<td>76</td>
								</tr>
								<tr>
									<td>009</td>
									<td>Adetola Adewumi</td>
									<td>75</td>
								</tr>
								 
								
							</tbody>
							
						
						</table>
					 <div class='panel-footer'>
						<a href='Student.php'>View All</a>
					 </div>
				</div>
				</div>	
				</div>
			</div>
			 
		</div>
	 
		</div><!--1st row-->
	 
	</div><!--container-->
		
</body>
</html>