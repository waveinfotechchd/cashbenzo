<!DOCTYPE html>
@if(getcong('under_maintenane')!=0)
	<title>Under Maintenane</title>
<div style="margin: 0px auto; width: 52%;"><img src="{{ URL::asset('site_assets/under-maintenance.jpg') }}"></div>
{!!die()!!}
@endif
<html lang="en">
<head>
  <title>@yield('head_title', getcong('site_name'))</title>
	<meta charset="utf-8">
	<meta name="description" content="@yield('head_description', getcong('site_description'))" />
	<meta name="keyword" content="@yield('site_keyword', getcong('site_keyword'))" />
	<meta property="og:type" content="article" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:title" content="@yield('head_title',  getcong('site_name'))" />
	<meta property="og:description" content="@yield('head_description', getcong('site_description'))" />
	<meta property="og:keyword" content="@yield('site_keyword', getcong('site_keyword'))" />
	<meta property="og:image" content="@yield('head_image', url('/upload/logo.png'))" />
	<meta property="og:url" content="@yield('head_url', url('/'))" />
	<meta name="developer" content="Mohit Goyal" />
	<link rel="stylesheet" href="{{ URL::asset('site_assets/css/bootstrap.min.css') }}">
<!--	<link rel="stylesheet" href="{{ URL::asset('site_assets/css/style1.css') }}">-->
	<link rel="stylesheet" href="{{ URL::asset('site_assets/css/cashbenjostyle.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('site_assets/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('admin_assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css') }}"> 
	<link rel="stylesheet" href="{{ URL::asset('site_assets/css/live-search.css') }}"> 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--[if IE]>
        <link href="css/ie.css" rel="stylesheet" type="text/css">
    <![endif]-->
	<script src="{{ URL::asset('site_assets/js/jquery.js') }}"></script>
<style>
.head-search .twitter-typeahead {
    background: #fff;
    margin-top: 5px;
}
.head-search .input-group-addon {
   background-color: transparent;
}
</style>
</head>
<body  id="page-top" class="pushmenu-push">
@include("includes.header")

@yield("content")

@include("includes.footer")

<script src="{{ URL::asset('site_assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('site_assets/js/custom.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('site_assets/js/jquery.firstVisitPopup.js') }}"></script>
<script src="{{ URL::asset('admin_assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script>
$(function () {
	$('.datepicker').datepicker({
		 format: "dd-mm-yyyy"
	});
	$('.dateofbirth').datepicker({
		 format: "dd-mm-yyyy",
		 endDate:new Date()
	});

	$('#showLoginPopUp').firstVisitPopup({
		cookieName : 'homepage',
		showAgainSelector: '.showLoginPopUp'
	});
});
loader = '<div class="md-modal md-show">\
	<img src="https://www.couponraja.in/coupons_local/uipages/images/loading-img.gif" alt="">\
	<h3 class="ldclr">Please Wait...</h3>\
	</div>';
function readmore(id) {
        $('#hdt2' + id).slideToggle(500);
        $('#readmore' + id).hide();
        $('#readless' + id).show();
        $('#description' + id).hide();
        $('#desclong' + id).show();
        return false;
    }
function readless(id) {
	$('#hdt2' + id).slideToggle(500);
	$('#readless' + id).hide();
	$('#readmore' + id).show();
	$('#description' + id).show();
	$('#desclong' + id).hide();
	return false
}

function favourite(store,type,action){
	if(action=="add"){
		button = '<a class="btn btn-default" href="javascript:;" onclick="favourite(\''+store+'\',\'Favourite\',\'remove\')"><i class="fa fa-heart"></i> Favourite</a>';
	}else{
		button = '<a class="btn btn-default" href="javascript:;" onclick="favourite(\''+store+'\',\'Favourite\',\'add\')"><i class="fa fa-heart-o"></i> Favourite</a>';
	}
	$.get('/ajax/watchlist',{
		action:action,
		type: type,
		lmd_id: "fav",
		store: store
	}, function (data){
		if(data!="false"){
			//alert(data);
			$(".votee-coupn").text(data+' Votes');
			$("#fav_"+store).html(button);
		}
	});
}
function watchlist(store,lmd_id,type,action){
	if(action=="add"){
		button = '<a href="javascript:;" onclick="watchlist(\''+store+'\',\''+lmd_id+'\',\''+type+'\',\'remove\')"><i class="fa fa-heart"></i></a>';
	}else{
		button = '<a href="javascript:;" onclick="watchlist(\''+store+'\',\''+lmd_id+'\',\''+type+'\',\'add\')"><i class="fa fa-heart-o"></i></a>';
	}
	$.get('/ajax/watchlist',{
		action:action,
		type: type,
		lmd_id: lmd_id,
		store: store
	}, function (data){
		if(data=="true"){
			$("#heart"+lmd_id).html(button);
		}
	});
}	
function coponwallet(store,lmd_id,type,action){

        $.get('/ajax/savecupon',{
                        action:action,
                        type: type,
                        lmd_id: lmd_id,
                        store: store
                }, function (data){
                        if(data=="true"){
						$(".save"+"."+lmd_id+" a").html("SAVED");
						$(".save"+"."+lmd_id+" a").attr("disabled");
                        }
                });
}
$(document).on('ready', function() {
$("#form-filters").on('submit',(function(e) {
	e.preventDefault();
		$.ajax({
			url: "/search/filters",
			type: "POST",
			data: new FormData(this), 
			contentType: false,      
			cache: false,             
			processData:false,    
			success: function(data){
				$('#products').html(data);
				$( "#loading-img" ).html('');
				$( "#pagination" ).hide();
				if(data==""){
				$('#products').html('<h3 style="text-align:center">Offers Not Found!</h3>');
				}
			}
		});
	}));
});

$( ".form-submit" ).click(function() {
  $( "#loading-img" ).html(loader);
  $( "#form-filters" ).submit();
});
$(document).ready(function() {
    $(".numeric_valid").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
		numeric_valid = $(".numeric_valid").val().length;
		//alert(numeric_valid);
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105) || (numeric_valid>9)) {
            e.preventDefault();
        }
    });

$( ".edit-profile" ).click(function() {
  $( ".hide_pro" ).show();
  $( ".show_pro" ).hide();
});
$( ".merchant_name" ).keydown(function() {
	$('.get_store_link').val('');
	var value = $(".merchant_name").val();
  $.get('/ajax/get-stores?key=' + value, function(data) {
	  if(data!=""){
        $('.get_store_link').val(data);
        $('#results').show();
	  }
    });
});
});
</script>

<script type="text/javascript" src="{{ URL::asset('site_assets/js/typeahead.min.js') }}"></script>
<script>
$(document).ready(function(){
$('input.typeahead').typeahead({
	name: 'typeahead',
	remote:'/finddb?key=%QUERY',
	limit : 10
});
});
</script>
<script type="text/javascript">
 $('.typeahead').on('typeahead:selected', function(e){
 e.target.form.submit();
});
</script>
@include("includes.modal")
<div id="loading-img"></div>
<style>
.md-modal {
  height: auto;
  left: 50%;
  max-width: 630px;
  min-width: 165px;
  position: fixed;
  top: 50%;
  transform: translateX(-50%) translateY(-50%);
  visibility: visible;
  z-index: 9999;
}
#showLoginPopUp{
  display: none;
  z-index: 500;
  position: fixed;
  width: 50%;
  left: 23%;
  top: 15%;
}
</style>
  </body>
  </html>
