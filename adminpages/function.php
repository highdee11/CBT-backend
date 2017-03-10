<?php
require_once('Constant.php');
 
 function connect()
 {
	 global $connection;
	 $connection=mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
	 if(!$connection)
		{
			die($connection);
		}
 }
 
  function request_boards()
  {
	  global $connection;
	mysqli_select_db($connection,"cbtonline_db");
	$result=mysqli_query($connection,"SELECT *FROM boards");
	  if(!$result)
	  {
		 mysqli_error($connection);
	  }
		return $result;
  }
 function page_request_boards($start,$finish)
  {
	  global $connection;
	mysqli_select_db($connection,"cbtonline_db");
	$result=mysqli_query($connection,"SELECT *FROM boards LIMIT $start,$finish");
	  if(!$result)
	  {
		 mysqli_error($connection);
	  }
		return $result;
  }
  
  if(isset($_POST['board_title']))
   {
	   $title=$_POST['board_title'];
	  global $connection;
	//  $connection=mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
	connect();
		mysqli_select_db($connection,"cbtonline_db");
		$result=mysqli_query($connection,"SELECT *FROM boards WHERE board_title='{$title}'");
	 if(!$result)
		  {
			 echo mysqli_error($connection);
		  }
	else
		{
			$res=mysqli_fetch_array($result);
			echo $res['board_courses'];
		}
  }
  
  if(isset($_POST['course_title']))
   {
	   $title=$_POST['course_title'];
	  global $connection;
	//  $connection=mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
	connect();
		mysqli_select_db($connection,"cbtonline_db");
		$result=mysqli_query($connection,"SELECT *FROM courses WHERE course_title='{$title}'");
	 if(!$result)
		  {
			 echo mysqli_error($connection);
		  }
	else
		{
			$res=mysqli_fetch_array($result);
			echo $res['course_sets'];
		}
  }

  function request_courses()
  {
	  global $connection;
	mysqli_select_db($connection,"cbtonline_db");
	$result=mysqli_query($connection,"SELECT *FROM courses");
	  if(!$result)
	  {
		echo mysqli_error($connection);
	  }
	  else
	  {
		    
		return $result;
	  }
  }


  
  if(isset($_POST['qsetkey']))
	{
		global $connection;
		connect();
		$key=$_POST['qsetkey'];
		 
		mysqli_select_db($connection,"cbtonline_db");
		$result=mysqli_query($connection,"SELECT *FROM sets WHERE questionset_title like '%".$key."%'");
		while($boards=mysqli_fetch_array($result))
			{
				$bd_des=$boards['questionset_description'];
					$bd_des=str_replace(' ' ,'_',$bd_des);
				  $dang='dang'.$boards['questionset_title'];
				if($boards['publish']=='Y')
				{
						echo "<tr >
								<td>{$boards['id']}</td>
								<td ><span class='glyphicon glyphicon-ok text-success  $dang'></span></td>
								 
								<td> <input class='checkbox-edit' id={$boards['id']} type='checkbox' ></td>
								<td>{$boards['questionset_title']}</td>
								<td>{$boards['questionset_description']}</td>
								<td>  <div class='btn-group btn-group-xs '>
										<button id='edit-board'
											board_id={$boards['id']}											 
											board_title={$boards['questionset_title']}
											board_description='{$bd_des}'
 											type='button' class='btn btn-primary edit-board' data-target='#edit_set_modal'
											data-toggle='modal'>Edit
										</button>
										
										<button type='button' 
											board_title={$boards['questionset_title']}
											class='btn btn-warning delete_set'>Delete
										</button>
										
										<button type='button' id={$boards['questionset_title']}
										board_name={$boards['questionset_title']}
										board_publish={$boards['publish']}
										
										class='btn publish_btn btn-danger'> 
										Unpublish
										</button>
										
								</div></td>
							</tr>";
					}
				else
					{
						
						echo "<tr >
								<td >{$boards['id']}</td>
								<td ><span class='glyphicon glyphicon-remove text-danger  $dang'></span></td>
								 
								<td> <input class='checkbox-edit' id={$boards['id']} type='checkbox' ></td>
								<td>{$boards['questionset_title']}</td>
								<td>{$boards['questionset_description']}</td>
								<td>  <div class='btn-group btn-group-xs '>
										<button id='edit-board'
											board_id={$boards['id']}											 
											board_title={$boards['questionset_title']}
											board_description='{$bd_des}'
 											type='button' class='btn btn-primary edit-board' data-target='#edit_set_modal'
											data-toggle='modal'>Edit
										</button>
										
										<button type='button' 
											board_title={$boards['questionset_title']}
											class='btn btn-warning delete_set'>Delete
										</button>
										
										<button type='button' id={$boards['questionset_title']}
										board_name={$boards['questionset_title']}
										board_publish={$boards['publish']}
										
										class='btn publish_btn  btn-success'> 
										Publish
										</button>
										
								</div></td>
							</tr>";
					}
			}
	
	}
   
if(isset($_POST['set_key']))
	{
		global $connection;
		connect();
		$key=$_POST['key'];
		$set1=$_POST['set_key'];
		$set='set_'.$_POST['set_key'];
		//$start=$_POST['start'];
		//$end=$_POST['end'];
		mysqli_select_db($connection,"cbtonline_db");
		$result=mysqli_query($connection,"SELECT *FROM $set WHERE question_content like '%".$key."%'");
		//$num_row=mysqli_num_rows($result);
		while($res=mysqli_fetch_array($result))
			{
				if($res['publish']=='Y')
					{
					
						echo "<tr >
							<td>{$res['id']}</td>
							<td> <input id={$res['id']} data-set='{$set}' class='checkbox-edit' type='checkbox'></td>
							<td class='quest_cont'>{$res['question_content']}</td>
							<td>{$set1}</td>
							<td>{$res['option1']}</td>
							<td>{$res['option2']}</td>
							<td>{$res['option3']}</td>
							<td>{$res['option4']}</td>
							<td>{$res['option5']}</td>
							<td>{$res['course']}</td>
							<td>{$res['board']}</td>
							<td> <div class='btn-group btn-group-xs '>			  
									<button id={$res['id']} data-toggle='modal' 
									data-target='#edit-question-modal'
									data-ig={$res['question_img']}
									data-set={$set} type='button' 
									class='btn btn-primary edit '>Edit</button>
									<button type='button' id={$res['id']} data-set={$set}  class='btn btn-warning delete'>Delete</button>
									<button type='button' data-id={$res['id']} id=c{$res['id']} data-set={$set}  
									class='btn btn-success publish'>publish</button>
									
								</div>
							</td>
							</tr>";
					}
				else
					{
						echo "<tr >
							<td>{$res['id']}</td>
							<td> <input id={$res['id']} data-set='{$set}' class='checkbox-edit' type='checkbox'></td>
							<td class='quest_cont'>{$res['question_content']}</td>
							<td>{$set1}</td>
							<td>{$res['option1']}</td>
							<td>{$res['option2']}</td>
							<td>{$res['option3']}</td>
							<td>{$res['option4']}</td>
							<td>{$res['option5']}</td>
							<td>{$res['course']}</td>
							<td>{$res['board']}</td>
							<td> <div class='btn-group btn-group-xs '>			  
									<button id={$res['id']} data-toggle='modal' 
									data-target='#edit-question-modal'
									data-ig={$res['question_img']}
									data-set={$set} type='button' 
									class='btn btn-primary edit '>Edit</button>
									<button type='button' id={$res['id']} data-set={$set}  class='btn btn-warning delete'>Delete</button>
									<button type='button' data-id={$res['id']} id=c{$res['id']} data-set={$set}  
									class='btn btn-danger publish'>Unpublish</button>
									
								</div>
							</td>
							</tr>";
					}
			}
		
	}


if(isset($_POST['quest_st']))
	{
		global $connection;
		connect();
		mysqli_select_db($connection,"cbtonline_db");
		$set=$_POST['set'];
		$id=$_POST['quest_st'];
		$result=mysqli_query($connection,"SELECT *FROM $set WHERE id='{$id}'");
		$res=mysqli_fetch_array($result);
		 echo json_encode($res);
		 
	}
if(isset($_POST['crskey']))
	{
		$cs=$_POST['crskey'];
		global $connection;
		connect();
		mysqli_select_db($connection,"cbtonline_db");
		$result=mysqli_query($connection,"SELECT *FROM courses WHERE course_title LIKE '%".$cs."%'");
		
		while($res=mysqli_fetch_array($result))
			{
				$bd_des=$res['course_description'];
				$bd_des=str_replace(' ' ,'_',$bd_des);
				  $dang='dang'.$res['course_title'];
			if($res['publish']=='Y')
			{
				echo 
				"<tr class='checkbox-edit' id={$res['id']}>
					
					<td>{$res['id']}</td>
					<td><span class='glyphicon glyphicon-ok text-success $dang'></span></td>
					<td> <input class='checkbox-edit' id={$res['id']} type='checkbox' ></td>
					<td>{$res['course_title']}</td>
					<td>{$res['course_description']}</td>
					<td>{$res['course_sets']}</td>
					<td>  
					<div class='btn-group btn-group-xs '>
							<button id='edit-board'
								board_id={$res['id']}
								board_title={$res['course_title']}
								board_description='{$bd_des}'
								board_sets={$res['course_sets']}
								type='button' class='btn btn-primary edit-board' data-target='#edit_course_modal'
									data-toggle='modal' >Edit
							</button>
							
							<button type='button' 
								course_title={$res['course_title']}
								class='btn btn-warning delete_board'>Delete
							</button>
							<button type='button' id={$res['course_title']} board_name={$res['course_title']}
							board_publish={$res['publish']}
							class='btn publish_btn btn-danger '> 
							Unpublish
							</button>
							
					</div>
					</td>
				</tr>";
				
			}
	
			else
			{
				echo "<tr >
					<td>{$res['id']}</td>
					<td><span class='glyphicon glyphicon-remove text-danger $dang'></span></td>
					<td> <input class='checkbox-edit' id={$res['id']} type='checkbox' ></td>
					<td>{$res['course_title']}</td>
					<td>{$res['course_description']}</td>
					<td>{$res['course_sets']}</td>
					<td>  
					<div class='btn-group btn-group-xs '>
							<button id='edit-board'
								board_id={$res['id']}
								board_title={$res['course_title']}
								board_description='{$bd_des}'
								
								board_sets={$res['course_sets']}
								type='button' class='btn btn-primary edit-board' data-target='#edit_course_modal'
									data-toggle='modal' >Edit
							</button>
							
							<button type='button' 
								course_title={$res['course_title']}
								class='btn btn-warning delete_board'>Delete
							</button>
							<button type='button' id={$res['course_title']} board_name={$res['course_title']}
							board_publish={$res['publish']}
							class='btn publish_btn btn-success'> 
							publish
							</button>
							
					</div>
					</td>
						</tr>";
			}
		}
		
	}
if(isset($_POST['srchbd']))
	{
		$bd=$_POST['srchbd'];
		global $connection;
		connect();
		mysqli_select_db($connection,"cbtonline_db");
		$result=mysqli_query($connection,"SELECT *FROM boards WHERE board_title LIKE '%".$bd."%'");
		
		while($boards=mysqli_fetch_array($result))
			{
				$bd_des=$boards['board_description'];
				$bd_des=str_replace(' ' ,'_',$bd_des);
				  $dang='dang'.$boards['board_title'];
			if($boards['publish']=='Y')
			{
				echo 
				"<tr >
					<td>{$boards['id']}</td>
					<td><span class='glyphicon glyphicon-ok text-success $dang'></span></td>
					<td> <input class='checkbox-edit' id={$boards['id']} type='checkbox' ></td>
					<td>{$boards['board_title']}</td>
					<td>{$boards['board_description']}</td>
					<td>{$boards['board_courses']}</td>
					<td> 
					  <div class='btn-group btn-group-xs '>
					<button id='edit-board'
						board_id={$boards['id']}
						board_img={$boards['board_img']}
						board_title={$boards['board_title']}
						board_description={$bd_des}
						board_courses={$boards['board_courses']}
						type='button' class='btn btn-primary edit-board ' data-toggle='modal' data-target='#edit_board_modal'>Edit
					</button>
					
					<button type='button' 
						board_title={$boards['board_title']}
						class='btn btn-warning delete_board'>Delete
					</button>
					
					<button type='button' id={$boards['board_title']} board_name={$boards['board_title']}
					board_publish={$boards['publish']}
					class='btn publish_btn btn-danger'> 
					Unpublish
					</button>
					
					</div></td>
				</tr>";
				
			}
	
			else
			{
				echo "<tr>
					<td>{$boards['id']}</td>
					<td><span class='glyphicon glyphicon-remove text-danger $dang'></span></td>
					<td> <input  class='checkbox-edit' id={$boards['id']} type='checkbox' ></td>
					<td>{$boards['board_title']}</td>
					<td>{$boards['board_description']}</td>
					<td>{$boards['board_courses']}</td>
					<td> 
					  <div class='btn-group btn-group-xs '>
					<button id='edit-board'
						board_id={$boards['id']}
						board_img={$boards['board_img']}
						board_title={$boards['board_title']}
						board_description={$bd_des}
						board_courses={$boards['board_courses']}
						type='button' class='btn btn-primary edit-board ' data-toggle='modal' data-target='#edit_board_modal'>Edit
					</button>
					
					<button type='button' 
						board_title={$boards['board_title']}
						class='btn btn-warning delete_board'>Delete
					</button>
					
					<button type='button' id={$boards['board_title']} board_name={$boards['board_title']}
					board_publish={$boards['publish']}
					class='btn publish_btn  btn-success'> 
						Publish
					</button>
					
					</div></td>
				</tr>";
			}
		}
	}

	
?>