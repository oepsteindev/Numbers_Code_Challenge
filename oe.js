

   $(function() { 

		//init the screen
		$("#choose_next").hide();
		$("#clear").hide();
		$("#dupe_label").hide();
		$("#game_over").hide();

		$( "#start" ).click(function() {
			$("#start").hide();
		});

		//handle click for clear all button
		$( "#clear" ).click(function() {
			$("#chosen").html('');
			$("#choose_next").attr("disabled",false);
			$("#choose_next").text('Restart');
			$("#dupe_label").hide();
			$("#dash").hide();
			$("#dupe_nums").html('<span id="dupe_label" class="text-muted">Duplicate Tiles for this session:</span>');
		});

	});//end doc ready


   function get_sets(){

   	var sets ='';
   	var check_sets = [];
   	var dupes_arr = [];

   	//hide round over msg
   	$("#game_over").hide();
   	
   	$("#choose_next").text('Choose Next Set');

   	//get chosen set to check for dupes later
   	$.each( $(".chosen_row"), function( index, value ){
  			check_sets += value.value +',';
	});

	//remove trailing comma
	check_sets = check_sets.slice(0, -1);
	check_sets = JSON.parse("[" + check_sets + "]");

	//init dupe display by removing dupe class from all tiles
	$(".duplicate").removeClass("duplicate");

		//make ajax call to get the tile sets
		$.ajax({
				timeout: 10000,
			    url: "services.php?f=generate_sets",
			    type: "post",
			    dataType: 'json',
			    data: {check_sets:check_sets},
			    tryCount: 0,
			    retryLimit: 3,
			    success: function(resp) {

			    		//grab the duplicate vals from the response and create array to use belows
			    		//since we dont know what the returned keys are because they change all the time
			    		//lets grab just the values into this array
						if(resp.dupes!=''){

								for(key in resp.dupes) {
								    if(resp.dupes.hasOwnProperty(key)) {
								        var value = resp.dupes[key];
								        dupes_arr.push(value);
								    }
								}    
							}



					//clear the board
			        $("#gen_nums").html("");

			        //iterate loop and output all new generated tiles
			        for (i = 0; i < resp.sets.length; i++) { 
			        	sets += '<div id="set_'+i +'" class="wrap">';
						 $.each( resp.sets[i], function( index, value ){
				  				sets += '<span class="whitebox '+value+'" >'+value+'</span>';
						  });


						sets += '</div>';
						sets+='<span style="float:left;position:relative;vertical-align:middle;margin-top:10px;margin-left:10px;"><button class="btn btn-primary choice" id="set_'+i+'" onclick="javascript:move_set('+i+');">Choose this set!</button></span><input type="hidden" value="'+resp.sets[i]+'" id="values_'+i+'">';
					}
						
					$("#gen_nums").append(sets);


					
						//identify dupes and add the 'duplicate' class to identify them to the user
						//the length is 1 longer than the data for a reason I didnt have time to debug for
						//this project, so lets subtract 1 (which is always undefined) from the length
					   	for (i=0; i<=dupes_arr.length-1; i++){
					   		if(dupes_arr[i]!='undefined' && dupes_arr.length>0 && dupes_arr!=''){
								//append dupes to dashboard
								$("#dupe_label").show();
								$("#dash").show();
								$("#dupe_nums").append('<span class="whitebox_dash">'+dupes_arr[i]+'</span>');
								//create dupes selector
								//the classes of the elements match the returned dupe numbers
								dupe_class = "."+dupes_arr[i];

								//add duplicate class to signal dupe
								$(dupe_class).addClass("duplicate");

								
							}
					   	}
					

					//set panel heights to be the same
		 			var height = $(".myheight").css("height");
		 			$(".copied_height").css("height", height);

		 			//set initial msg for right side
		 			$(".chosen").html("No sets chosen.");
				},

			    error: function(xhr, textStatus, errorThrown) {
			        if (textStatus == 'timeout') {
			            this.tryCount++;
			            if (this.tryCount <= this.retryLimit) {
			                $.ajax(this);
			                return;
			            }
			        }
			        $("#response").html("There has been an error");

			    }
			});





   }

   //this function moves a set of number tiles from one area to the 'chosen area' 
   //@val is the index of the array for the row that was grabbed
   function move_set(val){

   	//if the game has not gone 3 rounds, keep going
   	if($(".chosen_set").length<3){

   		//set button text
   		$("#choose_next").text("Choose Next Set");

   		//init vars
		var set='';
		var array = $('#values_'+val).val().split(',');
	   	var val_array=[];

	   	//wrap the set in some styles
	   	$.each( array, function(index, value ){
			set += '<span class="whitebox '+value+'">'+value+'</span>';
			val_array += value +',';
		});

	   	//reove trailing comma
		val_array = val_array.slice(0, -1);

		//create the row number of the chosen set
		//var num_chosen = $(".chosen_set").length;

		
		//add chosen set to display and add a hidden data field for later and setup buttons for next round
		$("#chosen").append('<div  class="wrap chosen_set">'+ set+'</div><input type="hidden" class="chosen_row"  value="'+val_array+'">');
		$(".choice").text("...");
		$(".choice").attr("disabled",true);
		$("#choose_next").attr("disabled",false).show();

	}

	//if we've played 3 rounds, disable play options and reset duplicates
	if($(".chosen_set").length==3){
		$("#choose_next").attr("disabled",true);
		$(".duplicate").removeClass("duplicate");
		$("#game_over").show();
		$("#game_over").html("<h4 style='color:red;'>Round Over, Please click Clear and then Restart.</h4>");
	}
	
	//show button to clear and start over
	$("#clear").show();

   }