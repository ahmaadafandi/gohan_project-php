// ==============navbar=================
  function openNav() {
    document.getElementById("mySidenav").style.width = "80%";
    $('#nav').addClass('backdrop-nav');
    $('#backdrop-body').addClass('backdrop-body');
    $('html').addClass('disabled');
}
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    $('#nav').removeClass('backdrop-nav');
    $('#backdrop-body').removeClass('backdrop-body');
    $('html').removeClass('disabled');    
}
// ================Filter==================
  function openFilter() {
    document.getElementById("filter-body").style.height = "100%";
    document.getElementById("action-filtering").style.display = "block";
    $('html').addClass('disabled');
}
function closeFilter() {
    document.getElementById("filter-body").style.height = "0";
    document.getElementById("action-filtering").style.display = "none";
    $('html').removeClass('disabled');    
}

  function openShort() {
    document.getElementById("short-body").style.height = "100%";
    document.getElementById("action-filtering").style.display = "block";
    $('html').addClass('disabled');
}
function closeShort() {
    document.getElementById("short-body").style.height = "0";
    document.getElementById("action-filtering").style.display = "none";
    $('html').removeClass('disabled');    
}
// ==============number==============
$(document).on('click', '.number-spinner button', function () {    
	var btn = $(this),
		oldValue = btn.closest('.number-spinner').find('input').val().trim(),
		newVal = 0;
	
	if (btn.attr('data-dir') == 'up') {
		newVal = parseInt(oldValue) + 1;
	} else {
		if (oldValue > 1) {
			newVal = parseInt(oldValue) - 1;
		} else {
			newVal = 1;
		}
	}
	btn.closest('.number-spinner').find('input').val(newVal);
});
// ==============clicktab==============
$(document).ready(function() {
$(".btn-pref .btn").click(function () {
    $(".btn-pref .btn").removeClass("btn-active").addClass("btn-non-active");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).removeClass("btn-non-active").addClass("btn-active");   
});
});
// ============image upload===========
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}
$("#imgInp").change(function() {
  readURL(this);
});
// ============sidebar admin===========
$(document).ready(function(){
$(".push_menu").click(function(){
     $(".wrapper").toggleClass("active");
	});
});
// ============chat===========
$(document).on('click', '.head-msg', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $('.icon-msg').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $('.icon-msg').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
    }
});
// =============chat=================
$(function(){
$("#addClass").click(function () {
  $('#sidebar_secondary').addClass('popup-box-on');
    });
  
    $("#removeClass").click(function () {
  $('#sidebar_secondary').removeClass('popup-box-on');
    });
})
//============Chat Admim=============
$(function(){
    $(".heading-compose").click(function() {
      $(".side-two").css({
        "left": "0"
      });
    });

    $(".newMessage-back").click(function() {
      $(".side-two").css({
        "left": "-100%"
      });
    });
})
// =============eye-pass=============
$(".eye-pass").click(function() 
{
  if ($(this).data('val') == "1") 
  {
     $("#password").prop('type','text');
     $(".eye-pass").attr("class","fa fa-eye-slash fa-icon eye-pass");
     $(this).data('val','0');
  }
  else
  {
     $("#password").prop('type', 'password');
     $(".eye-pass").attr("class","fa fa-eye fa-icon eye-pass");
     $(this).data('val','1');
  }
});