<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UI-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="../css/bootstrap.min.css" rel="stylesheet"> 
	<link href="admincss/Dashboard.css" rel="stylesheet"> 
	<link href="admincss/Student.css" rel="stylesheet"> 
	<script src='adminjs/jquery-3.1.0.min.js'></script>
	<script src='../jquery-ui.js'></script>
	<script src='../js/bootstrap.min.js'></script>
	<script src='adminjs/Chart.min.js'></script>
	 <script src='adminjs/Board.js'></script
	<style type='text/css'>
		 
	
	</style>
</head>
<body>
	<div class='container'>	
		<div class='row row1'>
		
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
		<div class='row' id='inner-row2'>
		<!--side bar-->
			<div  class='sidebar col-lg-2 col-md-2 col-sm-3 col-xs-12  ' id='side-bar' >
				 
					<!-- admin details-->
				<div class='row ' id='admin-details'>
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
						<p><span class='glyphicon glyphicon-user'></span> Online User: <b>100</b></p>

					</div>
				</div>
				
				<!--sidebar menu-->
				<div class='row' id='menu'>
					<ul>
						<li ><a href='Dashboard.php'><span class='glyphicon glyphicon-th'></span> DashBoard</a></li>
						<li>
							<a href='#board-drp'   class='collapse' data-toggle='collapse'>
								<span class='glyphicon glyphicon-folder-close'></span> Board 
								<span class='caret pull-right'></span>
							</a>
							<div id='menu-drp'>
								<ul class='collapse'     id='board-drp'>
									<li><a href='Board.php'><span class='glyphicon glyphicon-plus'></span> Add New</a></li>
									<li><a href='Board.php'><span class='glyphicon glyphicon-edit'></span> Edit Board<span class='hidden-xs label label-success pull-right'>10</span></a></li>
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
									<li><a href='Course.php'><span class='glyphicon glyphicon-plus'></span> Add New</a></li>
									<li><a href='Course.php'><span class='glyphicon glyphicon-edit'></span> Edit Course<span class='hidden-xs label label-success pull-right'>8</span></a></li>
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
									<li><a href='Questionset.php'><span class='glyphicon glyphicon-plus'></span> Add New</a></li>
									<li><a href='Questionset.php'><span class='glyphicon glyphicon-edit'></span> Edit Set<span class='hidden-xs label label-success pull-right'>4</span></a></li>
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
									<li><a href='Question.php'><span class='glyphicon glyphicon-plus'></span> Add New</a></li>
									<li><a href='Question.php'><span class='glyphicon glyphicon-edit'></span> Edit question<span class='hidden-xs label label-success pull-right'>105</span></a></li>
								</ul>	
							</div>
						</li>
						
						 <li class='active' ><a href='Student.php'><img src='images/student_male-24.png' class='img pull-left tutor1-img img-responsive'> Student</a></li>
						<li ><a href='Tutor.php'><img src='images/tutor_sm_icon.jpg' class='img pull-left tutor1-img img-responsive'> Tutor</a></li>
						
					</ul>
				</div>
				 	
			</div>
			
		<!-- main content-->
			<div  class='maincontent col-lg-10 col-md-10 col-sm-9  col-xs-12'>
				<div class='alert alert-success'>
					<a href'#' class='close' data-dismiss='alert'>&times;</a>
					<strong>Success</strong> your registeration was success
				</div>
				
				<div class='row'>
					  
				</div>
				 
			</div>
		</div>
		</div><!--1st row-->
	</div><!--container-->
		
</body>
</html>