function searchVoter(id) {
    $.ajax({
        type : 'POST',
        url : 'search.php',
        data : {'nik': id},
        dataType : 'json',
        success : function(data) {
            $('#search_result').html(data.msg);
        }
        
    });
}

(function(){
   // do jQuery
   $('#form_cari').on('submit', function(e){
       e.preventDefault();
       var id = $('#nik').val();
       searchVoter(id);
   });
})(jQuery)