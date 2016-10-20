$(document).ready(function () {

    //No Kad Pengenalan

    var real_tahun = real_umur = tmp_hari = tmp_bulan = '';
    $("#MemberNric").on('keyup', function (e) {
        var noic = $(this).val();
        console.log(noic);

        tmp_hari = noic.substr(4, 2);
        tmp_bulan = noic.substr(2, 2);
        tmp_tahun = noic.substr(0, 2);

        real_tahun = fun_tahun_lahir(tmp_tahun);
        real_umur = fun_umur(tmp_hari, tmp_bulan, real_tahun);

        $('#MemberAge').val(real_umur);
        $('#MemberYear').val(real_tahun);
        if (tmp_hari && tmp_bulan && real_tahun) {
            $('#MemberDob').val(tmp_hari + '-' + tmp_bulan + '-' + real_tahun);
        } else {
            $('#MemberDob').val();
        }
        /**
         * Dapatkan Tarikh Lahir
         */
        function fun_tahun_lahir(tmp_tahun) {
            if (tmp_tahun >= 00 && tmp_tahun <= 30) {
                tmp_tahun = 2000 + parseInt(tmp_tahun);
            }
            if (tmp_tahun >= 31 && tmp_tahun <= 99) {
                tmp_tahun = 1900 + parseInt(tmp_tahun);
            }
            return tmp_tahun;
        }

        /**
         * Dapatkan Umur
         */
        function fun_umur(tmp_hari, tmp_bulan, real_tahun) { // birthday is a date
            var birthday = real_tahun + '/' + tmp_bulan + '/' + tmp_hari;

            var dob = new Date(birthday);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            if (age) {
                return age;
            } else {
                return 0;
            }

        }
    });


    //Datepicker
    $('#MemberDate').datetimepicker({
        format: 'DD-MM-YYYY',
        maxDate: new Date()
    });
    $('#MemberDop').datetimepicker({
        format: 'DD-MM-YYYY',
        maxDate: new Date()
    });


    //AJAX
    $('#ClaimNricError').hide();
    $("#ClaimNric").on('focusout', function (e) {
        if ($(this).val().length == 12) {
            $('#ClaimNricError').hide();
            var value = $(this).val();
            $.post(site_url + "members/ajax_member", {key: "nric", val: value})
                .done(function (res) {
                    var member = JSON.parse(res);
                    if (member.result || member.data.name) {
                        $("#ClaimName").val(member.data.name);
                        $("#nirc-success").show();
                    } else {
                        alert('Data Not Found');
                    }
                });
        } else {
            alert('No Kad Pengenalan tidak lengkap');
        }
    });


    //this calculates values automatically
    calculateSum();

    $(".amount").on("keyup", function () {
        calculateSum();
    });
    function calculateSum() {
        var sum = 0;
        //iterate through each textboxes and add the values
        $(".amount").each(function () {

            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                var amount = $(this).data("amount");
                sum += parseInt(this.value) * parseInt(amount);
                $(this).css("background-color", "#FEFFB0");
            }
            else if (this.value.length != 0) {
                $(this).css("background-color", "red");
            }
        });

        $("input.sum").val(sum.toFixed(2));
    }

});