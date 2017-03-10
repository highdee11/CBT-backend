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
	 $result=mysqli_query($connection,"SELECT *FROM sets");
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
	if(isset($_POST['submit_questionset']))
		{
			mysqli_select_db($connection,"cbtonline_db");
			$questionset_title=$_POST['questionset_title'];
			$questionset_description=$_POST['questionset_description'];
			
			$result=mysqli_query($connection,"SELECT *FROM sets WHERE questionset_title='{$questionset_title}'");
			$res=mysqli_fetch_array($result);
			$check=mysqli_num_rows($result);
			$publish='N';
			$setname="set_".$questionset_title;
		/*	"CREATE TABLE  $subject_name ( id int(11) NOT NULL auto_increment,
											question_set varchar(100) NOT NULL,
											no_of_question int(7) NOT NULL,
											visible int(1) NOT NULL,
											hours int(2) NOT NULL,
											mins int(2) NOT NULL,
											secs int(2) NOT NULL,
											PRIMARY KEY (id)
											)  ";*/
	 
			if($check<=0)
			{
				$query1="CREATE TABLE  $setname (
					id int(11) NOT NULL auto_increment,
					question_content varchar(10000) NOT NULL,
					option1 varchar(2000) NOT NULL,
					option2 varchar(2000) NOT NULL,
					option3 varchar(2000) NOT NULL,
					option4 varchar(2000) NOT NULL,
					option5 varchar(2000) NOT NULL,
					course varchar(100) NOT NULL,
					board varchar(100) NOT NULL,
					answer int(2) NOT NULL,
					question_img varchar(100),
					publish char(2) NOT NULL,
					PRIMARY KEY (id)
				)";
				$query="INSERT INTO sets (questionset_title,questionset_description,publish) 
			 VALUES ('{$questionset_title}','{$questionset_description}','{$publish}')";
			 $result=mysqli_query($connection,$query);
			 $result1=mysqli_query($connection,$query1);
			 if($result && $result1)
			 {
				$feedback="set created successfully";
				 
			 }
			 else
			 {
				$feedback='set not Created'.mysqli_error($connection);
			 }
			}
			else
			{
				$feedback_error="Set Name already Exit";
			}
			
			 
		}

?>


<?php

	if(isset($_POST['delete_set']))
		{
			global $connection;
			mysqli_select_db($connection,"cbtonline_db");
			$board_title=$_POST['delete_set'];
			$setname='set_'.$board_title;
			$query="DELETE FROM sets WHERE questionset_title='{$board_title}'";
			mysqli_query($connection,"DROP TABLE $setname");
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

	if(isset($_POST['delete_set_id']))
		{
			global $connection;
			mysqli_select_db($connection,"cbtonline_db");
			$board_title=$_POST['delete_set_id'];
			$setname='set_'.$_POST['del_set'];
			$query="DELETE FROM sets WHERE id='{$board_title}'";
			mysqli_query($connection,"DROP TABLE $setname");
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

if(isset($_POST['update_set']))
	{
		$target=$_GET['target'];
		$title=$_POST['set_name'];
		$desc=$_POST['set_description'];
		mysqli_select_db($connection,'cbtonline_db');
		
		$result_title=mysqli_query($connection,"SELECT *FROM sets WHERE questionset_title='{$title}' LIMIT 1");
			$res_title=mysqli_fetch_array($result_title);
			$res_num=mysqli_num_rows($result_title);
			 $check=mysqli_num_rows($result_title);
			 
			 if($check>0)
			 {
				 if($res_title['id']==$target)
				 {
								 
					$result=mysqli_query($connection,"UPDATE sets SET questionset_title='{$title}' , questionset_description='{$desc}'
					WHERE id={$target}");
					if($result)
						 {
							$feedback="set Updated";
							 
						 }
						 else
						 {
							$feedback='Set not created'.mysqli_error($connection);
						 }
			
				 }
				 else
				 {
					 $feedback_error='set name already exit';
				 }
			 }
			else{
				$result=mysqli_query($connection,"UPDATE sets SET questionset_title='{$title}' , questionset_description='{$desc}'
					WHERE id={$target}");
					if($result)
						 {
							$feedback="set Updated";
							 
						 }
						 else
						 {
							$feedback='Set not created'.mysqli_error($connection);
						 }
			}
		
		
			 
	}


?>
<?php 

	if(isset($_POST['publish']))
	{
		 
		$title=$_POST['publish'];
		$query="SELECT *FROM sets WHERE questionset_title='{$title}'";
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
				$result=mysqli_query($connection,"UPDATE sets SET publish='{$no}' WHERE questionset_title='{$title}'");
				echo "success N";
			}
		else
			{
				$result=mysqli_query($connection,"UPDATE sets SET publish='{$yes}' WHERE questionset_title='{$title}'");
				echo "success Y";
			}
	}
	



?>

<?php 

	if(isset($_POST['unpublishid']))
	{
		 
		$title=$_POST['unpublishid'];
		$query="SELECT *FROM sets WHERE id='{$title}'";
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
					$result=mysqli_query($connection,"UPDATE sets SET publish='{$no}' WHERE id='{$title}'");
				}
				
	}
?>

<?php 

	if(isset($_POST['publishid']))
	{
		 
		$title=$_POST['publishid'];
		$query="SELECT *FROM sets WHERE id='{$title}'";
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
					$result=mysqli_query($connection,"UPDATE sets SET publish='{$yes}' WHERE id='{$title}'");
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
	<link href="admincss/Questionset.css" rel="stylesheet"> 
	<script src='adminjs/jquery-3.1.0.min.js'></script>
	<script src='../jquery-ui.js'></script>
	<script src='../js/bootstrap.min.js'></script>
	<script src='adminjs/Chart.min.js'></script>
	<script src='adminjs/Questionset.js'></script>
	 
	 <link  rel="stylesheet" href="chosen_v1.4.0/chosen.min.css"> 	
	  <script src='chosen_v1.4.0/chosen.jquery.min.js'></script>
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
						<li  >
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
						
						
						<li>
							<a href='#course-drp' data-toggle='collapse'>
								<span class='glyphicon glyphicon-book'></span> Course 
								<span class='caret pull-right'></span>
							</a>
							<div id='menu-drp'>
								<ul class='collapse collapseable' id='course-drp'>
									<li><a href='Course.php?add-course'><span class='glyphicon glyphicon-plus'></span> Add New</a></li>
 									<li><a href='Course.php?edit-course'><span class='glyphicon glyphicon-edit'></span> Edit Course<span class='hidden-xs label label-success pull-right'><?php echo $course_num; ?></span></a></li>
								</ul>
							</div>
						</li>
						<li class='active'>
							<a href='#set-drp' data-toggle='collapse'>
								<span class='glyphicon glyphicon-list-alt'></span> Question Set 
								<span class='caret pull-right'></span>
							</a>
							<div id='menu-drp'>
								<ul class='collapse collapseable in' id='set-drp'>
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
				<?php if(isset($_GET['add-questionset']))
				{?>
				<div id='add-board'>
				<div class='row details-row'>
					<h4 class=' text-danger'>Create New QuestionSet</h4>
						
				</div>
				<div class='row'>
					 <div class='col-lg-9 board-form'>
						<form method='POST'>
							<div class='form-group' id='board-name-group'>
								<label for='board-name-field'>Title </label>
								<input id='board-name-field' name='questionset_title' type='text' placeholder='Name' class='form-control'>
								<span class='glyphicon glyphicon-warning-sign fdbk1  form-control-feedback hidden'></span>
								<span class='help-block fdbk1  hidden'>Invalid Description</span>
							</div>
							<div class='form-group' id='board-description-group'>
								<label for='board-addcrs-field'> Description </label>
								<span class='help-block fdbk2'><p class='text-danger'>(optional)</p></span>
								<textarea id='board-description-field' name='questionset_description' cols='4' rows='5' class='form-control'></textarea>
								<span class='glyphicon glyphicon-warning-sign fdbk2  form-control-feedback hidden'></span>
								<span class='help-block fdbk2  hidden'>Invalid Description</span>
							</div>
							 
 							 
							
							<button type='submit' name='submit_questionset' id='questionset-submit-btn' class='btn btn-success btn-block add-board'><span class='glyphicon glyphicon-plus'> Add</span></button>
							
						</form>
					 </div>
					 <div class='col-lg-3 board-qk-tl'>
						<div class='panel panel-primary	'>
							<div class='panel-heading'>
								<h4 class='panel-title'>Quick Tools</h4>
							</div>
							<ul class='list-group'>
								  
								 <a href='Questionset.php?edit-questionset' class='list-group-item'  ><span class='glyphicon glyphicon-edit'></span> Edit QuestionSet</a>
								 
							</ul>
							<div class='panel-footer'>
								
							</div>
						</div>
					 </div>
				</div>
				</div>
				<?php } ?>
					 
					 <!-- edit board-->
				<?php if(isset($_GET['edit-questionset']))
					  {
						  global $connection;
						  mysqli_select_db($connection,"cbtonline_db");
						 $result=mysqli_query($connection,"SELECT *FROM sets LIMIT $start,$per_page"); 
						 ?>
						  <div class='row details-row'>
							<h4 class=' text-success'>Manage QuestionSet</h4>
								<p class=' info-details ' style='font-family:Arial'>Edit and Manage QuestionSet.</p>
						<form>
							<div class='form-group'>
								<div class='input-group'>
									<input type='text' placeholder='Search' id='search-edit-set' class='form-control'>
									<span class='input-group-btn'>
										<button type='button' class='btn btn-success'><span class='glyphicon glyphicon-search'></span></button>
									</span>
								</div>
							</div>
						
						</form>
						</div>
				<div class='row'>
					
					<div class='col-lg-9 board-form questionset-form-edit'>
						<div id='edit_set_modal' class='modal fade' tabindex='-1'>
						
						<div class='modal-dialog modal-lg'>
						 
						<div class='modal-content'>
						 <div class='modal-header'>
							<h3 class='modal-title'>Edit Board Content</h3>
						 </div>
						<div class='modal-body'>
						<form action=''  id='edit_set' method='post'>
							<div class='form-group' id='board-name-group'>
								<label for='board-name-field'>Title </label>
								<input id='board-name-field' type='text' placeholder='Name' name='set_name' class='form-control'>
								<span class='glyphicon glyphicon-warning-sign fdbk1  form-control-feedback hidden'></span>
								<span class='help-block fdbk1  hidden'>Invalid Description</span>
							</div>
							<div class='form-group' id='board-description-group'>
								<label for='board-addcrs-field'> Description </label>
								<span class='help-block fdbk2'><p class='text-danger'>(optional)</p></span>
								<textarea id='board-description-field' cols='4' rows='5' name='set_description' class='form-control'></textarea>
								<span class='glyphicon glyphicon-warning-sign fdbk2  form-control-feedback hidden'></span>
								<span class='help-block fdbk2  hidden'>Invalid Description</span>
							</div>
							  
							
							<button type='submit' id='questionset-submit-btn' name='update_set' class='btn btn-success btn-block '>
								Update</span></button>							
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
								 <a href='Questionset.php?add-questionset' class='list-group-item'  ><span class='glyphicon glyphicon-plus'></span> Add New QuestionSet</a>
 								 
							</ul>
							<div class='panel-footer'>
								
							</div>
						</div>
					 </div>
						
							<div class='col-lg-9 col-xs-12 edit-table pull-left'>
								<div class='table-responsive'>
								<table class='table table-striped table-hover table-condensed ' id='edit-set-table'>
									<thead>
										<tr>
											<th>Id</th>
											<td>Published</th>
											<td></th>
											<th>Title</th>
											<th>Description</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									<?php while($boards=mysqli_fetch_array($result))
									{
										$bd_des=$boards['questionset_description'];
										$bd_des=str_replace(' ' ,'_',$bd_des);
										$dang='dang'.$boards['questionset_title'];
										 
										
										
										?><tr >
											<td><?php echo $boards['id']?></td>
											<td ><?php if($boards['publish']=='Y'){
												echo "<span class='glyphicon glyphicon-ok text-success  $dang'></span>" ;}else{
													echo "<span class='glyphicon glyphicon-remove text-danger $dang'></span>";}?>
											</td>
											 
											<td> <input id=<?php echo $boards['id'];?> data-set='<?php echo $boards['questionset_title'];?>' class='checkbox-edit' type='checkbox' ></td>
											<td><?php echo $boards['questionset_title']?></td>
											<td><?php echo $boards['questionset_description']?></td>
										 
											<td>  <div class='btn-group btn-group-xs '>
													<button id='edit-board'
														board_id="<?php if(isset($boards['id'])){echo $boards['id'];} ?>"
														 
														board_title="<?php if(isset($boards['questionset_title'])){echo $boards['questionset_title'];} ?>"
														board_description="<?php if(isset($boards['questionset_description'])){echo $bd_des;} ?> "
 														type='button' class='btn btn-primary edit-board' data-target='#edit_set_modal'
														data-toggle='modal'>Edit
													</button>
													
													<button type='button' 
														board_title="<?php if(isset($boards['questionset_title'])){echo $boards['questionset_title'];} ?>"
														class='btn btn-warning delete_set'>Delete
													</button>
													
													<button type='button' id='<?php echo $boards['questionset_title']; ?>' board_name="<?php echo $boards['questionset_title']; ?>"
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
										echo "<li><a href='Questionset.php?edit-questionset&fin=$fin'>$c</a></li>";
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