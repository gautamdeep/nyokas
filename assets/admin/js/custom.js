$(document).ready(function() {
    // resetcheckbox();
    var base_url = 'http://localhost/natamobile/';

    $('#selecctall').click(function(event) {  
        if (this.checked) { 
            $('.checkbox1').each(function() { 
                this.checked = true;               
            });
        } else {
            $('.checkbox1').each(function() { 
                this.checked = false;                      
            });
        }
    });

    $("#ins_all").on('click', function(e) {
        e.preventDefault();
        var checkValues = $('.checkbox1:checked').map(function()
        {
            //alert($(this).attr('sim-username'));
            var a =[];
                // a.push([AgentID: $(this).attr('sim-AgentID'), Username: $(this).attr('sim-Username'),Agent: $(this).attr('sim-Agent')]);
            a.push({
                AgentID: $(this).attr('sim-AgentID'), 
                Agent: $(this).attr('sim-Agent'), 
                SimStatus: $(this).attr('sim-SimStatus'), 
                MSISDN: $(this).attr('sim-MSISDN'), 
                IMSI: $(this).attr('sim-IMSI'), 
                ICCID: $(this).attr('sim-ICCID'), 
                FirstUsed: $(this).attr('sim-FirstUsed'), 
                LastUsed: $(this).attr('sim-LastUsed'), 
                LiveBalance: $(this).attr('sim-LiveBalance'), 
                UserId: $(this).attr('sim-UserId'), 
                UserStatus: $(this).attr('sim-UserStatus'), 
                Username:  $(this).attr('sim-Username'),
                Password: $(this).attr('sim-Password'), 
                PIN1: $(this).attr('sim-PIN1'), 
                PIN2: $(this).attr('sim-PIN2'), 
                CustomerId: $(this).attr('sim-CustomerId'), 
                CustomerStatus: $(this).attr('sim-CustomerStatus'), 
                AccountId: $(this).attr('sim-AccountId')
            });
            return a;

        }).get();
        // $.each( checkValues, function( i, val ) {
        //     $.each(val, function(j, ue){
        //         alert(ue);
        //     });
        // });
        $.ajax({
            url: base_url+'admin/insertCSV',
            type: 'post',
            data: {csvs: checkValues},
        }).done(function(msg) {
            var message = JSON.parse(msg);
            if (message.status==200) {
              alertify.success(message.message);
            } else {
              alertify.error(message.message);
            }
            window.setTimeout(function(){window.location.href = base_url+'admin/sims';},2500)
            // $("#respose").html(data);
            // $('#selecctall').attr('checked', false);
        });
    });
});
