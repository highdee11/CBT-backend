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
		var chk=confirm("Delete Course?");
			if(chk)
			{
				$.post("Course.php",{delete_course_id:id},function(data){
					window.location="Course.php?edit-course";
				});
			}
		 });
			
			 
	});

	
//unpublishing with checkbox-unpub
$("#chkbx-unpub").click(function(){
	 
	$("input[class='checkbox-edit']:checked").each(function(){
		
		var id=$(this).attr('id');
		var btn=$(this).attr('id');
	$.post("Course.php",{unpublishid:id},function(data){
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
	$.post("Course.php",{publishid:id},function(data){
	
			$("#"+btn).removeClass('btn-success').addClass('btn-danger').html('Unpublish');
			$(".dang"+btn).removeClass('glyphicon-remove').addClass('glyphicon-ok')
			.addClass('text-success').removeClass('text-danger');
		
		});
		
 
				
		 });
});
	
$("#search-edit-course").keyup(function(data){
	var key=$(this).val();
	$.post("function.php",{crskey:key},function(data){
		$("#edit-course-table tbody").html(data);
	if(data=='')
		{
				$("#edit-course-table tbody").html("<span class='text-danger'>No matching result</span>");
		}


// search Edit button click function	
	 $(".edit-board").click(function(){ 
	    var btn=$(this); 
		target=$(this).attr('board_id');
		  $(".board-form-edit").show();
			id=btn.attr('board_id');
			var board_title=btn.attr('board_title');
			var board_description=btn.attr('board_description');
				board_description=board_description.replace(/\_/g,' ');
			var board_courses=btn.attr('board_sets');
				
			 board_course=board_courses.split(',');
			  
			  
		 $("#board-name-field").val(board_title);
		 $("#board-description-field").val(board_description);
		 $("#course-select").val(''); 
		   for(var c=0;c<board_course.length;c++)
		   {  
			$("#course-select").val(board_course).trigger('chosen:updated');
			
		   }
		  
			  
			$("#edit_board").attr('action','Course.php?edit-course&target='+target); 
		   
		 $("html body").animate({scrollTop:$("body").offset().top},300);
		   
	});
		
//search delete button click function
	$(".delete_board").click(function(){
		
		var title=$(this).attr('course_title');
		var chk=confirm("Delete Course?");
		if(chk)
		{
			$.post("Course.php",{delete_course:title},function(data){
				window.location="Course.php?edit-course";
			});
		}
	});
	
//search publish button click function 

	
	$(".publish_btn").click(function(){
		var publish=$(this).attr('board_publish');
		var title=$(this).attr('board_name');
		var btn=$(this).attr('id');
		  
		$.post("Course.php",{publish:title},function(data){
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
	
	});
	
});
	 $(".board-form-edit").hide();
	  $("#edit-board").click(function(){
		  $(".board-form-edit").toggleClass('show');
		  
	  });
	
		$("#set-modal-submit-btn").click(function(){
		  
		  var title=$("#set-modal-name-field").val();
		   
		 
		if(title.trim()<=0)
			  {
				   if(!$("#set-modal-name-group").hasClass('has-feedback'))
					{
						
						 $(".m-fdbk1 ").removeClass('hidden');
					}
				 $("#set-modal-name-group").addClass('has-feedback').addClass('has-error');
				   
				  
			  }
			  else
				{
						$(".m-fdbk1 ").addClass('hidden');
						 $("#set-modal-name-group").removeClass('has-feedback').removeClass('has-error');
				}
		});
	$("#close_edit_form").click(function(){
			$(".board-form-edit").hide();
		});
		
//Edit button click function	
	 $(".edit-board").click(function(){ 
	    var btn=$(this); 
		target=$(this).attr('board_id');
		  $(".board-form-edit").show();
			id=btn.attr('board_id');
			var board_title=btn.attr('board_title');
			var board_description=btn.attr('board_description');
				board_description=board_description.replace(/\_/g,' ');
			var board_courses=btn.attr('board_sets');
				
			 board_course=board_courses.split(',');
			  
			  
		 $("#board-name-field").val(board_title);
		 $("#board-description-field").val(board_description);
		 $("#course-select").val(''); 
		   for(var c=0;c<board_course.length;c++)
		   {  
			$("#course-select").val(board_course).trigger('chosen:updated');
			
		   }
		  
			  
			$("#edit_board").attr('action','Course.php?edit-course&target='+target); 
		   
		 $("html body").animate({scrollTop:$("body").offset().top},300);
		   
	});
		
//delete button click function
	$(".delete_board").click(function(){
		
		var title=$(this).attr('course_title');
		var chk=confirm("Delete Course?");
		if(chk)
		{
			$.post("Course.php",{delete_course:title},function(data){
				window.location="Course.php?edit-course";
			});
		}
	});
	
// publish button click function

	
	$(".publish_btn").click(function(){
		var publish=$(this).attr('board_publish');
		var title=$(this).attr('board_name');
		var btn=$(this).attr('id');
		  
		$.post("Course.php",{publish:title},function(data){
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
	

	
	 //validating create board form 
	  $("#course-submit-btn").click(function(){
		  
		  var title=$("#board-name-field").val();
		  var description=$("#board-description-field").val();
		  var course=$("#course-select").val();
			var  check=true;
		    
		  
		    if(title.trim()<=0)
			  {
				   if(!$("#board-name-group").hasClass('has-feedback'))
					{
						
						 $(".fdbk1 ").removeClass('hidden');
					}
				 $("#board-name-group").addClass('has-feedback').addClass('has-error');
				    check=false;
				  return false;
			  }
			  else
				{
						$(".fdbk1 ").addClass('hidden');
						 $("#board-name-group").removeClass('has-feedback').removeClass('has-error');
				}
			  /*if(description.trim()<=0)
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
				*/
				if(course=="")
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
			 if(check==true)
			 {
				 
			 } 
			
			
	  });
	
	
	
	
	
	
	
	
	
});