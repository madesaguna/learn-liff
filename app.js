function searchVoter(id) {
    $.ajax({
        type : 'POST',
        url : 'search.php',
        data : {'nik': id},
        dataType : 'json',
        success : function(data) {
            var result = data;
            console.log(result);
            $('#result').html(result.msg);
            let message = result.msg;

            // if registered
            if(result.status === 'registered' && result.error === false) {
                sendMessageToLine(message);
            }
        }
    });
}

// show form registration
function showRegistration() {
    $('#result').empty();
    $('#registrasi-tab').tab('show')
}

// close form registration
function closeRegistrationForm() {
    $('#result').empty();
    $('#home-tab').tab('show');
}

// send message to LINE
function sendMessageToLine(message) {
    if (!liff.isInClient()) {
        sendAlertIfNotInClient();
    } else {
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

(function(){
    $( "#tanggal_lahir" ).datepicker({
        dateFormat : 'yy-mm-dd',
        changeMonth : true,
        changeYear : true,
        yearRange: '-100y:c+nn',
        maxDate: '-1d'
    });
   // do jQuery
   jQuery('#form-identity-check').on('submit', function(e) {
       e.preventDefault();
       let id = $(this).find('#searchNik').val();
       searchVoter(id);
   });

   // registration
   jQuery('#form-identity-register').on('submit', function (e) {
       e.preventDefault();
       $.ajax({
           type : 'POST',
           url : 'simpan.php',
           data : $(this).serialize(),
           dataType : 'json',
           success : function(data) {
               console.log(data.msg);
               let message = data.msg;

               $('#form-identity-register').find('.form-group').removeClass('error-form');
               $('#form-identity-register').find('.form-group').find('.error').empty().hide();

               if(data.error === true && data.status === 'unregistered') {
                    $.each(message, function (a,b) {
                        console.log(a);
                        $('#'+a).closest('.form-group').addClass('error-form');
                        $('#'+a).siblings('.error').html(b).show();
                    })
               }


               if(data.status === 'registered' && data.error === false) {
                   sendMessageToLine(message);
               }
               $('#result').html(message);
           }
       });
   })
})(jQuery)
