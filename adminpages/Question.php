<?php 
   include_once("function.php");
	connect();
	 include_once("Boardphp.php");
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
	 if(isset($_POST['update_question']))
		{
		mysqli_select_db($connection,"cbtonline_db");
		$quest_cont=$_POST['quest_cont'];
			$quest_opt1=$_POST['quest_opt1'];
			$quest_opt2=$_POST['quest_opt2'];
			$quest_opt3=$_POST['quest_opt3'];
			$quest_opt4=$_POST['quest_opt4'];
			$quest_course=$_POST['quest_course'];
			$quest_board=$_POST['quest_board'];
			$quest_answ=$_POST['quest_answ'];
			$quest_set=$_POST['quest_set'];
			$quest_set='set_'.$quest_set;
			$id=$_GET['id'];
			$fmr_quest_set=$_GET['fmrset'];
			$query='';
		$chkresult=mysqli_query($connection,"SELECT *FROM $quest_set WHERE id='{$id}'");
				$chkres=mysqli_num_rows($chkresult);
if($chkres>0)
	{
			 
			//echo "was found".$quest_set;
				if(isset($_FILES['quest_img']) && isset($_POST['quest_opt5']))
				{
						if($_FILES['quest_img']['name']!='')
						{
							$imgname=$_FILES['quest_img']['name'];
							$move=move_uploaded_file($_FILES['quest_img']['tmp_name'],'quest-img/'.$_FILES['quest_img']['name']);
						}
					else
						{
							$imgname=$_GET['ig'];
						}
					$quest_opt5=$_POST['quest_opt5'];
						$query="UPDATE $quest_set SET question_content='{$quest_cont}',option1='{$quest_opt1}',option2='{$quest_opt2}'
					,option3='{$quest_opt3}',option4='{$quest_opt4}',option5='{$quest_opt5}',course='{$quest_course}',board='{$quest_board}',answer='{$quest_answ}'
					,question_img='{$imgname}'
					WHERE id='{$id}'";
				}
				else if(isset($_FILES['quest_img']))
				{
					if($_FILES['quest_img']['name']!='')
						{
							$imgname=$_FILES['quest_img']['name'];
							$move=move_uploaded_file($_FILES['quest_img']['tmp_name'],'quest-img/'.$_FILES['quest_img']['name']);
						}
					else
						{
							$imgname=$_GET['ig'];
						}
					
						$query="UPDATE $quest_set SET question_content='{$quest_cont}',option1='{$quest_opt1}',option2='{$quest_opt2}'
					,option3='{$quest_opt3}',option4='{$quest_opt4}',course='{$quest_course}',board='{$quest_board}',answer='{$quest_answ}'
					,question_img='{$imgname}'
					WHERE id='{$id}'";
				}
			else if(isset($_POST['quest_opt5']))
				{
					$quest_opt5=$_POST['quest_opt5'];
							$query="UPDATE $quest_set SET question_content='{$quest_cont}',option1='{$quest_opt1}',option2='{$quest_opt2}'
					,option3='{$quest_opt3}',option4='{$quest_opt4}',option5='{$quest_opt5}',course='{$quest_course}',board='{$quest_board}'
					,answer='{$quest_answ}',question_img='none'
					
					WHERE id='{$id}'";
				}
			else
				{
					$imgname=$_GET['ig'];
					$query="UPDATE $quest_set SET question_content='{$quest_cont}',option1='{$quest_opt1}',option2='{$quest_opt2}'
					,option3='{$quest_opt3}',option4='{$quest_opt4}',course='{$quest_course}',board='{$quest_board}',answer='{$quest_answ}'
					,question_img='{$imgname}'
					WHERE id='{$id}'";
				}
			$result=mysqli_query($connection,$query);
				if($result)
					{
						$feedback='Question updated successfully';
					}
				else
					{
						$feedback_error=mysqli_error($connection);
					}
				
				
			
		}
	
else
	{
		
			$publish='Y';
		if(isset($_FILES['quest_img']) && isset($_POST['quest_opt5']))
				{
					if($_FILES['quest_img']['name']!='')
						{
							$imgname=$_FILES['quest_img']['name'];
							$move=move_uploaded_file($_FILES['quest_img']['tmp_name'],'quest-img/'.$_FILES['quest_img']['name']);
						}
					else
						{
							$imgname=$_GET['ig'];
						}
					
					$quest_opt5=$_POST['quest_opt5'];
						$query="INSERT INTO $quest_set (question_content,option1,option2,option3,option4,option5,course,board,answer,question_img,publish)
						VALUES('{$quest_cont}','{$quest_opt1}','{$quest_opt2}','{$quest_opt3}','{$quest_opt4}','{$quest_opt5}'
						,'{$quest_course}','{$quest_board}','{$quest_answ}','{$imgname}','{$publish}')";
				}
			else if(isset($_FILES['quest_img']))
				{
						if($_FILES['quest_img']['name']!='')
						{
							$imgname=$_FILES['quest_img']['name'];
							$move=move_uploaded_file($_FILES['quest_img']['tmp_name'],'quest-img/'.$_FILES['quest_img']['name']);
						}
					else
						{
							$imgname=$_GET['ig'];
						}
						$query="INSERT INTO $quest_set (question_content,option1,option2,option3,option4,course,board,answer,question_img,publish)
						VALUES('{$quest_cont}','{$quest_opt1}','{$quest_opt2}','{$quest_opt3}','{$quest_opt4}'
						,'{$quest_course}','{$quest_board}','{$quest_answ}','{$imgname}','{$publish}')";
				}
			else if(isset($_POST['quest_opt5']))
				{
					$quest_opt5=$_POST['quest_opt5'];
						$query="INSERT INTO $quest_set (question_content,option1,option2,option3,option4,option5,course,board,answer,question_img,publish)
						VALUES('{$quest_cont}','{$quest_opt1}','{$quest_opt2}','{$quest_opt3}','{$quest_opt4}','{$quest_opt5}'
						,'{$quest_course}','{$quest_board}','{$quest_answ}','none','{$publish}')";
				}
			else
				{
					$imgname=$_GET['ig'];
					$query="INSERT INTO $quest_set (question_content,option1,option2,option3,option4,course,board,answer,question_img,publish)
						VALUES('{$quest_cont}','{$quest_opt1}','{$quest_opt2}','{$quest_opt3}','{$quest_opt4}'
						,'{$quest_course}','{$quest_board}','{$quest_answ}','none','{$publish}')";
				}
				$result=mysqli_query($connection,$query);
				if($result)
					{
						
						
						$feedback='Question updated successfully';
						$result=mysqli_query($connection,"DELETE FROM $fmr_quest_set WHERE id='{$id}' ");
					
					}
				else
					{
						$feedback_error=mysqli_error($connection);
					}
		
	}
		}	

	?>

<?php 
	if(isset($_POST['delete_question']))
		{
			$id=$_POST['delete_question'];
			$set=$_POST['quest_set'];
			 
			mysqli_select_db($connection,"cbtonline_db");
			$result=mysqli_query($connection,"DELETE FROM $set WHERE id='{$id}' ");
			if($result)
					{
						$feedback='Question Deleted';
					}
				else
					{
						$feedback_error=mysqli_error($connection);
					}
		
		}
?>	
<?php 
	if(isset($_POST['delete_question_id']))
		{
			$id=$_POST['delete_question_id'];
			 $set=$_POST['questset'];
			  
			mysqli_select_db($connection,"cbtonline_db");
			$result=mysqli_query($connection,"DELETE FROM $set WHERE id='{$id}' ");
			if($result)
					{
						$feedback='Question Deleted';
					}
				else
					{
						$feedback_error=mysqli_error($connection);
					}
		
		}
?>	

<?php 
	
if(isset($_POST['publish']))
	{
		$set=$_POST['pub_set'];
		$id=$_POST['publish'];
		$query="SELECT *FROM $set WHERE id='{$id}'";
		
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
					 
				}
				
		if($res['publish']=='Y')
			{
				$result=mysqli_query($connection,"UPDATE $set SET publish='{$no}' WHERE id='{$id}'");
				
			}
		else
			{
				$result=mysqli_query($connection,"UPDATE $set SET publish='{$yes}' WHERE id='{$id}'");
				
			}
			
	}
	
?>

<?php 
	
if(isset($_POST['unpublishid']))
	{
		$set=$_POST['unpub_set'];
		$id=$_POST['unpublishid'];
		$query="SELECT *FROM $set WHERE id='{$id}'";
		
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
					 	$result=mysqli_query($connection,"UPDATE $set SET publish='{$yes}' WHERE id='{$id}'");
				}
	
	}
	
?>


<?php 
	
if(isset($_POST['publishid']))
	{
		$set=$_POST['ppub_set'];
		$id=$_POST['publishid'];
		$query="SELECT *FROM $set WHERE id='{$id}'";
		
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
					 	$result=mysqli_query($connection,"UPDATE $set SET publish='{$no}' WHERE id='{$id}'");
				}
	
	}
	
?>





<?php 
	if(isset($_POST['submit_question']))
		{
			mysqli_select_db($connection,"cbtonline_db");
			$quest_cont=$_POST['quest_cont'];
			$quest_opt1=$_POST['quest_opt1'];
			$quest_opt2=$_POST['quest_opt2'];
			$quest_opt3=$_POST['quest_opt3'];
			$quest_opt4=$_POST['quest_opt4'];
			$quest_course=$_POST['quest_course'];
			$quest_board=$_POST['quest_board'];
			$quest_answ=$_POST['quest_answ'];
			$quest_set=$_POST['quest_set'];
			$quest_set='set_'.$quest_set;
			$publish='Y';
			$query='';
			if(isset($_FILES['quest_img']) && isset($_POST['quest_opt5']))
				{
					if($_FILES['quest_img']['name']!='')
					{
					$imgname=$_FILES['quest_img']['name'];
					}
					else
					{
						$imgname='none';
					}
					$move=move_uploaded_file($_FILES['quest_img']['tmp_name'],'quest-img/'.$_FILES['quest_img']['name']);
					$quest_opt5=$_POST['quest_opt5'];
						$query="INSERT INTO $quest_set (question_content,option1,option2,option3,option4,option5,course,board,answer,question_img,publish)
						VALUES('{$quest_cont}','{$quest_opt1}','{$quest_opt2}','{$quest_opt3}','{$quest_opt4}','{$quest_opt5}'
						,'{$quest_course}','{$quest_board}','{$quest_answ}','{$imgname}','{$publish}')";
				}
			else if(isset($_FILES['quest_img']))
				{	
					if($_FILES['quest_img']['name']!='')
					{
					$imgname=$_FILES['quest_img']['name'];
					}
					else
					{
						$imgname='none';
					}
					$move=move_uploaded_file($_FILES['quest_img']['tmp_name'],'quest-img/'.$_FILES['quest_img']['name']);
					
						$query="INSERT INTO $quest_set (question_content,option1,option2,option3,option4,course,board,answer,question_img,publish)
						VALUES('{$quest_cont}','{$quest_opt1}','{$quest_opt2}','{$quest_opt3}','{$quest_opt4}'
						,'{$quest_course}','{$quest_board}','{$quest_answ}','{$imgname}','{$publish}')";
				}
			else if(isset($_POST['quest_opt5']))
				{
					$quest_opt5=$_POST['quest_opt5'];
						$query="INSERT INTO $quest_set (question_content,option1,option2,option3,option4,option5,course,board,answer,question_img,publish)
						VALUES('{$quest_cont}','{$quest_opt1}','{$quest_opt2}','{$quest_opt3}','{$quest_opt4}','{$quest_opt5}'
						,'{$quest_course}','{$quest_board}','{$quest_answ}','none','{$publish}')";
				}
			else
				{
					$query="INSERT INTO $quest_set (question_content,option1,option2,option3,option4,course,board,answer,question_img,publish)
						VALUES('{$quest_cont}','{$quest_opt1}','{$quest_opt2}','{$quest_opt3}','{$quest_opt4}'
						,'{$quest_course}','{$quest_board}','{$quest_answ}','none','{$publish}')";
				}
				$result=mysqli_query($connection,$query);
				if($result)
					{
						$feedback='Question added successfully';
					}
				else
					{
						$feedback_error=mysqli_error($connection);
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
	<link href="admincss/Question.css" rel="stylesheet"> 
	<script src='adminjs/jquery-3.1.0.min.js'></script>
	<script src='../jquery-ui.js'></script>
	<script src='../js/bootstrap.min.js'></script>
	<script src='adminjs/Chart.min.js'></script>
	  <link  rel="stylesheet" href="chosen_v1.4.0/chosen.min.css"> 
	 <script src='chosen_v1.4.0/chosen.jquery.min.js'></script>
	 <script src='adminjs/Question.js'></script>
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
						<li>
							<a href='#board-drp'   class='collapse' data-toggle='collapse'>
								<span class='glyphicon glyphicon-folder-close'></span> Board 
								<span class='caret pull-right'></span>
							</a>
							<div id='menu-drp'>
								<ul class='collapse'   id='board-drp'>
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
						<li  class='active'>
							<a href='#question-drp' data-toggle='collapse'>
								<span class='glyphicon glyphicon-question-sign'></span> Question  
								<span class='caret pull-right'></span>
							</a>
							<div id='menu-drp'>
								<ul class='collapse collapseable in' id='question-drp'>
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
		<?php if(isset($_GET['add-question']))
		{ 
		
			$result=request_boards();
			
			?>
			<div class='row'>
					<h3 class='text-success'>Create Question</h3>				
					<p class='text-warning'>Create and Add New questions to their respective set</p>
				</div>
				<div class='row'>
				
					 <div class='col-lg-12 question-col'>
						<form  method='post' enctype='multipart/form-data'>
						<div class='row'>
								<div class='form-group col-lg-3 col-xs-12' id='question-board-group'>
									<label for='courses'>Select Board</label>
									<select class='form-control' id='question-select-board' name='quest_board' placeholder='Select course'>
										 <option></option>
										 <?php 
										 while($res=mysqli_fetch_array($result))
										 {
											echo "<option>".$res['board_title']."</option>";
										 }?>
									
									</select>
									<span class='glyphicon glyphicon-warning-sign fdbks2  form-control-feedback hidden'></span>
									<span class='help-block fdbks2  hidden'>Invalid Course selected</span>
								</div>
									<div class='form-group col-lg-3 col-xs-6' id='question-course-group'>
										<label for='question-set'>Add question to a course</label>
										<select id='question-select-course' name='quest_course'  class='form-control' disabled  placeholder='select set' >
											</select>
										<span class='glyphicon glyphicon-warning-sign fdbks1  form-control-feedback hidden'></span>
										<span class='help-block fdbks1  hidden'>Invalid Set selected</span>
										
									</div>
									<div class='form-group col-lg-3 col-xs-6' id='question-set-group'>
										<label for='question-set'>Add question to a Set</label>
										<select id='question-select-sets' name='quest_set'  class='form-control' disabled  placeholder='select set'>	 
										</select>
										<span class='glyphicon glyphicon-warning-sign fdbks3  form-control-feedback hidden'></span>
										<span class='help-block fdbks3  hidden'>Invalid Set selected</span>
										
									</div>
									
									<div class='col-lg-3 col-xs-6'>
										<label for='question_img'>Upload question image</label>
										<input type='file' name='quest_img' class='form-control ' />
										<span class='help-block'>(Optional)</span>
									</div>
									</div>
							
							
							<div class='form-group' id='question-content-group'>
								<label for='question-content'></label>
								<textarea id='question-content' cols='4' rows='5' name='quest_cont' class='form-control' placeholder='Question Content'></textarea>
								<span class='glyphicon glyphicon-warning-sign fdbk0  form-control-feedback hidden'></span>
								<span class='help-block fdbk0 hidden'>Invalid content </span>
							</div>
							<div class='row'>
							<div class='form-group col-lg-6 col-xs-12' id='option-group1'>
								<label for='option1'>Option A</label>
								<input id='option1' name='quest_opt1' type='text' class='form-control' > 
								<span class='glyphicon glyphicon-warning-sign fdbk1 form-control-feedback hidden'></span>
								<span class='help-block fdbk1 hidden'>Invalid option</span>
							</div>
							<div class='form-group col-lg-6 col-xs-12' id='option-group2'>
								
								<label for='option2'>Option B</label>
								<input id='option2' name='quest_opt2' type='text' class='form-control' > 
								<span class='glyphicon glyphicon-warning-sign fdbk2  form-control-feedback hidden'></span>
								<span class='help-block fdbk2 hidden'>Invalid option</span>
								
							</div>
							</div>
							<div class='row'>
							<div class='form-group col-lg-6 col-xs-12' id='option-group3'>
								<label for='option3'>Option C</label>
								<input id='option3' type='text' name='quest_opt3' class='form-control' >
								<span class='glyphicon glyphicon-warning-sign fdbk3  form-control-feedback hidden'></span>
								<span class='help-block fdbk3 hidden'>Invalid option</span>
							</div>
							<div class='form-group col-lg-6 col-xs-12' id='option-group4'>							
								
								<label for='option4'>Option D</label>
								<input id='option4' type='text' name='quest_opt4' class='form-control' > 
								<span class='glyphicon glyphicon-warning-sign fdbk4  form-control-feedback hidden'></span>
								<span class='help-block fdbk4 hidden'>Invalid option</span>
								</div>
							<a href='#' class='option_add'><span class='glyphicon glyphicon-plus'></span> Add one option field</a>
							</div>
							
							<div class='form-group hidden'  id='option-group5'>
								<label for='option5'>Option E</label>
								<input id='option5' type='text' name='quest_opt5' class='form-control' > 
								<span class='glyphicon glyphicon-warning-sign fdbk5  form-control-feedback hidden'></span>
								<span class='help-block fdbk5 hidden'>Invalid option</span>
							</div>
							<div class='radio col-lg-6 col-xs-12' id='answer'>							
								
								<label for='answ1'><input id='answ1' type='radio' name='quest_answ' value='1' class=' ' > OptionA </label>
								<label for='answ2'><input id='answ2' type='radio' name='quest_answ' value='2' class=' ' > OptionB </label>
								<label for='answ3'><input id='answ3' type='radio' name='quest_answ' value='3' class=' ' > OptionC </label>
								<label for='answ4'><input id='answ4' type='radio' name='quest_answ' value='4' class=' ' > OptionD </label>
								 
								
								<span class='help-block fdbksa hidden'>Answer not set</span>
							</div>
							<button id='question-submit-btn' type='submit' name='submit_question' class='btn btn-block btn-success'><span class='glyphicon glyphicon-plus'></span> Add</button>
							
						</form>
					 
					 </div>
				</div>
		<?php } ?>

				<?php if(isset($_GET['edit-question']))
				{
					mysqli_select_db($connection,"cbtonline_db");
					$result_courses=mysqli_query($connection,"SELECT *FROM sets");
					
					//$result=mysqli_query($connection,"SELECT *FROM ");
					
					?>
			<div class='row'>
					<h3 class='text-success'>Manage Questions</h3>	
						
					<form>
					<div class='row'>
						<div class='form-group col-lg-2'>
							<select class='form-control' id='search_question_select'>
								<?php while($res_courses=mysqli_fetch_array($result_courses))
								{
									echo "<option>".$res_courses['questionset_title']."</option>";
									
								}?>
							</select>
						</div>
						<div class='form-group col-lg-10'>
							<div class='input-group'>
							<input type='text' class='form-control' id='search_question_field' placeholder='Search Questions'>
							<span class='input-group-btn'>
								<button class='btn btn-primary' type='button'><span class='glyphicon glyphicon-search'></span></button>
							</span>
							</div>
						</div>
					</div>	
					</form>
						
			</div>
					<div class='row'>
					  <div class='modal' tabindex='-1'  id='edit-question-modal' >
					  <div class='modal-dialog modal-lg'> 
					  <div class='modal-content'> 
					  <div class='modal-header'>
					  <a href='' data-dismiss='modal' class='close'>&times;</a>	
						<h3 class='modal-title'>Edit Question</h3>
					  </div>
					  <div class='modal-body'>
					  <form action='question.php?edit-question' method='post' id='edit_question_form' enctype='multipart/form-data'>
					  <div class='row'>
							 
								<div class='form-group col-lg-3 col-xs-6' id='question-board-group'>
									<label for='question-set'>Add question to a Board</label>
									<select class='form-control' id='question-select-boardedt' name='quest_board'  >
										<?php 
										$result=request_boards();
										while($res=mysqli_fetch_array($result))
											{	
												echo "<option>" . $res['board_title']."</option>";
											}
											?>
									</select>
								</div>
							
							
							<div class='form-group col-lg-3 col-xs-6' id='question-course-group'>
										<label for='question-set'>Add question to a course</label>
										<select id='question-select-courseedt' name='quest_course'  class='form-control' disabled  placeholder='select set' >
										
										</select>
										<span class='glyphicon glyphicon-warning-sign fdbks1  form-control-feedback hidden'></span>
										<span class='help-block fdbks1  hidden'>Invalid Set selected</span>
										
							</div>
							
							<div class='form-group col-lg-3 col-xs-6' id='question-set-group'>
										<label for='question-set'>Add question to a Set</label>
										<select id='question-select-setsedt' name='quest_set'  class='form-control' disabled  placeholder='select set'>	 
										</select>
										<span class='glyphicon glyphicon-warning-sign fdbks3  form-control-feedback hidden'></span>
										<span class='help-block fdbks3  hidden'>Invalid Set selected</span>
							</div>
								<div class='col-lg-3 col-xs-6'>
										<label for='question_img'>Upload question image</label>
										<input type='file' name='quest_img' class='form-control ' />
										<span class='help-block'>(Optional)</span>
							</div>
						</div>
							<div class='row'>
								<div class='form-group col-lg-9' id='question-content-group'>
									<label for='question-content'></label>
									<textarea cols='4' rows='5' id='question-content' name='quest_cont' class='form-control' placeholder='Question Content'></textarea>
								</div>
								<div class='col-lg-3'>
									<img id='question_img' src='' class='img img-responsive img-rounded' data-toggle='modal' data-target='#question_img_modal' />
									
								</div>
								
							</div>
						<!--	<div class='modal' tabindex='-2'  id='question_img_modal' >
								  <div class='modal-dialog modal-md'> 
								  <div class='modal-content'> 
								  <div class='modal-header'>
								  <a href='#question_img_mod' data-dismiss='modal' class='close'>&times;</a>	
									<h3 class='modal-title'>Question image</h3>
								  </div>
								  <div class='modal-body'>
									<img id='question_img_mod' src=''  width='500px' height='340px' class='img img-responsive img-rounded' />
								  </div>
								  </div>
								  </div>
								</div>-->
							<div class='form-group col-lg-6' id='option-group1'>
							
								<label for='option1'>Option A</label>
								<input id='option1' type='text' name='quest_opt1'  class='form-control' > 
							</div>
							
							<div class='form-group col-lg-6' id='option-group2'>
							
								<label  for='option2'>Option B</label>
								<input type='text'  id='option2' name='quest_opt2' class='form-control' > 
							</div>
							
							<div class='form-group col-lg-6' id='option-group3'>
							
								<label for='option3'>Option C</label>
								<input type='text' id='option3' name='quest_opt3' class='form-control' >
							</div>
							
							<div class='form-group col-lg-6' id='option-group4'>
							
								<label for='option4'>Option D</label>
								<input type='text' id='option4' name='quest_opt4' class='form-control' > 
							</div>
							<div class='row'>
								<div class='form-group col-lg-6' id='option-group5'>
									<label for='option5'>Option E</label>
									<input type='text' id='option5'  name='quest_opt5' class='form-control' > 
								</div>
									
								<div class='radio' id='answer'>							
									
									<label for='answ1'><input id='answ1' type='radio' name='quest_answ' value='1' class=' ' > OptionA </label>
									<label for='answ2'><input id='answ2' type='radio' name='quest_answ' value='2' class=' ' > OptionB </label>
									<label for='answ3'><input id='answ3' type='radio' name='quest_answ' value='3' class=' ' > OptionC </label>
									<label for='answ4'><input id='answ4' type='radio' name='quest_answ' value='4' class=' ' > OptionD </label>
									 
									
									<span class='help-block fdbksa hidden'>Answer not set</span>
								</div>
							</div>
							<button class='btn btn-success btnupdate' type='submit' name='update_question' id=' ' >Update</button>
						</form>
						
					  </div>
					  <div class='modal-footer'>
									
												<button class='btn btn-warning' data-dismiss='modal' >Close</button>
											</div>
					  
					  </div>
					  </div>
					  </div>
					  
					<div class='col-lg-12 col-xs-12 edit-table pull-left'>
								<div class='table-responsive'>
								<table id='edit_question_table' class='table table-striped table-hover table-condensed '>
									<thead>
										<tr>
											<th>Id</th>
											<td></th>
											<th>Question</th>
											<th>Set</th>
											<th>Option A</th>
											<th>Option B</th>
											<th>Option C</th>
											<th>Option D</th>
											<th>Option E</th>
											<th>Course</th>
											<th>Board</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										
										 
									</tbody>
								</table>
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
					
				<?php }?>
				
			
			</div>
		</div>
		</div><!--1st row-->
	</div><!--container-->
		
</body>
</html>