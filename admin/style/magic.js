function updateSubMenu(currentsubmenu) {
	$(".SubMenu").fadeOut(function() {
		$.get("templates/submenu.cfm", {currentsubmenu: currentsubmenu}, function(data) {
			$(".SubMenu").html(data);
			$(".SubMenu").fadeIn();
		});
	});
}

function updateContent(filetoget) {
	$(".MainContentBox").fadeOut(function() {
		$.get("Menu/" + filetoget, function(data) {
			$(".MainContentBox").html(data);
			$(".MainContentBox").fadeIn();
		});
	});
}

function searchUsers(username, email, searchip) {
	$(".MainContentBox").fadeOut(function() {
		$.get("functions/usersearch.cfm", { username : username, email : email, searchip : searchip }, function(data) {
			$(".MainContentBox").html(data);
			$(".MainContentBox").fadeIn();
		});
	});
}

function searchRooms(owner, roomname) {
	$(".MainContentBox").fadeOut(function() {
		$.get("functions/roomsearch.cfm", { owner : owner, roomname : roomname }, function(data) {
			$(".MainContentBox").html(data);
			$(".MainContentBox").fadeIn();
		});
	});
}

function searchUser(userid) {
	$(".MainContentBox").fadeOut(function() {
		$.get("functions/useroverview.cfm", { userid : userid }, function(data) {
			$(".MainContentBox").html(data);
			$(".MainContentBox").fadeIn();
		});
	});
}

function articleComposergotostep1() {
	$(".MainContentBox").fadeOut(function() {
		$('#Step3').removeClass('selected');
		$('#Step2').removeClass('selected');
		$('#Step1').addClass('selected');
		$('#ErrorMessage').hide();
		$('#Content2').hide();
		$('#Content3').hide();
		$('#Content1').show();
		$('.btn-prev').addClass('buttonDisabled');
		$('.btn-next').removeClass('buttonDisabled');
		$('.btn-finish').addClass('buttonDisabled');
		$(".MainContentBox").fadeIn();
	});
}

function articleComposergotostep2() {
	if ($('#ArticleTitle').val() != "" && $('#ArticleDescription').val() != "" && $('#ArticleContent').val() != "") {
		$(".MainContentBox").fadeOut(function() {
			$('#Step1').removeClass('selected');
			$('#Step3').removeClass('selected');
			$('#Step2').addClass('selected');
			$('#ErrorMessage').hide();
			$('#Content1').hide();
			$('#Content3').hide();
			$('#Content2').show();
			$('.btn-prev').removeClass('buttonDisabled');
			$('.btn-next').addClass('buttonDisabled');
			$('.btn-finish').addClass('buttonDisabled');
			$(".MainContentBox").fadeIn();
		});
	}
	else {
		$('#ErrorMessage').removeClass('green');
		$('#ErrorMessage').addClass('red');
		$('#ErrorMessage').html('<span>All fields must be completed</span>');
		$('#ErrorMessage').fadeIn();
	}
}

function articleComposergotostep3(element) {
	if ($('#ArticleTitle').val() != "" && $('#ArticleDescription').val() != "" && $('#ArticleContent').val() != "") {
		$(".MainContentBox").fadeOut(function() {
			$(element).fadeTo("slow", 0.5);
			$('#ArticleImage').val($(element).attr('src'));
			$('#Step1').removeClass('selected');
			$('#Step2').removeClass('selected');
			$('#Step3').addClass('selected');
			$('#ErrorMessage').hide();
			$('#Content1').hide();
			$('#Content2').hide();
			$('#Content3').html('<h2>' + $('#ArticleTitle').val() + '</h2><strong>' + $('#ArticleDescription').val() + '</strong><br /><br /><p>' + $('#ArticleContent').val() + '</p>');
			$('#Content3').show();
			$('.btn-finish').removeClass('buttonDisabled');
			$('.btn-prev').removeClass('buttonDisabled');
			$('.btn-next').addClass('buttonDisabled');
			$(".MainContentBox").fadeIn();
		});
	}
	else {
		$('#ErrorMessage').removeClass('green');
		$('#ErrorMessage').addClass('red');
		$('#ErrorMessage').html('<span>All fields must be completed</span>');
		$('#ErrorMessage').fadeIn();
	}
}

function articleComposerSubmit() {
	if (!$('.btn-finish').hasClass('buttonDisabled')) {
		$('.btn-finish').addClass('buttonDisabled');
		$.post('functions/submitarticle.cfm', {title: $('#ArticleTitle').val(), description: $('#ArticleDescription').val(), story: $('#ArticleContent').val(), promoimage: $('#ArticleImage').val()}, function(data) {
			$('#ErrorMessage').removeClass('red');
			$('#ErrorMessage').addClass('green');
			$('#ErrorMessage').html('<span>Article successfully posted!</span>');
			$('#ErrorMessage').fadeIn();
		});
	}
}

function goAway(element) {
	$(element).fadeOut();
}