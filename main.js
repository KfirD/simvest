$(document).ready(function() {
	$("form").submit(function() {
		alert(buy);
		return false;
	});
	$("input[name='buy']").click(function() {
		amount = $("input[name='amount']").val();
		submit_form(amount, "buy");
	});
	$("input[name='sell']").click(function() {
		amount = $("input[name='amount']").val();
		submit_form(amount, "sell");
	});
	setInterval("update_data()", 5000);
});

function submit_form(amount, action) {
	$.post("update_data.php", {amount:amount, action:action}, function(data) {
		$("div.error").text(data.error);
		$("img.big_chart").attr("src", data.big_chart);
		$("img.little_chart").attr("src", data.little_chart);
		$("p.current_price span").text(data.current_price);
		$("li.money span").text(data.money);
		$("li.stocks span").text(data.stocks);
	}, "json");	
}

function update_data() {
	$.getJSON("update_data.php", function(data) {
		$("div.error").text(data.error);
		$("img.big_chart").attr("src", data.big_chart);
		$("img.little_chart").attr("src", data.little_chart);
		$("p.current_price span").text(data.current_price);
		$("li.money span").text(data.money);
		$("li.stocks span").text(data.stocks);
		$("title").text("COAL $"+data.current_price);
	});
}