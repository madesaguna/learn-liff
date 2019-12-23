function searchVoter(id) {
    $.ajax({
        type : 'POST',
        url : 'search.php',
        data : {'nik': id},
        dataType : 'json',
        success : function(data) {
            $('#result').html(data.msg);
            let message = data.msg;
            if (!liff.isInClient()) {
                sendAlertIfNotInClient();
            } else {
                if(data.status == 'registered') {
                    liff.sendMessages([{
                        'type': 'text',
                        'text': message,
                    }]).then(function () {
                        window.alert('Message sent');
                    }).catch(function (error) {
                        window.alert('Error sending message: ' + error);
                    });
                }
            }
        }
    });
}

(function(){
   // do jQuery
   jQuery('#form-identity-check').on('submit', function(e) {
       e.preventDefault();
       let id = $(this).find('#searchNik').val();
       searchVoter(id);
   });

   jQuery('#form-identity-register').on('submit', function (e) {
       e.preventDefault();
       $.ajax({
           type : 'POST',
           url : 'simpan.php',
           data : $(this).serialize(),
           dataType : 'json',
           success : function(data) {
               $('#result').html(data.msg);
               let message = data.msg;
               if (!liff.isInClient()) {
                   sendAlertIfNotInClient();
               } else {
                   if(data.status == 'registered') {
                       liff.sendMessages([{
                           'type': 'text',
                           'text': message,
                       }]).then(function () {
                           window.alert('Message sent');
                       }).catch(function (error) {
                           window.alert('Error sending message: ' + error);
                       });
                   }
               }
           }
       });

   })
})(jQuery)