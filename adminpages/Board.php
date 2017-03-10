<?php 
   include_once("function.php");
	connect();
	 include_once("Boardphp.php");
	 mysqli_select_db($connection,"cbtonline_db");
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
		 
		 
?>


<?php 
if(isset($_GET['fin']) || !isset($_GET['fin']))
	{	
	 $result=mysqli_query($connection,"SELECT *FROM boards");
		 if(!$result)
		 {
			 echo mysqli_error($connection);
		 }
			$num_rows=mysqli_num_rows($result);
			$per_page=10;
			$page=floor($num_rows/$per_page);
			
			$start=0;
			//$finish=$per_page;
		if(isset($_GET['fin']))
			{
				
				if($_GET['fin']>$num_rows)
				{
					//$finish=$num_rows;
					$start=$finish-$per_page;
				}
					
				else
				{
					
					//$finish=$_GET['fin'];
					$start=$_GET['fin']-$per_page;
				}
				
			}
	}
?>

<?php
	global $connection;
	if(isset($_POST['submit_board']))
		{
			
			mysqli_select_db($connection,"cbtonline_db");
			$board_title=$_POST['board_title'];
			$board_description=$_POST['board_description'];
			$course_select="";
			
			if(isset($_POST['course_select']))
				{	$course_selectarry=$_POST['course_select'];
			
					for($c=0;$c<count($course_selectarry);$c++)
					{
					if($c==count($course_selectarry)-1)
						{
							$course_select.=$course_selectarry[$c];
						
						}
					else
						{
							$course_select.=$course_selectarry[$c].',';
						}
					}
				}

			$result=mysqli_query($connection,"SELECT *FROM boards WHERE board_title='{$board_title}'");
			$res=mysqli_fetch_array($result);
			$check=mysqli_num_rows($result);
			$publish='Y';
	 
			if($check<=0)
			{
				 $image_name=$_FILES['board_img']['name'];
				$move=move_uploaded_file($_FILES['board_img']['tmp_name'],'images/'.$_FILES['board_img']['name']);
				 $query="INSERT INTO boards (board_title,board_description,board_courses,board_img,publish) 
				 VALUES ('{$board_title}','{$board_description}','{$course_select}','{$image_name}','{$publish}')";
				 $result=mysqli_query($connection,$query);
				 if($result)
				 {
					$feedback="Board created successfully";
					 
				 }
				 else
				 {
					$feedback=mysqli_error($connection);
				 }
				 
			}
			else
			{
				 
				$feedback_error="Board name Already exits";
			}
				
			
		}

?>

<?php
	
	if(isset($_POST['update_board']))
		{
			global $connection;
			 	 
			$target=$_GET['target'];
			mysqli_select_db($connection,"cbtonline_db");
			//$board_target=$_POST['update_board'];
			$board_title=$_POST['board_title'];
			$board_description=$_POST['board_description'];
			$query='';
			$course_select="";
			if(isset($_POST['course_select']))
				{	$course_selectarry=$_POST['course_select'];
			
					for($c=0;$c<count($course_selectarry);$c++)
					{
					if($c==count($course_selectarry)-1)
						{
							$course_select.=$course_selectarry[$c];
						
						}
					else
						{
							$course_select.=$course_selectarry[$c].',';
						}
					}
				}
			
			$result=mysqli_query($connection,"SELECT *FROM boards WHERE id={$target} LIMIT 1");
			$res=mysqli_fetch_array($result);
			$result_title=mysqli_query($connection,"SELECT *FROM boards WHERE board_title='{$board_title}' LIMIT 1");
			$res_title=mysqli_fetch_array($result_title);
			$res_num=mysqli_num_rows($result_title);
				
			$check=mysqli_num_rows($result);
			$publish='Y';
			
				
				if($check>0)
			{
				
				if($res_num>0)
					{
						if($res_title['id']==$target)
						{
								if(!$_FILES['board_img']['name']=='')
									{
										$image_name=$_FILES['board_img']['name'];
										$move=move_uploaded_file($_FILES['board_img']['tmp_name'],'images/'.$_FILES['board_img']['name']);

										$query="UPDATE  boards SET board_title='{$board_title}',board_description='{$board_description}'
										,board_courses='{$course_select}',board_img='{$image_name}' WHERE id={$target}";
										 
										
									}
								else
									{
										$query="UPDATE  boards SET board_title='{$board_title}',board_description='{$board_description}'
										,board_courses='{$course_select}' WHERE id={$target}";
									}
						
						 
									 $result=mysqli_query($connection,$query);
									 if($result)
									 {
										$feedback="update successfully";
										  
									 }
									 else
									 {
										$feedback=mysqli_error($connection);
									 } 
						}
						else
						{
							$feedback_error='set name already exit';
						}
					}
				else
				{
					if(!$_FILES['board_img']['name']=='')
							{
								$image_name=$_FILES['board_img']['name'];
								$move=move_uploaded_file($_FILES['board_img']['tmp_name'],'images/'.$_FILES['board_img']['name']);

								$query="UPDATE  boards SET board_title='{$board_title}',board_description='{$board_description}'
								,board_courses='{$course_select}',board_img='{$image_name}' WHERE id={$target}";
								 
								
							}
						else
							{
								$query="UPDATE  boards SET board_title='{$board_title}',board_description='{$board_description}'
								,board_courses='{$course_select}' WHERE id={$target}";
							}
				
				 
							 $result=mysqli_query($connection,$query);
							 if($result)
							 {
								$feedback="update successfully";
								  
							 }
							 else
							 {
								$feedback=mysqli_error($connection);
							 } 
					$feedback='Set Updated';
				}
				
			}
			

		
		
		}
?>
<?php

	if(isset($_POST['delete_board']))
		{
			global $connection;
			mysqli_select_db($connection,"cbtonline_db");
			$board_title=$_POST['delete_board'];
			$query="DELETE FROM boards WHERE board_title='{$board_title}'";
			$result=mysqli_query($connection,$query);
			if(!$result)
				{
					echo mysqli_error($connection);
				}
			else
				{
					echo "successfull;";
				}
			
		}
	


 ?>
 <?php

	if(isset($_POST['delete_board_id']))
		{
			global $connection;
			mysqli_select_db($connection,"cbtonline_db");
			$id=$_POST['delete_board_id'];
			$query="DELETE FROM boards WHERE id='{$id}'";
			$result=mysqli_query($connection,$query);
			if(!$result)
				{
					echo mysqli_error($connection);
				}
			else
				{
					echo "successfull;";
				}
			
		}
	


 ?>
<?php 

	if(isset($_POST['publish']))
	{
		 
		$title=$_POST['publish'];
		$query="SELECT *FROM boards WHERE board_title='{$title}'";
		echo $title;
		mysqli_select_db($connection,"cbtonline_db");
		$no='N';
		$yes='Y';
		$result=mysqli_query($connection,$query);
		$res=mysqli_fetch_array($result);
		if(!$result)
				{
					echo mysqli_error($connection);
				}
			else
				{			
					if($res['publish']=='Y')
					{
						$result=mysqli_query($connection,"UPDATE boards SET publish='{$no}' WHERE board_title='{$title}'");
						echo "success N";
					}
				else
					{
						$result=mysqli_query($connection,"UPDATE boards SET publish='{$yes}' WHERE board_title='{$title}'");
						echo "success Y";
					}
				}
			
	}
	



?>
<?php 

	if(isset($_POST['unpublishid']))
	{
		
		$title=$_POST['unpublishid'];
		$query="SELECT *FROM boards WHERE id='{$title}'";
		mysqli_select_db($connection,"cbtonline_db");		
		$no='N';
		$result=mysqli_query($connection,$query);
		$res=mysqli_fetch_array($result);
		if(!$result)
				{
					echo mysqli_error($connection);
				}
			else
				{
										
				$result=mysqli_query($connection,"UPDATE boards SET publish='{$no}' WHERE id='{$title}'");

				}
		
	}
	
?>

<?php 

	if(isset($_POST['publishid']))
	{
		
		$title=$_POST['publishid'];
		$query="SELECT *FROM boards WHERE id='{$title}'";
		mysqli_select_db($connection,"cbtonline_db");		
		$yes='Y';
		$result=mysqli_query($connection,$query);
		$res=mysqli_fetch_array($result);
		if(!$result)
				{
					echo mysqli_error($connection);
				}
			else
				{
										
				$result=mysqli_query($connection,"UPDATE boards SET publish='{$yes}' WHERE id='{$title}'");

				}
		
	}
	
?>

<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UI-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="../css/bootstrap.min.css" rel="stylesheet"> 
	<link href="admincss/Dashboard.css" rel="stylesheet"> 
	<link href="admincss/Board.css" rel="stylesheet"> 
	<script src='adminjs/jquery-3.1.0.min.js'></script>
	<script src='../jquery-ui.js'></script>
	<script src='../js/bootstrap.min.js'></script>
	<script src='adminjs/Chart.min.js'></script>
	 <script src='adminjs/Board.js'></script>
	 <link  rel="stylesheet" href="chosen_v1.4.0/chosen.min.css"> 
	 <script src='chosen_v1.4.0/chosen.jquery.min.js'></script>
	 
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
						<p><span class='glyphicon glyphicon-user'></span> Online User: <b>0</b></p>

					</div>
				</div>
				
				<!--sidebar menu-->
				<div class='row' id='menu'>
					<ul>
						<li ><a href='Dashboard.php'><span class='glyphicon glyphicon-th'></span> DashBoard</a></li>
						<li class='active' >
							<a href='#board-drp'   class='collapse' data-toggle='collapse'>
								<span class='glyphicon glyphicon-folder-close'></span> Board 
								<span class='caret pull-right'></span>
							</a>
							<div id='menu-drp'>
								<ul class='collapse in'     id='board-drp'>
									<li><a href='Board.php?add-board'><span class='glyphicon glyphicon-plus'></span> Add New</a></li>
									<li><a href='Board.php?edit-board'><span class='glyphicon glyphicon-edit'></span> Edit Board<span class='hidden-xs label label-success pull-right'><?php echo $board_num;?></span></a></li>
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
									<li><a href='Course.php?edit-course'><span class='glyphicon glyphicon-edit'></span> Edit Course<span class='hidden-xs label label-success pull-right'><?php echo $course_num;?></span></a></li>
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
									<li><a href='Questionset.php?edit-questionset'><span class='glyphicon glyphicon-edit'></span> Edit Set<span class='hidden-xs label label-success pull-right'><?php echo $questionset_num;?></span></a></li>
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
									<li><a href='Question.php?edit-question'><span class='glyphicon glyphicon-edit'></span> Edit question<span class='hidden-xs label label-success pull-right'><?php echo $question_num; ?></span></a></li>
								</ul>	
							</div>
						</li>
						
						 <li ><a href='Student.php'><img src='images/student_male-24.png' class='img pull-left tutor1-img img-responsive'> Student</a></li>
						<li ><a href='Tutor.php'><img src='images/tutor_sm_icon.jpg' class='img pull-left tutor1-img img-responsive'> Tutor</a></li>
						
					</ul>
				</div>
				 	
			</div>
			
		<!-- main content-->
			<div  class='maincontent col-lg-10 col-md-10 col-sm-9  col-xs-12'>
		<?php 
		if(isset($feedback))
			{?>
				<div class='alert alert-success'>
					<a href'#' class='close' data-dismiss='alert'>&times;</a>
					<strong><?php echo $feedback;?> </strong>  
				</div>
		<?php }
			if(isset($feedback_error))
			{?>
				<div class='alert alert-danger'>
					<a href'#' class='close' data-dismiss='alert'>&times;</a>
					<strong><?php echo $feedback_error;?> </strong> <br>please Enter a valid name title 
				</div>
			<?php }?>
		<!-- add board-->
				<?php if(isset($_GET['add-board']))
				{	
					global $connection;
						mysqli_select_db($connection,'cbtonline_db');
					$result=mysqli_query($connection,"SELECT *FROM courses");
					
					
					?>
				<div id='add-board'>
				<div class='row details-row'>
					<h4 class=' text-success'>Create New Board</h4>
						<p class=' info-details ' style='font-family:Arial'>Create new board and add already created courses.</br>
						 Hold control key  add multiple courses to your board.</b>Note:courses can be added to created board later.</p>
				</div>
				<div class='row'>
					 <div class='col-lg-9 board-form'>
						<form method='post' enctype='multipart/form-data'>
							<h4>Upload Board image</h4><input type='file' class='form-control' name='board_img' id='board_img'> </br>
							<div class='form-group ' id='board-name-group'>
								<label for='board-name-field'>Title </label>
								<input id='board-name-field' type='text' name='board_title' placeholder='Name' class='form-control'/>
								<span class='glyphicon glyphicon-warning-sign fdbk1 form-control-feedback hidden'></span>
								<span class='help-block fdbk1 hidden'>Invalid name title(choose another title)</span>
							</div>
							<div class='form-group'id='board-description-group'>
								<label for='board-addcrs-field'> Description </label>
								<textarea id='board-description-field' cols='4' name='board_description' rows='5' class='form-control'></textarea>
								<span class='glyphicon glyphicon-warning-sign fdbk2  form-control-feedback hidden'></span>
								<span class='help-block fdbk2  hidden'>Invalid Description</span>
							</div>
							 <div class='form-group' id='course-select-group'>
									
									<select id='course-select' class='form-control chosen-select' name='course_select[]' data-placeholder='Select Courses' multiple class='chosen-select'>
									 
										 <?php 
										 while($res=mysqli_fetch_array($result))
										 {
											echo "<option>".$res['course_title']."</option>";
										}?> 
									
									</select>
									<span class='glyphicon glyphicon-warning-sign fdbk3  form-control-feedback hidden'></span>
								<span class='help-block fdbk3 hidden'>Invalid Course selected</span>
 							</div>
							
							<button type='submit' id='board-submit-btn' name='submit_board' class='btn btn-block btn-success'><span class='glyphicon glyphicon-plus'></span> Add</button>
							
						</form>
					 </div>
					 <div class='col-lg-3 board-qk-tl'>
						<div class='panel panel-primary	'>
							<div class='panel-heading'>
								<h4 class='panel-title'>Quick Tools <span class='glyphicon glyphicon-cog pull-right '></span></h4>
							</div>
							<ul class='list-group'>
								 <a class='list-group-item' data-target='#add-course-modal' data-toggle='modal'><span class='glyphicon glyphicon-plus'></span> Add New Course</a>
								 <a href='Board.php?edit-board' class='list-group-item'  ><span class='glyphicon glyphicon-edit'></span> Edit Boards</a>
								 <div class='modal' id='add-course-modal' tabindex='-1'>
									<div class='modal-dialog'>
										<div class='modal-content'>
											<div class='modal-header'> 
												<a href='' data-dismiss='modal' class='close'>&times;</a>
												<h4 class='modal-title'>Add New Course</h4>
											</div>
											<div class='modal-body'>
											<form >
												<div class='form-group ' id='course-modal-name-group'>
													<label for='board-name-field'>Title </label>
													<input id='course-modal-name-field' type='text' placeholder='Name' class='form-control'>
													<span class='glyphicon glyphicon-warning-sign m-fdbk1  form-control-feedback hidden'></span>
													<span class='help-block m-fdbk1 hidden'>Invalid Course selected</span>
												</div>
												Add sets
											<div class='form-group' id='course-modal-select-group'>
									
												<select id='course-modal-select' class='form-control chosen-select' data-placeholder='Select QuestionSets' multiple class='chosen-select'>
						 						<?php 
												 while($res=mysqli_fetch_array($result))
												 {
													echo "<option>".$res['course_title']."</option>";
												}?> 
									
												</select>
												<span class='glyphicon glyphicon-warning-sign m-fdbk3  form-control-feedback hidden'></span>
												<span class='help-block m-fdbk3 hidden'>Invalid Course selected</span	>
									
											</div>
												
											</form>
											</div>
											<div class='modal-footer'>
												<button type='button'  id='course-modal-submit-btn' class='btn btn-success' > Add</button>
												<button class='btn btn-warning' data-dismiss='modal' >Close</button>
											</div>
										</div>
									</div>
								 </div>
							</ul>
							<div class='panel-footer'>
								
							</div>
						</div>
					 </div>
				</div>
				</div>
				<?php } ?>
				
				<!-- edit board-->
				<?php if(isset($_GET['edit-board']))
					{  
						  global $connection;
							mysqli_select_db($connection,'cbtonline_db');
						$result=mysqli_query($connection,"SELECT *FROM courses");
				  		
						
					  ?>
				<div class='row details-row'>
					<h4 class=' text-success'>Manage Board</h4>
						<p class=' info-details ' style='font-family:Arial'>Edit and Manage Board.</p>
					<form>
							<div class='form-group'>
								<div class='input-group'>
									<input type='text' placeholder='Search' id='search_bd' class='form-control'>
									<span class='input-group-btn'>
										<button type='button' class='btn btn-success'>Go</button>
									</span>
								</div>
							</div>
						
						</form>
					
				</div>
				<div class='row' >
					
					<div class='col-lg-12 board-form board-form-edit'>
						<div id='edit_board_modal' class='modal fade' tabindex='-1'>
						
						<div class='modal-dialog modal-lg'>
						 
						<div class='modal-content'>
						 <div class='modal-header'>
							<h3 class='modal-title'>Edit Board Content</h3>
						 </div>
						<div class='modal-body'>
						<form id='edit_board' action='Board.php?edit-board' method="POST" enctype='multipart/form-data'>
						<a  id='close_edit_form' class='close' data-dismiss='form'>&times;</a>
						<div id='board_img_div'>
							<img id='board_img' src='' width='140px' height='120px' /><p class='text-primary'>Board current image</p>
						</div>
							<h4>Upload Board image</h4><input type='file' class='form-control' name='board_img' id='board_img'> </br>
							<div class='form-group ' id='board-name-group'>
								<label for='board-name-field'>Title </label>
								<input id='board-name-field' type='text'   name='board_title' placeholder='Name' class='form-control'/>
								<span class='glyphicon glyphicon-warning-sign fdbk1 form-control-feedback hidden'></span>
								<span class='help-block fdbk1 hidden'>Invalid name title</span>
							</div>
							<div class='form-group'id='board-description-group'>
								<label for='board-addcrs-field'> Description </label>
								<textarea id='board-description-field' cols='4' name='board_description' rows='5' class='form-control'></textarea>
								<span class='glyphicon glyphicon-warning-sign fdbk2  form-control-feedback hidden'></span>
								<span class='help-block fdbk2  hidden'>Invalid Description</span>
							</div>
							 
							 <div class='form-group' id='course-select-group'>
									
									<select id='course-select' class='form-control chosen-select' name='course_select[]' data-placeholder='Select Courses' multiple class='chosen-select'>
										<?php 
										 while($res=mysqli_fetch_array($result))
										 {
											echo "<option>".$res['course_title']."</option>";
										}?> 
									
									</select>
									<span class='glyphicon glyphicon-warning-sign fdbk3  form-control-feedback hidden'></span>
								<span class='help-block fdbk3 hidden'>Invalid Course selected</span>
 							</div>
							
							<button type='submit' id='board-update-btn' name='update_board' class='btn btn-block btn-success'> Update</button>
							
						</form>
			 </div>
			<div class='modal-footer'>
			
			</div>
			</div>
				</div>	
					 </div>
				</div>
				<!-- quick tools-->	
							<div class='col-lg-3 col-xs-12 board-qk-tl pull-right'>
						 <div class='panel panel-primary	'>
							<div class='panel-heading'>
								<h4 class='panel-title'>Quick Tools</h4>
							</div>
							<ul class='list-group'>
								 <a href='Board.php?add-board' class='list-group-item'  ><span class='glyphicon glyphicon-plus'></span> Add New Board</a>
								 <a class='list-group-item' data-target='#view-board-modal'><span class='glyphicon glyphicon-edit'></span> Edit Boards</a>
								 
							</ul>
							<div class='panel-footer'>
								
							</div>
						</div>
					 </div>
						
							<div class='col-lg-9 col-xs-12 edit-table pull-left'>
								<div class='table-responsive'>
								<table class='table table-striped table-hover table-condensed '  id='edit-bd-table'>
									<thead>
										<tr>
											<th>SN</th>
											<th>Published</th>
											<th></th>
											<th>Title</th>
											<th>Description</th>
											<th>Courses</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									<?php 
									
 										$result=page_request_boards($start,$per_page);
										//mysqli_select_db($connection,"cbtonline_db");
										//$result=mysqli_query($connection,"SELECT *FROM boards LIMIT 3,1");
										while($boards=mysqli_fetch_array($result))
									{
										$bd_des=$boards['board_description'];
										$bd_des=str_replace(' ' ,'_',$bd_des);
										 $dang='dang'.$boards['board_title'];
									?>
										<tr >
											<td><?php echo $boards['id'];?></td>
											<td><?php if($boards['publish']=='Y'){
												echo "<span class='glyphicon glyphicon-ok text-success $dang'></span>" ;}else{
													echo "<span class='glyphicon glyphicon-remove text-danger $dang'></span>";}?></td>
											<td> <input id="<?php echo $boards['id'];?>" class='checkbox-edit' type='checkbox' ></td>
											<td><?php echo $boards['board_title'];?></td>
											<td><?php echo $boards['board_description'];?></td>
											<td><?php echo $boards['board_courses'];?></td>
											 
											<td> 
													  <div class='btn-group btn-group-xs '>
													<button id='edit-board'
														board_id="<?php if(isset($boards['id'])){echo $boards['id'];} ?>"
														board_img="<?php if(isset($boards['board_img'])){echo $boards['board_img']; }?>"
														board_title="<?php if(isset($boards['board_title'])){echo $boards['board_title'];} ?>"
														board_description="<?php if(isset($boards['board_description'])){echo $bd_des;} ?> "
														board_courses="<?php if(isset($boards['board_courses'])){echo $boards['board_courses'];} ?>"
														type='button' class='btn btn-primary edit-board ' data-toggle='modal' data-target='#edit_board_modal'>Edit
													</button>
													
													<button type='button' 
														board_title="<?php if(isset($boards['board_title'])){echo $boards['board_title'];} ?>"
														class='btn btn-warning delete_board'>Delete
													</button>
													
													<button type='button' id='<?php echo $boards['board_title']; ?>' board_name="<?php echo $boards['board_title']; ?>"
													board_publish=<?php echo $boards['publish']; ?>
													class="btn publish_btn
														<?php if($boards['publish']=='Y'){echo 'btn-danger';}else{ echo 'btn-success';}?>"> 
													<?php if($boards['publish']=='Y'){echo 'Unpublish';}else{ echo 'Publish';}?>
													</button>
													
											</div></td>
										</tr>
									<?php }?>
										
									</tbody>
									
								</table>
									<ul class='pagination'>
										<?php
											for($c=1;$c<=$page;$c++)
												{
													$fin=$c*$per_page;
													echo "<li><a href='Board.php?edit-board&fin=$fin'>$c</a></li>";
												}
										?>
									</ul>
								<div class='well edit-board-well'>
									<ul>
										<li><a href='' id='chkbx-del' class='text-warning'><span class='glyphicon  glyphicon-trash'></span> Delete</a></li>
 										<li><a href='' id='chkbx-unpub' class='text-danger'><span class='glyphicon glyphicon-remove'></span> Unpublish</a></li>
										<li><a href='' id='chkbx-pub' class='text-success'><span class='glyphicon glyphicon-ok'></span> publish</a></li>
									</ul>
								</div>
								</div>
							</div>
					
						</div>
						
						
				<?php } ?>
				
			</div>
		</div>
		</div><!--1st row-->
	</div><!--container-->
		
</body>
</html>