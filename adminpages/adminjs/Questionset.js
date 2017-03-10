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
				$.post("Questionset.php",{delete_set_id:id,del_set:set},function(data){
					 
					window.location="Questionset.php?edit-questionset";
				});
			}
			
		 });
			
			 
	});

	
//unpublishing with checkbox-unpub
$("#chkbx-unpub").click(function(){
	 
	$("input[class='checkbox-edit']:checked").each(function(){
		
		var id=$(this).attr('id');
		var btn=$(this).attr('id');
	$.post("Questionset.php",{unpublishid:id},function(data){
			 
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
	$.post("Questionset.php",{publishid:id},function(data){
			
			$("#"+btn).removeClass('btn-success').addClass('btn-danger').html('Unpublish');
					$(".dang"+btn).removeClass('glyphicon-remove').addClass('glyphicon-ok')
					.addClass('text-success').removeClass('text-danger');
		
		});
				
	 });
});
	
$("#search-edit-set").keyup(function(data){
	var key=$(this).val();
	$.post("function.php",{qsetkey:key},function(data){
		$("#edit-set-table tbody").html('');
		if(data!='')
		{
			$("#edit-set-table tbody").html(data);
		}
		else{$("#edit-course-set tbody").html("<span class='text-danger'>No matching result</span>"); }
		
		//Edit button click function	
	 $(".edit-board").click(function(){ 
			target=$(this).attr('board_id');
			var btn=$(this); 
		  $(".questionset-form-edit").show();
			var board_title=btn.attr('board_title');
			id=btn.attr('board_id');
			var board_img='images/'+btn.attr('board_img');
			var board_description=btn.attr('board_description');
				board_description=board_description.replace(/\_/g,' ');
			 
			  $("#board_img").attr('src',board_img);
		 $("#board-name-field").val(board_title);
		 $("#board-description-field").val(board_description);
		 $("#course-select").val(''); 
		   
			$("#edit_set").attr('action','Questionset.php?edit-questionset&target='+target);
		   
		 $("html body").animate({scrollTop:$("body").offset().top},300);
		   
	});
		
//delete button click function
	$(".delete_set").click(function(){
		 
		var title=$(this).attr('board_title');
		var chk=confirm("Delete QuestionSet?");
		if(chk)
		{
			$.post("Questionset.php",{delete_set:title},function(data){
				window.location="Questionset.php?edit-questionset";
			});
			
		}
	});
	
// publish button click function

	$(".publish_btn").click(function(){
		var publish=$(this).attr('board_publish');
		var title=$(this).attr('board_name');
		var btn=$(this).attr('id');
		  
		$.post("Questionset.php",{publish:title},function(data){
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
	 
	  $(".questionset-form-edit").hide();
	  $("#edit-questionset").click(function(){
		  $(".questionset-form-edit").toggleClass('show');
		  
	  });
	
$("#close_edit_form").click(function(){
	 $(".board-form-edit").hide();
});
	var id=0;
	var target='';
//Edit button click function	
	 $(".edit-board").click(function(){ 
			target=$(this).attr('board_id');
			var btn=$(this); 
		  $(".questionset-form-edit").show();
			var board_title=btn.attr('board_title');
			id=btn.attr('board_id');
			var board_img='images/'+btn.attr('board_img');
			var board_description=btn.attr('board_description');
				board_description=board_description.replace(/\_/g,' ');
		 
			  
			  $("#board_img").attr('src',board_img);
		 $("#board-name-field").val(board_title);
		 $("#board-description-field").val(board_description);
		 
		   
			$("#edit_set").attr('action','Questionset.php?edit-questionset&target='+target);
		   
		 $("html body").animate({scrollTop:$("body").offset().top},300);
		   
	});
		
//delete button click function
	$(".delete_set").click(function(){
		 
		var title=$(this).attr('board_title');
		var chk=confirm("Delete QuestionSet?");
		if(chk)
		{
			$.post("Questionset.php",{delete_set:title},function(data){
				window.location="Questionset.php?edit-questionset";
			});
			
		}
	});
	
// publish button click function

	$(".publish_btn").click(function(){
		var publish=$(this).attr('board_publish');
		var title=$(this).attr('board_name');
		var btn=$(this).attr('id');
		  
		$.post("Questionset.php",{publish:title},function(data){
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
	  $("#questionset-submit-btn").click(function(){
		  
		  var title=$("#board-name-field").val();
		  var description=$("#board-description-field").val();
		 
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
				  return false;
				}
				else
				{
						$(".fdbk2").addClass('hidden');
						$("#board-description-group").removeClass('has-feedback').removeClass('has-error');
				}
				 
			 */
			
			
	  });
	 
	
	
	
	
	
	
	
});