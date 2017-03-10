$(function(){
var config={
		'.chosen-select':{},
		'.chosen-select-deselect':{allow_single_deselect:true},
		'.chosen-select-no-single':{disable_search_threshold:10},
		'.chosen-select-no-result':{no_results_text:'Oops,nothing found!'},
		'.chosen-select-width':{width:'95%'}
	}
	for ( var selector in config)
	{
		$(selector).chosen(config[selector]);
	}

 //deleting with checked box
	$("#chkbx-del").click(function(){
 	$("input[class='checkbox-edit']:checked").each(function(){
		var id=$(this).attr('id');	 
		 var set=$(this).attr('data-set');
		var chk=confirm("Delete Course?");
			if(chk)
			{
				$.post("Question.php",{delete_question_id:id,questset:set},function(data){
						
			 		});
			}window.location="Question.php?edit-question";
		 });
			
			 
	});
$("#search_question_field").keyup();
//unpublishing with checkbox-unpub
$("#chkbx-unpub").click(function(){
	 
	$("input[class='checkbox-edit']:checked").each(function(){
		
		var id=$(this).attr('id');
		var set=$(this).attr('data-set');
		var btn=$(this).attr('id');
	$.post("Question.php",{unpublishid:id,unpub_set:set},function(data){
		 $("#c"+id).removeClass('btn-danger').addClass('btn-success').html('Publish');
		});
		
		
});
});
//publishing with checkbox-pub
$("#chkbx-pub").click(function(){
 
	$("input[class='checkbox-edit']:checked").each(function(){
		var id=$(this).attr('id');
		var set=$(this).attr('data-set');
		var btn=$(this).attr('id');
	$.post("Question.php",{publishid:id,ppub_set:set},function(data){
		$("#c"+id).removeClass('btn-success').addClass('btn-danger').html('Unpublish');
		});
				
	 });
});
	
	
 $(".question-col-edit").hide();
	  $("#edit-question").click(function(){
		  $(".question-col-edit").toggleClass('show');
		  
	  });


//search questions select 
$("#search_question_select").change(function(){
	$("#search_question_field").keyup();
});

//search question using input field
$("#search_question_field").keyup(function(){
	var key=$(this).val();
	var set=$("#search_question_select").val();
	var pstart=0;
	var pend=1;
//posting for pagination
	//$.post("function.php",{pkey:key,pset_key:set},function(data){});
//posting for question
	$.post("function.php",{key:key,set_key:set},function(data){
	
		if(data!='')
			{
				$("#edit_question_table tbody").html(data);
			}
		else
			{
				$("#edit_question_table tbody").html("<span class='text-danger'>No Result found</span>");
			}

//delete question btn
	$(".delete").click(function(){
		var id=$(this).attr('id');
		var set=$(this).attr('data-set');
		var chk=confirm("Delete Question?");
		if(chk)
		{
			$.post("Question.php",{delete_question:id,quest_set:set},function(data){
			window.location="Question.php?edit-question";
			 		});

		}
			});

// publish button click function

	
	$(".publish").click(function(){
		var set=$(this).attr('data-set');
		var id=$(this).attr('data-id');  
	 
		$.post("Question.php",{publish:id,pub_set:set},function(data){
			//alert(data);
			if($("#c"+id).hasClass('btn-success'))
				{
					$("#c"+id).removeClass('btn-success').addClass('btn-danger').html('Unpublish');
				}
			else if($("#c"+id).hasClass('btn-danger'))
				{
					$("#c"+id).removeClass('btn-danger').addClass('btn-success').html('Publish');
				}
		});
		
	});
	
$("#question_img").mouseover(function(){
	 
});

$("#question_img").mouseout(function(){
	$(this).css('position','relative');
});
//click edit button of a question	
$(".edit").click(function(){
	
					var id=$(this).attr('id');
					var ig=$(this).attr('data-ig');
					var set=$(this).attr('data-set');
					
						var set1=set.split('_');
					$.post("function.php",{quest_st:id,set:set},function(data){
						data=$.parseJSON(data);
						$("#question-select-boardedt").val(data['board']);
						getcourse(data['board'],data['course']);
						//$("#question-select-courseedt").val(data['course']);
						getset(data['course'],set1[1]);
						 
						//$("#question-select-setsedt").val(set1[1]);
						$("#question-content").val(data['question_content']);
						$("#option1").val(data['option1']);
						$("#option2").val(data['option2']);
						$("#option3").val(data['option3']);
						$("#option4").val(data['option4']);
						$("#option5").val(data['option5']);
						if(data['question_img']!='')
							{
								if(data['question_img']=='none')
								{$("#question_img").attr('src','');}
								else
								{$("#question_img").attr('src','quest-img/'+data['question_img']);}
								//$("#question_img_mod").attr('src','quest-img/'+data['question_img']);
							}
						$("#edit_question_form").attr('action','question.php?edit-question&id='+data['id']+'&fmrset='+set+'&ig='+ig);
					$("[name='quest_answ']").each(function(){
						if($(this).val()==data['answer'])
							{
								$(this).val(data['answer']).prop('checked','true');
							
							}
							
					});
						 
						//$("#question-select-set").removeAttr('disabled').val(set[1]);
					});
});
});
	
	
}); 
// setting values into select fields in edit question page
$("#question-select-boardedt").change(function(){
							var board=$(this).val();
							
							
							//alert(document.cookie);
							$.post("function.php",{board_title:board},function(data){
								if(board!='NUll' && data!='')
									{	
										var course=data.split(',');
										  $("#question-select-courseedt").html("<option></option>");
										  
										for ( var c=0;c<course.length;c++)
											{
												
												$("#question-select-courseedt").removeAttr('disabled').append("<option>"+course[c]+"</option>");
											}
									}
								else 
									{
										$("#question-select-courseedt").html("<option>This board has no question set</option>").prop('disabled','true');
									}
							});
						});
						
	$("#question-select-courseedt").change(function(){
							var course=$(this).val();
							$.post("function.php",{course_title:course},function(data){
								if(course!='NUll' && data!='')
									{	
										var course=data.split(',');
										  $("#question-select-setsedt").html("<option></option>");
										  
										for ( var c=0;c<course.length;c++)
											{
												
												$("#question-select-setsedt").removeAttr('disabled').append("<option>"+course[c]+"</option>");
											}
									}
								else 
									{
										$("#question-select-setsedt").html("<option>This board has no question set</option>").prop('disabled','true');
									}
							});
						});
						
$("#question-select-setsedt").change(function(){
		var set=$("#question-select-sets").val()+'';
		document.cookie='set_quest='+set+'/;';
		//alert(document.cookie);
	});

function getcourse(bd,bbd)
{
	//var bd=$("#question-select-board").val(); 
	if(bd!='')
			{	
				//alert(document.cookie);
				 
				$.post("function.php",{board_title:bd},function(data){
					if(bd!='NUll' && data!='')
						{	
							var course=data.split(',');
							
							 $("#question-select-courseedt").html("");
							  
							for ( var c=0;c<course.length;c++)
								{
									
									$("#question-select-courseedt").removeAttr('disabled').append("<option>"+course[c]+"</option>");
								}
						$("#question-select-courseedt").val(bbd);
						}
					else 
						{
							$("#question-select-courseedt").html("<option>This board has no course set</option>").prop('disabled','true');
						}
				});
			}
			
}

function getset(cs,ccs)
	{

	if(cs!='')
		{  
			$.post("function.php",{course_title:cs},function(data){
						if(cs!='NUll' && data!='')
							{	  
								var course=data.split(',');
								  $("#question-select-setsedt").html("");
								  
								for ( var c=0;c<course.length;c++)
									{
										
										$("#question-select-setsedt").removeAttr('disabled').append("<option>"+course[c]+"</option>");
									}
									  $("#question-select-setsedt").val(ccs);
							}
						else 
							{
								$("#question-select-setsedt").html("<option>This course has no question-set in it</option>").prop('disabled','true');
							}
					});
		}				
	}
if(document.cookie || !document.cookie)
	{		
			var dc=document.cookie;
//automatically putting the last board used back in the field
			var boardq=dc.slice(dc.indexOf('board_quest'),dc.indexOf(';'));
			if(boardq!='')
			{
				 
							var boarddc=boardq.split('=');
							
							//alert(document.cookie);
							$.post("function.php",{board_title:boarddc[1]},function(data){
								if(boarddc!='NUll' && data!='')
									{	
										var course=data.split(',');
										  $("#question-select-course").html("<option></option>");
										  
										for ( var c=0;c<course.length;c++)
											{
												
												$("#question-select-course").removeAttr('disabled').append("<option>"+course[c]+"</option>");
											}
									}
								else 
									{
										$("#question-select-course").html("<option>This board has no question set</option>").prop('disabled','true');
									}
							});$("#question-select-board").val(boarddc[1]);
			}
//automatically putting the last course used back in the field
			var courseq=dc.slice(dc.indexOf('course_quest'),dc.indexOf('/'));
			coursedc=courseq.split('=');
				if(coursedc!='')
				{
					$.post("function.php",{course_title:coursedc[1]},function(data){
								if(course!='NUll' && data!='')
									{	
										var course=data.split(',');
										$("#question-select-sets").html("<option></option>");
										  
										for ( var c=0;c<course.length;c++)
											{
												
												$("#question-select-sets").removeAttr('disabled').append("<option>"+course[c]+"</option>");
											}
									}
								else 
									{
										$("#question-select-sets").html("<option>This board has no question set</option>").prop('disabled','true');
									}
									$("#question-select-course").val(coursedc[1]);
							});
				}
//automatically putting the last set used back in the field
	var setq=dc.slice(dc.indexOf('set_quest'),dc.indexOf('/'));
			setdc=setq.split('=');
			//setdc=setdc.split('/');
			
			if(setdc!='')
			{
				 
				$("#question-select-sets").val(setdc[1]);
			}
			
				$("#question-select-board").change(function(){
							var board=$(this).val();
							document.cookie='board_quest='+board+';';
							
							//alert(document.cookie);
							$.post("function.php",{board_title:board},function(data){
								if(board!='NUll' && data!='')
									{	
										var course=data.split(',');
										  $("#question-select-course").html("<option></option>");
										  
										for ( var c=0;c<course.length;c++)
											{
												
												$("#question-select-course").removeAttr('disabled').append("<option>"+course[c]+"</option>");
											}
									}
								else 
									{
										$("#question-select-course").html("<option>This board has no question set</option>").prop('disabled','true');
									}
							});
						});
						
						
						$("#question-select-course").change(function(){
							var course=$(this).val();
							document.cookie='course_quest='+course+'/;';
							//alert(document.cookie);
							$.post("function.php",{course_title:course},function(data){
								if(course!='NUll' && data!='')
									{	
										var course=data.split(',');
										  $("#question-select-sets").html("<option></option>");
										  
										for ( var c=0;c<course.length;c++)
											{
												
												$("#question-select-sets").removeAttr('disabled').append("<option>"+course[c]+"</option>");
											}
									}
								else 
									{
										$("#question-select-sets").html("<option>This board has no question set</option>").prop('disabled','true');
									}
							});
						});
						
						$("#question-select-sets").change(function(){
							var set=$("#question-select-sets").val()+'';
							document.cookie='set_quest='+set+'/;';
							//alert(document.cookie);
						});
	}
		$(".option_add").click(function(){
			$("#option-group5").toggleClass('hidden');//.slideDown();
		});
		
	 var answer;
	$("[name='quest_answ']").click(function(){
		answer=$(this).val();
	});
 //validating edit board form 
	  $(".btnupdate").click(function(){
		  
			 
		  var  selectboard=$("#question-select-boardedt").val();
		  var  selectcourse=$("#question-select-courseedt").val();
		  var  selectset=$("#question-select-setsedt").val();
		  var content=$("#question-content").val();
		  var option1=$("#option1").val();
		  var option2=$("#option2").val();
		  var option3=$("#option3").val();
		  var option4=$("#option4").val();
		  var answerupd=$("[name='quest_answ']:checked").val();
		 // var option5=$("#option5").val();
		 // var answer=$("[name='quest_answ']").val();
			
			
			
			
		  if(selectboard=="")
				{
					 
					  if(!$("#question-board-group").hasClass('has-feedback'))
					{
						
						$(".fdbks2 ").removeClass('hidden');
					}
					$("#question-board-group").addClass('has-feedback').addClass('has-error');
					 return false;
				}
				else
				{
						$("#question-board-group").removeClass('has-feedback').removeClass('has-error');
						$(".fdbks2 ").addClass('hidden');
				}
		 if(selectcourse==null || selectcourse=='')
				{
					
					  if(!$("#question-course-group").hasClass('has-feedback'))
					{
						
						$(".fdbks1").removeClass('hidden');
						
					}
					$("#question-course-group").addClass('has-feedback').addClass('has-error');
					 return false;
				}
				else
				{
						$("#question-course-group").removeClass('has-feedback').removeClass('has-error');
						$(".fdbks1 ").addClass('hidden');
				}
				
		  if(selectset==null || selectset=='')
				{ 
					 
					  if(!$("#question-set-group").hasClass('has-feedback'))
					{
						
						$(".fdbks3 ").removeClass('hidden');
					}
					$("#question-set-group").addClass('has-feedback').addClass('has-error');
					 return false;
				}
				else
				{
						$("#question-set-group").removeClass('has-feedback').removeClass('has-error');
						$(".fdbks3 ").addClass('hidden');
				}
			
		  
		if(content.trim()<=0)
				{
					 if(!$("#question-content-group ").hasClass('has-feedback'))
					{
						
						$(".fdbk0 ").removeClass('hidden');
					}
					
					$("#question-content-group").addClass('has-feedback').addClass('has-error');
				  return false;
				}
				else
				{
						$(".fdbk0").addClass('hidden');
						$("#question-content-group").removeClass('has-feedback').removeClass('has-error');
				}
				 
		 
		if(option1.trim()<=0)
			  {
				   if(!$("#option-group1").hasClass('has-feedback'))
					{
						
						 $(".fdbk1 ").removeClass('hidden');
					}
				 $("#option-group1").addClass('has-feedback').addClass('has-error');
				    return false;
				  
			  }
			  else
				{
						$(".fdbk1 ").addClass('hidden');
						 $("#option-group1").removeClass('has-feedback').removeClass('has-error');
				}
				
		if(option2.trim()<=0)
			  {
				   if(!$("#option-group2").hasClass('has-feedback'))
					{
						
						 $(".fdbk2 ").removeClass('hidden');
					}
				 $("#option-group2").addClass('has-feedback').addClass('has-error');
				  return false;
				   
				  
			  }
			  else
				{
						$(".fdbk2 ").addClass('hidden');
						 $("#option-group2").removeClass('has-feedback').removeClass('has-error');
				}
		if(option3.trim()<=0)
			  {
				   if(!$("#option-group3").hasClass('has-feedback'))
					{
						
						 $(".fdbk3 ").removeClass('hidden');
					}
				 $("#option-group3").addClass('has-feedback').addClass('has-error');
				  return false;
				   
				  
			  }
			  else
				{
						$(".fdbk3 ").addClass('hidden');
						$("#option-group3").removeClass('has-feedback').removeClass('has-error');
				}
		 if(option4.trim()<=0)
			  {
				   if(!$("#option-group4").hasClass('has-feedback'))
					{
						
						 $(".fdbk4 ").removeClass('hidden');
					}
				 $("#option-group4").addClass('has-feedback').addClass('has-error');
					 
				 return false;
				  
			  }
			  else
				{
						$(".fdbk4 ").addClass('hidden');
						 $("#option-group4").removeClass('has-feedback').removeClass('has-error');
				}
	/*	 if(option5.trim()<=0)
			  {
				   if(!$("#option-group5").hasClass('has-feedback'))
					{
						
						 $(".fdbk5 ").removeClass('hidden');
					}
				 $("#option-group5").addClass('has-feedback').addClass('has-error');
				  
			  }
			  else
				{
						$(".fdbk5 ").addClass('hidden');
						 $("#option-group5").removeClass('has-feedback').removeClass('has-error');
				}
		
			*/ if((typeof answerupd)=='undefined')
				{
					 if(!$("#answer").hasClass('has-feedback'))
					{
						
						$(".fdbksa ").removeClass('hidden');
					}
					$("#answer").addClass('has-feedback').addClass('has-error');
					 return false;
				}
				else
				{
						$("#answer").removeClass('has-feedback').removeClass('has-error');
						$(".fdbksa ").addClass('hidden');
				}
				
			
	  });
	 
	 
	 
	 //validating create board form 
	  $("#question-submit-btn").click(function(){
		  
			 
		  var  selectboard=$("#question-select-board").val();
		  var  selectcourse=$("#question-select-course").val();
		  var  selectset=$("#question-select-sets").val();
		  var content=$("#question-content").val();
		  var option1=$("#option1").val();
		  var option2=$("#option2").val();
		  var option3=$("#option3").val();
		  var option4=$("#option4").val();
		  var option5=$("#option5").val();
		 // var answer=$("[name='quest_answ']").val();
			
			
			
			
		  if(selectboard=="")
				{
					 
					  if(!$("#question-board-group").hasClass('has-feedback'))
					{
						
						$(".fdbks2 ").removeClass('hidden');
					}
					$("#question-board-group").addClass('has-feedback').addClass('has-error');
					 return false;
				}
				else
				{
						$("#question-board-group").removeClass('has-feedback').removeClass('has-error');
						$(".fdbks2 ").addClass('hidden');
				}
		 if(selectcourse==null || selectcourse=='')
				{
					
					  if(!$("#question-course-group").hasClass('has-feedback'))
					{
						
						$(".fdbks1").removeClass('hidden');
						
					}
					$("#question-course-group").addClass('has-feedback').addClass('has-error');
					 return false;
				}
				else
				{
						$("#question-course-group").removeClass('has-feedback').removeClass('has-error');
						$(".fdbks1 ").addClass('hidden');
				}
				
		  if(selectset==null || selectset=='')
				{ 
					 
					  if(!$("#question-set-group").hasClass('has-feedback'))
					{
						
						$(".fdbks3 ").removeClass('hidden');
					}
					$("#question-set-group").addClass('has-feedback').addClass('has-error');
					 return false;
				}
				else
				{
						$("#question-set-group").removeClass('has-feedback').removeClass('has-error');
						$(".fdbks3 ").addClass('hidden');
				}
			
		  
		if(content.trim()<=0)
				{
					 if(!$("#question-content-group ").hasClass('has-feedback'))
					{
						
						$(".fdbk0 ").removeClass('hidden');
					}
					
					$("#question-content-group").addClass('has-feedback').addClass('has-error');
				  return false;
				}
				else
				{
						$(".fdbk0").addClass('hidden');
						$("#question-content-group").removeClass('has-feedback').removeClass('has-error');
				}
				 
		 
		if(option1.trim()<=0)
			  {
				   if(!$("#option-group1").hasClass('has-feedback'))
					{
						
						 $(".fdbk1 ").removeClass('hidden');
					}
				 $("#option-group1").addClass('has-feedback').addClass('has-error');
				    return false;
				  
			  }
			  else
				{
						$(".fdbk1 ").addClass('hidden');
						 $("#option-group1").removeClass('has-feedback').removeClass('has-error');
				}
				
		if(option2.trim()<=0)
			  {
				   if(!$("#option-group2").hasClass('has-feedback'))
					{
						
						 $(".fdbk2 ").removeClass('hidden');
					}
				 $("#option-group2").addClass('has-feedback').addClass('has-error');
				  return false;
				   
				  
			  }
			  else
				{
						$(".fdbk2 ").addClass('hidden');
						 $("#option-group2").removeClass('has-feedback').removeClass('has-error');
				}
		if(option3.trim()<=0)
			  {
				   if(!$("#option-group3").hasClass('has-feedback'))
					{
						
						 $(".fdbk3 ").removeClass('hidden');
					}
				 $("#option-group3").addClass('has-feedback').addClass('has-error');
				  return false;
				   
				  
			  }
			  else
				{
						$(".fdbk3 ").addClass('hidden');
						$("#option-group3").removeClass('has-feedback').removeClass('has-error');
				}
		 if(option4.trim()<=0)
			  {
				   if(!$("#option-group4").hasClass('has-feedback'))
					{
						
						 $(".fdbk4 ").removeClass('hidden');
					}
				 $("#option-group4").addClass('has-feedback').addClass('has-error');
					 
				 return false;
				  
			  }
			  else
				{
						$(".fdbk4 ").addClass('hidden');
						 $("#option-group4").removeClass('has-feedback').removeClass('has-error');
				}
		 if(option5.trim()<=0)
			  {
				   if(!$("#option-group5").hasClass('has-feedback'))
					{
						
						 $(".fdbk5 ").removeClass('hidden');
					}
				 $("#option-group5").addClass('has-feedback').addClass('has-error');
				  
			  }
			  else
				{
						$(".fdbk5 ").addClass('hidden');
						 $("#option-group5").removeClass('has-feedback').removeClass('has-error');
				}
		
			 if((typeof answer)=='undefined')
				{
					 if(!$("#answer").hasClass('has-feedback'))
					{
						
						$(".fdbksa ").removeClass('hidden');
					}
					$("#answer").addClass('has-feedback').addClass('has-error');
					 return false;
				}
				else
				{
						$("#answer").removeClass('has-feedback').removeClass('has-error');
						$(".fdbksa ").addClass('hidden');
				}
				
			
			
	  });
	 
	 
	 
});