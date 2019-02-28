require([
    'jquery',   //gọi thư viện cần dùng vào đây
], function ($) {
    $(function () {
       $("#vote").click(function(event) {
       	var a = $('.radio.poll_vote').prop("checked", true).val();
            //alert(a);
       });
       
       // $.ajax({
       // 	url: '/path/to/file',
       // 	type: 'default GET (Other values: POST)',
       // 	dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
       // 	data: {param1: 'value1'},
       // })
       // .done(function() {
       // 	console.log("success");
       // })
       // .fail(function() {
       // 	console.log("error");
       // })
       // .always(function() {
       // 	console.log("complete");
       // });
       


    });
});
