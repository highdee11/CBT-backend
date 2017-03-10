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
					var chk=confirm("Delete Board?");
					if(chk)
					{
						$.post("Board.php",{delete_board_id:id},function(data){
							window.location="Board.php?edit-board";
						});
					}
				 });
		
		 
});
//unpublishing with checkbox-unpub
$("#chkbx-unpub").click(function(){
	 
	$("input[class='checkbox-edit']:checked").each(function(){
		
		var id=$(this).attr('id');
		var btn=$(this).attr('id');

		 
	$.post("Board.php",{unpublishid:id},function(data){		 				 
		$("#"+btn).removeClass('btn-danger').addClass('btn-success').html('Publish');
					$(".dang"+btn).removeClass('glyphicon-ok').addClass('glyphicon-remove')
					.addClass('text-danger').removeClass('text-success');			
			});
		
				
		 });
		
});
//publishing with checkbox-pub
$("#chkbx-pub").click(function(){
	
	$("input[class='checkbox-edit']:checked").each(function(){
		var id=$(this).attr('id');
		var btn=$(this).attr('id');
		$.post("Board.php",{publishid:id},function(data){		 				 
			$("#"+btn).removeClass('btn-success').addClass('btn-danger').html('Unpublish');
			$(".dang"+btn).removeClass('glyphicon-remove').addClass('glyphicon-ok')
			.addClass('text-success').removeClass('text-danger');
			
		});
		
 
				
		 });
});
//search board
	$("#search_bd").keyup(function(){
		var key=$(this).val();
		$.post("function.php",{srchbd:key},function(data){
			// $("#edit-bd-table body").html('');
			 $("#edit-bd-table tbody").html(data);
			 
//delete button click function
	$(".delete_board").click(function(){
		 
		var title=$(this).attr('board_title');
		var chk=confirm("Delete Board?");
		if(chk)
		{
			$.post("Board.php",{delete_board:title},function(data){
				window.location="Board.php?edit-board";
			});
		}
	});
	
// publish button click function

	$(".publish_btn").click(function(){
		var publish=$(this).attr('board_publish');
		var title=$(this).attr('board_name');
		var btn=$(this).attr('id');
		  
			$.post("Board.php",{publish:title},function(data){
			
		//window.location="Board.php?edit-board";
			if($("#"+btn).hasClass('btn-success'))
				{
					 
					$("#"+btn).removeClass('btn-success').addClass('btn-danger').html('Unpublish');
					$(".dang"+btn).removeClass('glyphicon-remove').addClass('glyphicon-ok')
					.addClass('text-success').removeClass('text-danger');
				}
			else if($("#"+btn).hasClass('btn-danger'))
				{
					$("#"+btn).removeClass('btn-danger').addClass('btn-success').html('Publish');
					$(".dang"+btn).removeClass('glyphicon-ok').addClass('glyphicon-remove')
					.addClass('text-danger').removeClass('text-success');
				}
		});
		
	});
					 
//Edit button click function	
	 $(".edit-board").click(function(){ 
			target=$(this).attr('board_id');
			 
			var btn=$(this); 
		  $(".board-form-edit").show();
			var board_title=btn.attr('board_title');
			id=btn.attr('board_id');
			var board_img='images/'+btn.attr('board_img');
			var board_description=btn.attr('board_description');
				board_description=board_description.replace(/\_/g,' ');
			var board_courses=btn.attr('board_courses');
			
			board_course=board_courses.split(',');
			  
			  $("#board_img").attr('src',board_img);
				 
				 	 
			  $("#edit_board").attr('action','Board.php?edit-board&target='+target); //alert($("#edit_board").attr('action'));
		 $("#board-name-field").val(board_title);
		 $("#board-description-field").val(board_description);
		 $("#course-select").val(''); 
		   for(var c=0;c<board_course.length;c++)
		   {  
			$("#course-select").val(board_course).trigger('chosen:updated');
			
		   }
		   
		 $("html body").animate({scrollTop:$("body").offset().top},300);
		   
	});
		
	
		});
	});

	//Edit button click function	
	 $(".edit-board").click(function(){ 
			target=$(this).attr('board_id');
			 
			var btn=$(this); 
		  $(".board-form-edit").show();
			var board_title=btn.attr('board_title');
			id=btn.attr('board_id');
			var board_img='images/'+btn.attr('board_img');
			var board_description=btn.attr('board_description');
				board_description=board_description.replace(/\_/g,' ');
			var board_courses=btn.attr('board_courses');
			
			board_course=board_courses.split(',');
			  
			  $("#board_img").attr('src',board_img);
				 
				 	 
			  $("#edit_board").attr('action','Board.php?edit-board&target='+target); //alert($("#edit_board").attr('action'));
		 $("#board-name-field").val(board_title);
		 $("#board-description-field").val(board_description);
		 $("#course-select").val(''); 
		   for(var c=0;c<board_course.length;c++)
		   {  
			$("#course-select").val(board_course).trigger('chosen:updated');
			
		   }
		   
		 $("html body").animate({scrollTop:$("body").offset().top},300);
		   
	});
		
	
	//  $(".board-form-edit").hide();
$("#close_edit_form").click(function(){
	 $(".board-form-edit").hide();
});
	var id=0;
	var target='';

//delete button click function
	$(".delete_board").click(function(){
		 
		var title=$(this).attr('board_title');
		var chk=confirm("Delete Board?");
		if(chk)
		{
			$.post("Board.php",{delete_board:title},function(data){
				window.location="Board.php?edit-board";
			});
		}
	});
	
// publish button click function

	$(".publish_btn").click(function(){
		var publish=$(this).attr('board_publish');
		var title=$(this).attr('board_name');
		var btn=$(this).attr('id');
		  
		$.post("Board.php",{publish:title},function(data){
				
		//window.location="Board.php?edit-board";
			if($("#"+btn).hasClass('btn-success'))
				{
					 
					$("#"+btn).removeClass('btn-success').addClass('btn-danger').html('Unpublish');
					$(".dang"+btn).removeClass('glyphicon-remove').addClass('glyphicon-ok')
					.addClass('text-success').removeClass('text-danger');
				}
			else if($("#"+btn).hasClass('btn-danger'))
				{
					$("#"+btn).removeClass('btn-danger').addClass('btn-success').html('Publish');
					$(".dang"+btn).removeClass('glyphicon-ok').addClass('glyphicon-remove')
					.addClass('text-danger').removeClass('text-success');
				}
		});
		
	});
		
 //validating edit  board form 		
	$("#board-update-btn").click(function(){
			 	  
					var title=$("#board-name-field").val();
						 
					var description=$("#board-description-field").val();
					  var course=$("#course-select").val();
					  var image=$("#board_img").val();
					  var check=true;
						
						 
						 
			if(title.trim()<=0)
						  {
							   if(!$("#board-name-group").hasClass('has-feedback'))
								{
									
									 $(".fdbk1 ").removeClass('hidden');
								}
							 $("#board-name-group").addClass('has-feedback').addClass('has-error');
							   
							  return false;
							  
						  }
						else
							{ 
								 

							}
			if(description.trim()<=0)
				{
				 if(!$("#board-description-group ").hasClass('has-feedback'))
					{
						
						$(".fdbk2 ").removeClass('hidden');
					}
					
					$("#board-description-group").addClass('has-feedback').addClass('has-error');
					 check=false;
					return false;
				}
			else
				{
						$(".fdbk2").addClass('hidden');
						$("#board-description-group").removeClass('has-feedback').removeClass('has-error');
				}
			/*if(course=="")
				{
					 
					  if(!$("#course-select-group").hasClass('has-feedback'))
					{
						
						$(".fdbk3 ").removeClass('hidden');
					}
					$("#course-select-group").addClass('has-feedback').addClass('has-error');
					 check=false;
					 return false;
				}
			else
				{
						$("#course-select-group").removeClass('has-feedback').removeClass('has-error');
						$(".fdbk3 ").addClass('hidden');
				}
				*/	
			 if(check==true)
			 {
				  
 			 }
			 
			
				   
			 
	   });
	 
	   
	   
	  //validating course modal
	  $("#course-modal-submit-btn").click(function(){
			  var title=$("#course-modal-name-field").val();
			   var course=$("#course-modal-select").val();
		     if(title.trim()<=0)
				  {
					   if(!$("#course-modal-name-group").hasClass('has-feedback'))
						{
							 
							 $(".m-fdbk1 ").removeClass('hidden');
						}
					 $("#course-modal-name-group").addClass('has-feedback').addClass('has-error');
					   
					   
				  }
			 else
					{
							$(".m-fdbk1 ").addClass('hidden');
							 $("#course-modal-name-group").removeClass('has-feedback').removeClass('has-error');
					}
				
			if(course=="")
				{
					 
					  if(!$("#course-modal-select-group").hasClass('has-feedback'))
					{
						
						$(".m-fdbk3 ").removeClass('hidden');
					}
					$("#course-modal-select-group").addClass('has-feedback').addClass('has-error');
				}
			else
				{
						$("#course-modal-select-group").removeClass('has-feedback').removeClass('has-error');
						$(".m-fdbk3 ").addClass('hidden');
				}
			 
	  });
	  
	  //validating create board form 
	  $("#board-submit-btn").click(function(){
		  
		 
				
		  var title=$("#board-name-field").val();
		  var description=$("#board-description-field").val();
		  var course=$("#course-select").val();
		  var image=$("#board_img").val();
		  var check=true;
		    
		     
		     
				if(title.trim()<=0)
			  {
				   if(!$("#board-name-group").hasClass('has-feedback'))
					{
						
						 $(".fdbk1 ").removeClass('hidden');
					}
				 $("#board-name-group").addClass('has-feedback').addClass('has-error');
				   
				  return false;
				  
			  }
			else
				{ 
					 

				}
				if(description.trim()<=0)
			{
				 if(!$("#board-description-group ").hasClass('has-feedback'))
		{
			
			$(".fdbk2 ").removeClass('hidden');
		}
		
				$("#board-description-group").addClass('has-feedback').addClass('has-error');
				 check=false;
					return false;
			}
		else
			{
					$(".fdbk2").addClass('hidden');
					$("#board-description-group").removeClass('has-feedback').removeClass('has-error');
			}
		/*if(course=="")
			{
				 
				  if(!$("#course-select-group").hasClass('has-feedback'))
				{
					
					$(".fdbk3 ").removeClass('hidden');
				}
				$("#course-select-group").addClass('has-feedback').addClass('has-error');
				 check=false;
				 return false;
			}
		else
			{
					$("#course-select-group").removeClass('has-feedback').removeClass('has-error');
					$(".fdbk3 ").addClass('hidden');
			}
			*/
		 
		if(check==true)
		{
			 
			 
		}
		
	  });
	  
	  
	  	 
	
	  
});