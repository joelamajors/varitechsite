var active_color = '#AAA'; 
var inactive_color = '#444'; 

if (typeof console == "undefined" || typeof console.log == "undefined")
	var console={log: function(){}};

if(typeof String.prototype.trim !== 'function') {
  String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, ''); 
  }
}

$(document).ready(function() {

	doDropdowns();
	//  $('#rotator').nivoSlider({effect:'fade', animSpeed:1000,   pauseTime: 6500, pauseOnHover:false, directionNav:false, controlNav:false});
	fixPlaceholders($(":input:not([type=button]):not([type=submit])")); 
	

});



function doDropdowns()
{
	jQuery.easing.def = "easeInOutSine";
	$(".dropdown").each(function() {
			var config = {
			    sensitivity: 10,
			    interval: 50,
			    over: function(){$(this).children("div").slideDown(350);},
			    timeout:250,
			    out: function(){$(this).children("div").slideUp(350);}
			};
			$(this).hoverIntent(config); 		
	});
}




function supports_input_placeholder() {
  var i = document.createElement('input');
  return 'placeholder' in i;
}

var default_values = new Array();

function fixPlaceholders($inputs)
{
	var tt = supports_input_placeholder();
	if (!tt) {
		$inputs.each(function() {
			$t=$(this);
			$t.val($t.attr("placeholder"));
			default_values[$t.attr("id")] = $t.attr("placeholder");
		});
		$inputs.css("color",inactive_color);
		$inputs.live("focus",function(){placeholder_focus(this)});
	}
}

function placeholder_focus(ii)
{
  if (!default_values[ii.id]) {
    default_values[ii.id] = ii.value;
  }
  if (ii.value == default_values[ii.id]) {
    ii.value = '';
    ii.style.color = active_color;
  }
  $(ii).blur(function() {
    if (ii.value == '') {
      ii.style.color = inactive_color;
      ii.value = default_values[ii.id];
    }
  });
}
