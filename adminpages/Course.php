<?php require_once("function.php");
	connect();
	 require_once("Boardphp.php");
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
	mysqli_select_db($connection,"cbtonline_db");
	 $result=mysqli_query($connection,"SELECT *FROM courses");
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
	if(isset($_POST['submit_course']))
		{
			mysqli_select_db($connection,"cbtonline_db");
			$course_title=$_POST['course_title'];
			$course_description=$_POST['course_description'];
			$set_select="";
			$set_selectarry=$_POST['course_select'];
			 
				for($c=0;$c<count($set_selectarry);$c++)
				{
				if($c==count($set_selectarry)-1)
					{
						$set_select.=$set_selectarry[$c];
					
					}
				else
					{
						$set_select.=$set_selectarry[$c].',';
					}
				}

				
			$result=mysqli_query($connection,"SELECT *FROM courses WHERE course_title='{$course_title}'");
			$res=mysqli_fetch_array($result);
			$check=mysqli_num_rows($result);
			$publish='Y';
			
			if($check<=0)
			{
				 $query="INSERT INTO courses (course_title,course_description,course_sets,publish) 
			VALUES ('{$course_title}','{$course_description}','{$set_select}','{$publish}')";
				 $result=mysqli_query($connection,$query);
				 if($result)
				 {
					$feedback="Course created successfully";
					 
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

	if(isset($_POST['delete_course']))
		{
			global $connection;
			mysqli_select_db($connection,"cbtonline_db");
			$course_title=$_POST['delete_course'];
			$query="DELETE FROM courses WHERE course_title='{$course_title}'";
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

	if(isset($_POST['delete_course_id']))
		{
			global $connection;
			mysqli_select_db($connection,"cbtonline_db");
			$course_title=$_POST['delete_course_id'];
			$query="DELETE FROM courses WHERE id='{$course_title}'";
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
	global $connection;
	if(isset($_POST['update_course']))
		{
			$target=$_GET['target'];
			mysqli_select_db($connection,"cbtonline_db");
			$board_title=$_POST['course_title'];
			$board_description=$_POST['course_description'];
			$query='';
			$set_select="";
			$course_selectarry=$_POST['course_sets'];
			
			$result=mysqli_query($connection,"SELECT *FROM boards WHERE id={$target} LIMIT 1");
			$res=mysqli_fetch_array($result);
			
			
			$result_title=mysqli_query($connection,"SELECT *FROM courses WHERE course_title='{$board_title}' LIMIT 1");
			$res_title=mysqli_fetch_array($result_title);
			$res_num=mysqli_num_rows($result_title);
			 $check=mysqli_num_rows($result_title);
			 
			for($c=0;$c<count($course_selectarry);$c++)
				{
				if($c==count($course_selectarry)-1)
					{
						$set_select.=$course_selectarry[$c];
					
					}
				else
					{
						$set_select.=$course_selectarry[$c].',';
					}
				}
				 
				if($check>0)
				{ 
					if($res_title['id']==$target)
					{
						$query="UPDATE courses SET course_title='{$board_title}' , course_description='{$board_description}', course_sets='{$set_select}' 
						 WHERE id={$target}";
						 $result=mysqli_query($connection,$query);
						 if($result)
						 {
							$feedback="update successfull";
							  
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
					$query="UPDATE courses SET course_title='{$board_title}' , course_description='{$board_description}', course_sets='{$set_select}' 
						 WHERE id={$target}";
						 $result=mysqli_query($connection,$query);
						 if($result)
						 {
							 
							  $feedback='Set Updated';
						 }
						 else
						 {
							$feedback=mysqli_error($connection);
							 
						 }
						 
					
				}
			 
		}

?>

<?php 

	if(isset($_POST['publish']))
	{
		 
		$title=$_POST['publish'];
		$query="SELECT *FROM courses WHERE course_title='{$title}'";
		echo $title;
		mysqli_select_db($connection,"cbtonline_db");
		$yes='Y';
		$no='N';
		$result=mysqli_query($connection,$query);
		$res=mysqli_fetch_array($result);
		if(!$result)
				{
					echo mysqli_error($connection);
				}
			else
				{
					echo $res['publish'];
				}
		if($res['publish']=='Y')
			{
				$result=mysqli_query($connection,"UPDATE courses SET publish='{$no}' WHERE course_title='{$title}'");
				echo "success N";
			}
		else
			{
				$result=mysqli_query($connection,"UPDATE courses SET publish='{$yes}' WHERE course_title='{$title}'");
				echo "success Y";
			}
	}
	



?>
<?php 

	if(isset($_POST['unpublishid']))
	{
		 
		$title=$_POST['unpublishid'];
		$query="SELECT *FROM courses WHERE id='{$title}'";
		mysqli_select_db($connection,"cbtonline_db");
		$yes='Y';
		$no='N';
		$result=mysqli_query($connection,$query);
		$res=mysqli_fetch_array($result);
		if(!$result)
			{
				echo mysqli_error($connection);
			}
		else
			{
				$result=mysqli_query($connection,"UPDATE courses SET publish='{$no}' WHERE id='{$title}'");
			}
				
	}
	



?>
<?php 

	if(isset($_POST['publishid']))
	{
		 
		$title=$_POST['publishid'];
		$query="SELECT *FROM courses WHERE id='{$title}'";
		mysqli_select_db($connection,"cbtonline_db");
		$yes='Y';
		$no='N';
		$result=mysqli_query($connection,$query);
		$res=mysqli_fetch_array($result);
		if(!$result)
			{
				echo mysqli_error($connection);
			}
		else
			{
				$result=mysqli_query($connection,"UPDATE courses SET publish='{$yes}' WHERE id='{$title}'");
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
	<link href="admincss/Course.css" rel="stylesheet"> 
	<script src='adminjs/jquery-3.1.0.min.js'></script>
	<script src='../jquery-ui.js'></script>
	<link  rel="stylesheet" href="chosen_v1.4.0/chosen.min.css"> 	
	  <script src='chosen_v1.4.0/chosen.jquery.min.js'></script>
	<script src='../js/bootstrap.min.js'></script>
	<script src='adminjs/Chart.min.js'></script>
	 <script src='adminjs/Course.js'></script>
	 
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
						<p><span class='glyphicon glyphicon-user'></span> Online User: <b>0</b></p>

					</div>
				</div>
				
				<!--sidebar menu-->
				<div class='row' id='menu'>
					<ul>
						<li ><a href='Dashboard.php'><span class='glyphicon glyphicon-th'></span> DashBoard</a></li>
						<li >
							<a href='#board-drp'   class='collapse' data-toggle='collapse'>
								<span class='glyphicon glyphicon-folder-close'></span> Board 
								<span class='caret pull-right'></span>
							</a>
							<div id='menu-drp'>
								<ul class='collapse'     id='board-drp'>
									<li><a href='Board.php?add-board'><span class='glyphicon glyphicon-plus'></span> Add New</a></li>
									<li><a href='Board.php?edit-board'><span class='glyphicon glyphicon-edit'></span> Edit Board<span class='hidden-xs label label-success pull-right'><?php echo $board_num; ?></span></a></li>
								</ul>
							 </div>
						</li>
						
						
						<li  class='active'>
							<a href='#course-drp' data-toggle='collapse'>
								<span class='glyphicon glyphicon-book'></span> Course 
								<span class='caret pull-right'></span>
							</a>
							<div id='menu-drp'>
								<ul class='collapse collapseable in' id='course-drp'>
									<li><a href='Course.php?add-course'><span class='glyphicon glyphicon-plus'></span> Add New</a></li>
									<li><a href='Course.php?edit-course'><span class='glyphicon glyphicon-edit'></span> Edit Course<span class='hidden-xs label label-success pull-right'><?php echo $course_num; ?></span></a></li>
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
									<li><a href='Questionset.php?edit-questionset'><span class='glyphicon glyphicon-edit'></span> Edit Set<span class='hidden-xs label label-success pull-right'><?php echo $questionset_num; ?></span></a></li>
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
		<?php }?>
		<?php if(isset($feedback_error))
			{?>
				<div class='alert alert-danger'>
					<a href'#' class='close' data-dismiss='alert'>&times;</a>
					<strong><?php echo $feedback_error;?> </strong> <br>please Enter a valid name title 
				</div>
			<?php }?>
				<div class='row'>
					  
					  <!-- add board-->
				<?php if(isset($_GET['add-course']))
				{
						global $connection;
						  mysqli_select_db($connection,"cbtonline_db");
						 $result=mysqli_query($connection,"SELECT *FROM sets"); 
						 ?>
				<div id='add-board'>
				<div class='row details-row'>
					<h4 class=' text-success'>Create New Courses</h4>
						<p class=' info-details ' style='font-family:Arial'>Create new courses and add already created set.</br>
						 Hold control key  add multiple set to your board.</b>Note:Question set can be added to created courses later.</p>
				</div>
				<div class='row'>
					 <div class='col-lg-9 board-form'>
						<form method="POST" >
							<div class='form-group' id='board-name-group'>
								<label for='board-name-field'>Title </label>
								<input id='board-name-field' name='course_title' type='text' placeholder='Name' class='form-control'>
								<span class='glyphicon glyphicon-warning-sign fdbk1  form-control-feedback hidden'></span>
								<span class='help-block fdbk1 hidden'>Invalid Course selected</span>
							</div>
							<div class='form-group' id='board-description-group'>
								<label for='board-addcrs-field'> Description </label><span class='help-block fdbk2 '><p class='text-danger'>(Optional)</p></span>
								<textarea id='board-description-field' name='course_description' cols='4' rows='5' class='form-control'></textarea>
								<span class='glyphicon glyphicon-warning-sign fdbk2  form-control-feedback hidden'></span>
								
								<span class='help-block fdbk2 hidden'>Invalid Course selected</span>
							</div>
							<div class='form-group' id='course-select-group'>
									
									<select id='course-select' class='form-control chosen-select' name='course_select[]' data-placeholder='Select QuestionSets' multiple class='chosen-select'>
										 <?php 
										 while($res=mysqli_fetch_array($result))
										 {
											echo "<option>".$res['questionset_title']."</option>";
										}?> 
									</select>
								<span class='glyphicon glyphicon-warning-sign fdbk3  form-control-feedback hidden'></span>
								<span class='help-block fdbk3 hidden'>Invalid Course selected</span	>
									
 							</div>
							
							<button type='submit' name='submit_course' id='course-submit-btn' class='btn btn-success btn-block btn-lg '><span class='glyphicon glyphicon-plus'> Add</span></button>
							
						</form>
					 </div>
					 <div class='col-lg-3 board-qk-tl'>
						<div class='panel panel-primary	'>
							<div class='panel-heading'>
								<h4 class='panel-title'>Quick Tools</h4>
							</div>
							<ul class='list-group'>
								 <a class='list-group-item' data-target='#add-course-modal' data-toggle='modal'><span class='glyphicon glyphicon-plus'></span> Add New Set</a>
								 <a href='Course.php?edit-course' class='list-group-item'  ><span class='glyphicon glyphicon-edit'></span> Edit Courses</a>
								 <div class='modal' id='add-course-modal' tabindex='-1'>
									<div class='modal-dialog'>
										<div class='modal-content'>
											<div class='modal-header'> 
												<a href='' data-dismiss='modal' class='close'>&times;</a>
												<h4 class='modal-title'>Add New Set</h4>
											</div>
											<div class='modal-body'>
											<form >
												<div class='form-group' id='set-modal-name-group'>
													<label for='set-modal-name-field'>Title </label>
													<input id='set-modal-name-field' type='text' placeholder='Name' class='form-control'>
													<span class='glyphicon glyphicon-warning-sign m-fdbk1  form-control-feedback hidden'></span>
													<span class='help-block m-fdbk1  hidden'>Invalid Description</span>
												</div>
											
											</form>
											</div>
											<div class='modal-footer'>
												<button id='set-modal-submit-btn' class='btn btn-success' >Add</button>
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
				<?php if(isset($_GET['edit-course']))
					  {
						  global $connection;
							mysqli_select_db($connection,"cbtonline_db");
							$result=mysqli_query($connection,"SELECT *FROM courses LIMIT $start,$per_page");
							  if(!$result)
							  {
								echo mysqli_error($connection);
							  }
							  else
							  {
									
								 
							  }
							  global $connection;
						  mysqli_select_db($connection,"cbtonline_db");
						 $result_set=mysqli_query($connection,"SELECT *FROM sets"); 
							   
						 ?>
						<div class='row details-row'>
							<h4 class=' text-success'>Manage Courses</h4>
								<p class=' info-details ' style='font-family:Arial'>Edit and Manage Courses.</p>
							<form>
							<div class='form-group'>
								<div class='input-group'>
									<input type='text' placeholder='Search' id='search-edit-course' class='form-control'>
									<span class='input-group-btn'>
										<button type='button' class='btn btn-success'><span class='glyphicon glyphicon-search'></span></button>
									</span>
								</div>
							</div>
						
						</form>
						
						</div>
				<div class='row'>
					
					<div class='col-lg-9 board-form board-form-edit'>
					<div id='edit_course_modal' class='modal fade' tabindex='-1'>
						
						<div class='modal-dialog modal-lg'>
						 
						<div class='modal-content'>
						 <div class='modal-header'>
							<h3 class='modal-title'>Edit Board Content</h3>
						 </div>
						<div class='modal-body'>
						<form action='' id='edit_board' method='post'>
							<a  id='close_edit_form' class='close' data-dismiss='modal'>&times;</a>
							<div class='form-group'>
								<label for='board-name-field'>Title </label>
								<input id='board-name-field' name='course_title' type='text' placeholder='Name' class='form-control'>
							</div>
							<div class='form-group'>
								<label for='board-addcrs-field'> Description </label>
								<textarea id='board-description-field' name='course_description' cols='4' rows='5' class='form-control'></textarea>
							</div>
							 <div class='form-group'>
									
									<select id='course-select' class='form-control chosen-select' name='course_sets[]' data-placeholder='Select tags' multiple class='chosen-select'>
										<?php 
										 while($res=mysqli_fetch_array($result_set))
										 {
											echo "<option>".$res['questionset_title']."</option>";
										}?> 
									</select>
 							</div>
							
							<button type='submit' name='update_course' class='btn btn-success btn-block add-board'> Update</span></button>
							
						</form>
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
								 <a href='Course.php?add-course' class='list-group-item'  ><span class='glyphicon glyphicon-plus'></span> Add New Course</a>
								 <a class='list-group-item' data-target='#view-board-modal'><span class='glyphicon glyphicon-edit'></span> Edit Course</a>
								 
							</ul>
							<div class='panel-footer'>
								
							</div>
						</div>
					 </div>
						
							<div class='col-lg-9 col-xs-12 edit-table pull-left'>
								<div class='table-responsive'>
								<table class='table table-striped table-hover table-condensed ' id='edit-course-table'>
									<thead>
										<tr>
											<th>Id</th>
											<td>Published</th>
											<td></th>
											<th>Title</th>
											<th>Description</th>
											<th>Set</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									<?php while($res=mysqli_fetch_array($result))
											{
												$bd_des=$res['course_description'];
												$bd_des=str_replace(' ' ,'_',$bd_des);
												$dang='dang'.$res['course_title'];
												?>
										<tr >
											
											<td><?php echo $res['id']; ?></td>
											<td><?php if($res['publish']=='Y'){
												echo "<span class='glyphicon glyphicon-ok text-success $dang'></span>" ;}else{
													echo "<span class='glyphicon glyphicon-remove text-danger $dang'></span>";}?></td>
											 
											<td><input id="<?php echo $res['id'];?>" class='checkbox-edit' type='checkbox' ></td>
											<td><?php echo $res['course_title']; ?></td>
											<td><?php echo $res['course_description']; ?></td>
											<td><?php echo $res['course_sets']; ?></td>
											<td>  
											<div class='btn-group btn-group-xs '>
													<button id='edit-board'
														board_id="<?php if(isset($res['id'])){echo $res['id'];} ?>"
														 
														board_title="<?php if(isset($res['course_title'])){echo $res['course_title'];} ?>"
														board_description="<?php if(isset($res['course_description'])){echo $bd_des;} ?> "
														board_sets="<?php if(isset($res['course_sets'])){echo $res['course_sets'];} ?>"
														type='button' class='btn btn-primary edit-board' data-target='#edit_course_modal'
															data-toggle='modal' >Edit
													</button>
													
													<button type='button' 
														course_title="<?php if(isset($res['course_title'])){echo $res['course_title'];} ?>"
														class='btn btn-warning delete_board'>Delete
													</button>
													
													<button type='button' id='<?php echo $res['course_title']; ?>' board_name="<?php echo $res['course_title']; ?>"
													board_publish=<?php echo $res['publish']; ?>
													class="btn publish_btn
														<?php if($res['publish']=='Y'){echo 'btn-danger';}else{ echo 'btn-success';}?>"> 
													<?php if($res['publish']=='Y'){echo 'Unpublish';}else{ echo 'Publish';}?>
													</button>
													
											</div>
											</td>
										</tr>
											<?php } ?>
										
									</tbody>
								</table>
								<ul class='pagination'>
								<?php
									for($c=1;$c<=$page;$c++)
									{
										$fin=$c*$per_page;
										echo "<li><a href='Course.php?edit-course&fin=$fin'>$c</a></li>";
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
		</div>
		</div><!--1st row-->
	</div><!--container-->
		
</body>
</html>