$(document).ready(function(){
	count_keyword();
	count_post();
	count_blog();
	count_category();
	count_design();
	count_arbitrary();
})

// keyword
function count_keyword(){
	$.ajax({
		url: base_url+'blogs/count_keyword',
		data:{},
		type:'post',
		async:true,
		success:function(res){
			$('#count_keyword').html(res.count);
		},
		dataType:'json'
	});
}

// post
function count_post(){
	$.ajax({
		url: base_url+'blogs/count_post',
		data:{},
		type:'post',
		async:true,
		success:function(res){
			$('#count_post').html(res.count);
		},
		dataType:'json'
	});
}

// blog
function count_blog(){
	$.ajax({
		url: base_url+'blogs/count_blog',
		data:{},
		type:'post',
		async:true,
		success:function(res){
			$('#count_blog').html(res.count);
		},
		dataType:'json'
	});
}
	
// category
function count_category(){
	$.ajax({
		url: base_url+'blogs/count_category',
		data:{},
		type:'post',
		async:true,
		success:function(res){
			$('#count_category').html(res.count);
		},
		dataType:'json'
	});
}
	
// design
function count_design(){
	$.ajax({
		url: base_url+'blogs/count_design',
		data:{},
		type:'post',
		async:true,
		success:function(res){
			$('#count_design').html(res.count);
		},
		dataType:'json'
	});	
}
	
// arbitrary
function count_arbitrary(){
	$.ajax({
		url: base_url+'blogs/count_arbitrary',
		data:{},
		type:'post',
		async:true,
		success:function(res){
			$('#count_arbitrary').html(res.count);
		},
		dataType:'json'
	});	
}