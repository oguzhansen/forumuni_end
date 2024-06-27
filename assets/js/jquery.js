$(document).ready(function(){

    $("#unamecontrol").keyup(function(){
        var uname = $(this).val();
        $.ajax({
            type: "POST",
            url: "ajax.php?option=unamecont",
            timeout: 5000,
            data:{"uname":uname},
            success: function(e)
            {
                $(".ucontrol").html(e);
            },
            error: function( objAJAXRequest, strError ){
                alert("Hata! Tip: " + strError);
            }
        });
    });

    $('a[rel="yukleme"]').click(function(e){
        pageurl = $(this).attr('href');
        $.ajax({url:pageurl,success: function(data){
            $('body').html(data).find("body").html();
            $('head').html(data).find("head").html();
        }});        
        if(pageurl!=window.location){
            window.history.pushState({path:pageurl},'',pageurl);    
        }
        return false;  
    });

    $(window).bind('popstate', function() {
        $.ajax({url:location.pathname,success: function(data){
            $('body').html(data).find("body").html();
            $('head').html(data).find("head").html();
        }});
    });

    $('.yukarikaydir').click(function () {
        $("html, body").animate({
            scrollTop: 175
        }, 600);
        return false;
    });

    setTimeout(function() { 
        $(".acilis").css("opacity", "0");
        $(".acilis").css("pointer-events","none");
    }, 300);

    setTimeout(function() { 
        $(".acilisp").css("opacity", "0");
        $(".acilisp").css("pointer-events","none");
    }, 500);

    /**
     * BİLDİRİM OKU
     */
    $(".bildioku").click(function(){
        $.ajax({
        url: "ajax.php?option=oku",
        timeout: 5000,
        success: function(e)
        {
            
        }
    });
    });

    /**
     * SORU CEVAP FİLTRE
     */
    $("#scfilter").change(function(){
        var filter = $("#scfilter").val();
        
        if(filter == 1)
        {
            $(".genel").css("display","block");
            $(".uni").css("display","none");
            $(".bol").css("display","none");
            $(".fak").css("display","none");
            $(".yurtlar").css("display","none");
            $(".unicheck").css("display","none");
            $(".fakcheck").css("display","none");
            $(".bolcheck").css("display","none");
        }

        else if(filter == 2)
        {
            $(".genel").css("display","none");
            $(".uni").css("display","block");
            $(".bol").css("display","none");
            $(".fak").css("display","none");
            $(".yurtlar").css("display","none");
            $(".unicheck").css("display","block");
            $(".fakcheck").css("display","none");
            $(".bolcheck").css("display","none");
            $("#unim").change(function(){
                if ($(this).is(":checked")) 
                {
                    $(".uni").css("display","none");
                    $(".unimegore").css("display","block");
                }
                else
                {
                    $(".uni").css("display","block");
                    $(".unimegore").css("display","none");
                }
            });
        }

        else if(filter == 3)
        {
            $(".genel").css("display","none");
            $(".uni").css("display","none");
            $(".fak").css("display","block");
            $(".bol").css("display","none");
            $(".yurtlar").css("display","none");
            $(".unicheck").css("display","none");
            $(".fakcheck").css("display","block");
            $(".bolcheck").css("display","none");
            $("#fakm").change(function(){
                if ($(this).is(":checked")) 
                {
                    $(".fak").css("display","none");
                    $(".fakimagore").css("display","block");
                }
                else
                {
                    $(".fak").css("display","block");
                    $(".fakimagore").css("display","none");
                }
            });
        }

        else if(filter == 4)
        {
            $(".genel").css("display","none");
            $(".uni").css("display","none");
            $(".fak").css("display","none");
            $(".bol").css("display","block");
            $(".yurtlar").css("display","none");
            $(".unicheck").css("display","none");
            $(".fakcheck").css("display","none");
            $(".bolcheck").css("display","block");
            $("#bolm").change(function(){
                if ($(this).is(":checked")) 
                {
                    $(".bol").css("display","none");
                    $(".bolumegore").css("display","block");
                }
                else
                {
                    $(".bol").css("display","block");
                    $(".bolumegore").css("display","none");
                }
            });
        }

        else if(filter == 5)
        {
            $(".genel").css("display","none");
            $(".uni").css("display","none");
            $(".bol").css("display","none");
            $(".fak").css("display","none");
            $(".yurtlar").css("display","block");
            $(".unicheck").css("display","none");
            $(".fakcheck").css("display","none");
            $(".bolcheck").css("display","none");
        }
    });


    /**
     * ANA SAYFA FİLTRE
     */
    $("#anafilter").change(function(){
        var value = $(this).val();

        switch(value)
        {
            case "1":
                $(".enyeni").css("display","block");
                $(".unimbol").css("display","none");
                $(".unimhak").css("display","none");
            break;

            case "2":
                $(".enyeni").css("display","none");
                $(".unimbol").css("display","none");
                $(".unimhak").css("display","block");
            break;

            case "3":
                $(".enyeni").css("display","none");
                $(".unimbol").css("display","block");
                $(".unimhak").css("display","none");
            break;
        }
    });


    /**
     * SORU PAYLAŞIM KATEGORİ
     */
    $("#kategori").change(function(){
        var val = $(this).val();
        switch(val)
        {
            case "0":
                $(".uniac").css("display","none");
                if($(".soru").val() != "")
                {
                    $('#paylas').prop('disabled', true);
                }
                $(".hata").css("display","block");
                $(".fakac").css("display","none");
                $(".bolac").css("display","none");
                $("#MemberUnis").val(0);
                $("#MemberFaks").val(0);
                $("#MemberBolums").val(0);
            break;

            case "1":
                $(".uniac").css("display","none");
                $(".hata").css("display","none");
                $(".fakac").css("display","none");
                $(".bolac").css("display","none");
                $("#MemberUnis").val(0);
                $("#MemberFaks").val(0);
                $("#MemberBolums").val(0);
            break;

            case "2":
                $(".uniac").css("display","block");
                $(".hata").css("display","none");
                $(".fakac").css("display","none");
                $(".bolac").css("display","none");
                $("#MemberUnis").val(0);
                $("#MemberFaks").val(0);
                $("#MemberBolums").val(0);
            break;

            case "3":
                $(".uniac").css("display","block");
                $(".hata").css("display","none");
                $(".fakac").css("display","block");
                $(".bolac").css("display","none");
                $("#MemberUnis").val(0);
                $("#MemberFaks").val(0);
                $("#MemberBolums").val(0);
            break;

            case "4":
                $(".uniac").css("display","none");
                $(".hata").css("display","none");
                $(".fakac").css("display","none");
                $(".bolac").css("display","block");
                $("#MemberUnis").val(0);
                $("#MemberFaks").val(0);
                $("#MemberBolums").val(0);
            break;

            case "5":
                $(".uniac").css("display","none");
                $(".hata").css("display","none");
                $(".fakac").css("display","none");
                $(".bolac").css("display","none");
                $("#MemberUnis").val(0);
                $("#MemberFaks").val(0);
                $("#MemberBolums").val(0);
            break;
        }
    });


    /**
     * PAYLAŞIM YAPMA
     */
    
    $("#sendPostMob").on('click',function(){
        $(".uniac").css("display","none");
        $(".hata").css("display","none");
        $(".uniyorum").css("display","none");
        $(".fakac").css("display","none");
        $(".bolac").css("display","none");
        $(".postButton").css("display","block");
        $(".paylasim").css("display","block");
        $(".pop").css("display","flex");
        $(".pop").css("align-items","center");
        $(".pop").css("justify-content","center");
        $('html, body').css({overflow: 'hidden',height: '100%'});
        $("#pop-container").css("opacity","1");
        $("#pop-container").css("pointer-events","auto");
        $("#sendPostMob").css("display","none");
    });

    $("#sendPostPopup").on('click',function(){
        $(".uniac").css("display","none");
        $(".hata").css("display","none");
        $(".uniyorum").css("display","none");
        $(".fakac").css("display","none");
        $(".bolac").css("display","none");
        $(".paylasim").css("display","block");
        $(".postButton").css("display","block");
        bildirimkapa();
        arakapa();
        $(".pop").css("display","flex");
        $(".pop").css("align-items","center");
        $(".pop").css("justify-content","center");
        $("#pop-container").css("opacity","1");
        $('html, body').css({overflow: 'hidden',height: '100%'});
        $("#pop-container").css("pointer-events","auto");
    });

    $("#closePostPopup").on('click',function(){
        $("#kategori").val(0);
        $("#pop-container").css("opacity","0");
        $(".uniyorum").css("display","none");
        $("#pop-container").css("pointer-events","none");
        $(".soruPop").css("display","none");
        $(".paylasim").css("display","none");
        $(".duzenle").css("display","none");
        $(".postButton").css("display","none");
        $(".soruduzenlepop").css("display","none");
        $(".aniduzenlepop").css("display","none");
        $(".silpop").css("display","none");
        $("#sendPostMob").css("display","block");
        $(".uniinfoekle").css("display","none");
        $(".sikayetpop").css("display","none");
        $("#MemberUnis").val(0);
        $("#MemberFaks").val(0);
        $("#MemberBolums").val(0);
        $(".postButton").css("display","block");
        $(".silpop").css("display","none");
        $(".aniPop").css("display","none");
        $('html, body').css({overflow: 'auto',height: 'auto'});
        $(".aniButton").css("display","block");
        $('#uniyor input[type="radio"]').prop('checked', false);
        $("#uniyorumtext").val(null);
    });

    /**
    * PORFİL AYAR
    */
    $(".profilayarac").click(function(){
        $("#closePostPopup").css("display","none");
        $(".profilayar").css("display","block");
        $("#pop-container").css("opacity","1");
        $('html, body').css({overflow: 'hidden',height: '100%'});
        $("#pop-container").css("pointer-events","auto");
    });

    /**
    * ŞİKAYET
    */


    $(".sikayet").click(function(){
        const sikayetbtn = this;
        var sikayetid = $(sikayetbtn).attr("title");

        $.ajax({
            type: "POST",
            url:"ajax.php?option=sikayet",
            timeout: 5000,
            data:{"sid":sikayetid},
            success: function(e)
            {
                $(".sikayetpop").css("display","block");
                $("#closePostPopup").css("display","none");
                $('html, body').css({overflow: 'hidden',height: '100%'});
                $("#pop-container").css("opacity","1");
                $("#pop-container").css("pointer-events","auto");
            },
            error: function( objAJAXRequest, strError ){
                alert("Hata! Tip: " + strError);
            }
        });
    });

    $(".sikayetcevap").click(function(){
        const sikayetbtn = this;
        var sikayetid = $(sikayetbtn).attr("title");

        $.ajax({
            type: "POST",
            url:"ajax.php?option=sikayetcevap",
            timeout: 5000,
            data:{"csid":sikayetid},
            success: function(e)
            {
                $(".sikayetpop").css("display","block");
                $("#closePostPopup").css("display","none");
                $('html, body').css({overflow: 'hidden',height: '100%'});
                $("#pop-container").css("opacity","1");
                $("#pop-container").css("pointer-events","auto");
            },
            error: function( objAJAXRequest, strError ){
                alert("Hata! Tip: " + strError);
            }
        });
    });

    $(".silcvpbtn").click(function()
    {
        const silbtn = this;
        var silid = $(silbtn).attr("title");

        $(".cevapsil").val(silid);
        $("#closePostPopup").css("display","none");
        $(".cevapsilpop").css("display","block");
        $('html, body').css({overflow: 'hidden',height: '100%'});
        $("#pop-container").css("opacity","1");
        $("#pop-container").css("pointer-events","auto");
    });

    $(".silbtn").click(function()
    {
        const silbtn = this;
        var silid = $(silbtn).attr("title");

        $(".sil").val(silid);
        $("#closePostPopup").css("display","none");
        $(".silpop").css("display","block");
        $('html, body').css({overflow: 'hidden',height: '100%'});
        $("#pop-container").css("opacity","1");
        $("#pop-container").css("pointer-events","auto");
    });

    $(".cevapsil").click(function(){
        const silindibtn = this;
        var silindiid = $(silindibtn).val();

        $.ajax({
            type: "POST",
            url:"ajax.php?option=cevapsil",
            timeout: 5000,
            data:{"cevapsilid":silindiid},
            success: function(e)
            {
                $("#closePostPopup").css("display","none");
                $(".cevapsilpop").css("display","none");
                $(".silindipop").css("display","block");
                $('html, body').css({overflow: 'hidden',height: '100%'});
                $("#pop-container").css("opacity","1");
                $("#pop-container").css("pointer-events","auto");
            },
            error: function( objAJAXRequest, strError ){
                alert("Hata! Tip: " + strError);
            }
        });
    });

    $(".sil").click(function(){
        const silindibtn = this;
        var silindiid = $(silindibtn).val();

        $.ajax({
            type: "POST",
            url:"ajax.php?option=sil",
            timeout: 5000,
            data:{"silid":silindiid},
            success: function(e)
            {
                $("#closePostPopup").css("display","none");
                $(".silpop").css("display","none");
                $(".silindipop").css("display","block");
                $('html, body').css({overflow: 'hidden',height: '100%'});
                $("#pop-container").css("opacity","1");
                $("#pop-container").css("pointer-events","auto");
            },
            error: function( objAJAXRequest, strError ){
                alert("Hata! Tip: " + strError);
            }
        });
    });

    $(".silkapat").click(function(){
        $(".silindipop").css("display","none");
        $(".profilayar").css("display","none");
        $('html, body').css({overflow: 'auto',height: 'auto'});
        $("#pop-container").css("opacity","0");
        $("#closePostPopup").css("display","block");
        $("#pop-container").css("pointer-events","none");
        window.location.reload();
    });

    $(".sozkapat").click(function(){
        $(".kullanicisozlesme").css("display","none");
        $(".gizliliksozlesme").css("display","none");
        $("#closePostPopup").css("display","block");
        $('html, body').css({overflow: 'auto',height: 'auto'});
        $("#pop-container").css("opacity","0");
        $("#pop-container").css("pointer-events","none");
    });

    $(".sillkapat").click(function(){
        $(".silpop").css("display","none");
        $('html, body').css({overflow: 'auto',height: 'auto'});
        $("#pop-container").css("opacity","0");
        $("#closePostPopup").css("display","block");
        $("#pop-container").css("pointer-events","none");
    });

    $(".sikayetkapat").click(function(){
        $(".sikayetpop").css("display","none");
        $('html, body').css({overflow: 'auto',height: 'auto'});
        $("#pop-container").css("opacity","0");
        $("#closePostPopup").css("display","block");
        $("#pop-container").css("pointer-events","none");
        window.location.reload();
    });

    $(".anisil").click(function(){
        const silbtn = this;
        var anisilid = $(silbtn).attr("title");

        $.ajax({
            type: "POST",
            url:"ajax.php?option=anisil",
            timeout: 5000,
            data:{"anisilid":anisilid},
            success: function(e)
            {
                $("#closePostPopup").css("display","none");
                $(".silpop").css("display","block");
                $('html, body').css({overflow: 'hidden',height: '100%'});
                $("#pop-container").css("opacity","1");
                $("#pop-container").css("pointer-events","auto");
            },
            error: function( objAJAXRequest, strError ){
                alert("Hata! Tip: " + strError);
            }
        });
    });

    $(".duzenlea").click(function(){
        const dznbtn = this;
        var dznbtnid = $(dznbtn).attr("title");

        var dznbtnsoru = $(dznbtn).attr("value");

        $(".dznhidden").val(dznbtnid);
        $(".sorutext").val(dznbtnsoru);

        $(".soruduzenlepop").css("display","block");
        $('html, body').css({overflow: 'hidden',height: '100%'});
        $("#pop-container").css("opacity","1");
        $("#pop-container").css("pointer-events","auto");

    });

    $(".aniduzenle").click(function(){
        
        const anidznbtn = this;
        var anidznbtnid = $(anidznbtn).attr("title");

        var dznbtnani = $(anidznbtn).attr("value");

        $(".anidznhidden").val(anidznbtnid);
        $(".anitext").val(dznbtnani);

        $(".aniduzenlepop").css("display","block");
        $('html, body').css({overflow: 'hidden',height: '100%'});
        $("#pop-container").css("opacity","1");
        $("#pop-container").css("pointer-events","auto");

    });

    $(".sikayetani").click(function(){
        const sikayetbtn = this;
        var sikayetid = $(sikayetbtn).attr("title");

        $.ajax({
            type: "POST",
            url:"ajax.php?option=sikayetani",
            timeout: 5000,
            data:{"asid":sikayetid},
            success: function(e)
            {
                $("#closePostPopup").css("display","none");
                $(".sikayetpop").css("display","block");
                $('html, body').css({overflow: 'hidden',height: '100%'});
                $("#pop-container").css("opacity","1");
                $("#pop-container").css("pointer-events","auto");
            },
            error: function( objAJAXRequest, strError ){
                alert("Hata! Tip: " + strError);
            }
        });
    });

    $(".ksozlesme").click(function(){

        $(".kullanicisozlesme").css("display","block");
        
        $("#closePostPopup").css("display","none");
        $('html, body').css({overflow: 'hidden',height: '100%'});
        $("#pop-container").css("opacity","1");
        $("#pop-container").css("pointer-events","auto");

    });

    $(".gsozlesme").click(function(){

        $(".gizliliksozlesme").css("display","block");
        
        $("#closePostPopup").css("display","none");
        $('html, body').css({overflow: 'hidden',height: '100%'});
        $("#pop-container").css("opacity","1");
        $("#pop-container").css("pointer-events","auto");

    });

    $(".sikayetyorum").click(function(){
        const sikayetbtn = this;
        var sikayetid = $(sikayetbtn).attr("title");

        $.ajax({
            type: "POST",
            url:"ajax.php?option=sikayetyorum",
            timeout: 5000,
            data:{"yorumsikayetid":sikayetid},
            success: function(e)
            {
                $("#closePostPopup").css("display","none");
                $(".sikayetpop").css("display","block");
                $('html, body').css({overflow: 'hidden',height: '100%'});
                $("#pop-container").css("opacity","1");
                $("#pop-container").css("pointer-events","auto");
            },
            error: function( objAJAXRequest, strError ){
                alert("Hata! Tip: " + strError);
            }
        });
    });

    $("#soruSend").on('click', function(){
        $(".soruPop").css("display","block");
        $(".pop").css("display","block");
        $(".pop").css("align-items","start");
        $(".pop").css("justify-content","flex-start");
        $('html, body').css({overflow: 'hidden',height: '100%'});
        $(".postButton").css("display","none");
    });

    $("#aniSend").on('click', function(){
        $(".aniPop").css("display","block");
        $(".pop").css("display","block");
        $(".pop").css("align-items","start");
        $(".pop").css("justify-content","flex-start");
        $('html, body').css({overflow: 'hidden',height: '100%'});
        $(".postButton").css("display","none");
    });

    $(".ani").keyup(function(){
        if($(".ani").val() != ""){
            $('#anipaylas').prop('disabled', false);
        }
        else
        {
            $('#anipaylas').prop('disabled', true);
        }
    });

    $(".soru").keyup(function(){
        if($(".soru").val() != "" && $("#kategori").val() == 1 || $("#kategori").val() == 5)
        {
            $('#paylas').prop('disabled', false);
        }

        else if($("#kategori").val() == 2)
        {
            if($("#MemberUnis").val() != 0)
            {
                if($(".soru").val() != "" && $("#kategori").val() != 0){
                    $('#paylas').prop('disabled', false);
                }
                else
                {
                    $('#paylas').prop('disabled', true);
                }
            }
            else
            {
                $('#paylas').prop('disabled', true);
            }
        }

        else if($("#kategori").val() == 3)
        {
            if($("#MemberFaks").val() != 0)
            {
                if($(".soru").val() != "" && $("#kategori").val() != 0){
                    $('#paylas').prop('disabled', false);
                }
                else
                {
                    $('#paylas').prop('disabled', true);
                }
            }
            else
            {
                $('#paylas').prop('disabled', true);
                $("#MemberUnis").val(0);
                $("#MemberFaks").val(0);
            }
        }

        else if($("#kategori").val() == 4)
        {
            if($("#MemberBolums").val() != 0)
            {
                if($(".soru").val() != "" && $("#kategori").val() != 0){
                    $('#paylas').prop('disabled', false);
                }
                else
                {
                    $('#paylas').prop('disabled', true);
                }
            }
            else
            {
                $('#paylas').prop('disabled', true);
            }
        }

        else
        {
            $('#paylas').prop('disabled', true);
        }
    });


    /**
    * YANIT LİSTELEME
    */

    $('.yanitac').click(function() { 
        $(this).next('.yanitlar').css("display","block");
    });
    
    /**
    * REZLEME
    */
    $('.rezle').click(function(){
        const rezle_button = this;
        var soruid = $(this).attr("title");
        
        $.ajax({
            type:"POST",
            url:"ajax.php?option=rezle",
            timeout: 5000,
            data:{"soruid":soruid},
            success: function(e)
            {
                $(rezle_button).html(e);
            },
            error: function( objAJAXRequest, strError ){
                alert("Hata! Tip: " + strError);
            }
        })
    });

    $("#MemberBoluma").change(function(){
        if($("#MemberUnia").val() != 0 && $("#MemberFaka").val() != 0 && $("#MemberBoluma").val() != 0)
        {
            $("#uniekleinfo").prop("disabled", false);
        }
        else
        {
            $("#uniekleinfo").prop("disabled", true);
        }
    });
    
    /**
    * ÜNİVERSİTE YORUM
    */

    $("#yorumac").on('click', function(){
        $(".uniyorum").css("display","block");
        $("#pop-container").css("opacity","1");
        $("#pop-container").css("pointer-events","auto");
    });

    $("#uninfo").on('click', function(){
        $(".uniinfoekle").css("display","block");
        $("#pop-container").css("opacity","1");
        $("#pop-container").css("pointer-events","auto");
    });

    $("#uniyorumtext").keyup(function(){
        if($("#uniyorumtext").val() != "" && ("input[name=mem]:checked").length > 0){
            $('#uniyorumpaylas').prop('disabled', false);
        }
        else
        {
            $('#uniyorumpaylas').prop('disabled', true);
        }
    });

    /**
    * PROFİLİ DÜZENLE
    */

    $("#duzenleac").on('click', function(){
        $(".duzenle").css("display","block");
        $('html, body').css({overflow: 'hidden',height: '100%'});
        $("#pop-container").css("opacity","1");
        $("#pop-container").css("pointer-events","auto");
        bildirimkapa();
        arakapa();
    });


    /**
    * ARAMA
    */
    $(".aradesk").keyup(function(){
        var value = $(this).val()
        var data = "value="+value	
        $.ajax({
            
            type: "POST",
            url: "ajax.php?option=kesfet",
            timeout: 5000,
            data: data,
            success: function(e){
            
                if(value == '')
                {
                    $("#sonuclar").html("<center><p>Sonuçlar burada gözükecek.</p></center>");
                    
                }
                
                else
                {
                    $("#sonuclar").css("display","block");
                    $('#sonuclar').html(e);
                }
            },
            error: function( objAJAXRequest, strError ){
                alert("Hata! Tip: " + strError);
            }
        })
    });

    $(".aramoba").click(function(){
        $(".aramoba").css("width","85%");
        $(".aramobiptal").css("opacity","1");
        $(".aramobiptal").css("visibility","visible");
        $("#sonuclarmob").css("display","block");
    });

    $(".aramobiptal").click(function(){
        $(".aramoba").css("width","100%");
        $(".aramobiptal").css("opacity","0");
        $(".aramobiptal").css("visibility","hidden");
        $("#sonuclarmob").css("display","none");
        $(".aramoba").val("");
        $("#sonuclarmob").html("<center><p>Sonuçlar burada gözükecek.</p></center>");
    });

    $(".aramoba").keyup(function(){
        var value = $(this).val()
        var data = "value="+value	
        $.ajax({
            
            type: "POST",
            url: "ajax.php?option=kesfetara",
            timeout: 5000,
            data: data,
            success: function(e){
            
                if(value == '')
                {
                    $("#sonuclarmob").html("<center><p>Sonuçlar burada gözükecek.</p></center>");
                }
                
                else
                {
                    $("#sonuclarmob").css("display","block");
                    $('#sonuclarmob').html(e);
                }
            },
            error: function( objAJAXRequest, strError ){
                alert("Hata! Tip: " + strError);
            }
        })
    });


    /**
    * FAKÜLTE ÇEKME
    */

    $('#MemberUni').change(function(){
        var uniid = $(this).val();
        alert("sdfh");
        $.ajax(
        {
            type:"POST",
            url:"ajax.php?option=fakulteliste",
            timeout: 1000,
            data:{"uni":uniid},
            success: function(e)
            {
                $('#MemberFak').html("aaa");
            },
            error: function( objAJAXRequest, strError ){
                alert("Hata! Tip: " + strError);
            }
        })
    });

    $('#MemberUnia').change(function(){
        var uniid = $(this).val();
        $.ajax(
        {
            type:"POST",
            url:"ajax.php?option=fakulteliste",
            data:{"uni":uniid},
            success: function(e)
            {
                $('#MemberFaka').html(e);
            }
        });
    });

    $('#MemberUnis').change(function(){
        var uniid = $(this).val();
        $.ajax(
        {
            type:"POST",
            url:"ajax.php?option=fakulteliste",
            data:{"uni":uniid},
            success: function(e)
            {
                $('#MemberFaks').html(e);
            }
        });
    });
    

    /**
    * ÜNİLİ DEĞİL
    */

    $("#unilidegil").change(function(){
        if ($(this).is(':checked')) {
            $("#unidegil").css("display","none");
            $("#MemberUni").val(0);
            $("#MemberFak").val(0);
            $("#MemberBolum").val(0);
        }
        else
        {
            $("#unidegil").css("display","block");
        }
    })

    /**
    * ANI / SORU LİSTELEME
    */

    $("#sorularuser").on('click',function(){
        $(".anilaruser").css("display","none");
        $(".sr").addClass("buttonprfactive");
        $(".sr").removeClass("buttonprfunactive");
        $(".an").addClass("buttonprfunactive");
        $(".an").removeClass("buttonprfactive");
        $(".sorularuser").css("display","block");
    });

    $("#anilaruser").on('click',function(){
        $(".anilaruser").css("display","block");
        $(".an").addClass("buttonprfactive");
        $(".an").removeClass("buttonprfunactive");
        $(".sr").addClass("buttonprfunactive");
        $(".sr").removeClass("buttonprfactive");
        $(".sorularuser").css("display","none");
    });


    /**
    * YANITLAMA
    */
    $(".yanitla").click(function(){
        var cevapid = $(this).attr("title");
        $.ajax({
            type: "POST",
            url:"ajax.php?option=yanitla",
            timeout: 5000,
            data:{"cid":cevapid},
            success: function(e)
            {
                $("#cevap").html(e);
            },
            error: function( objAJAXRequest, strError ){
                alert("Hata! Tip: " + strError);
            }
        });
    });
    

    $("#cevaptxt").keyup(function(){
        if($("#cevaptxt").val() != ""){
            $('#cevapbtn').prop('disabled', false);
        }
        else
        {
            $('#cevapbtn').prop('disabled', true);
        }
    });



    /**
    * KOPYALAMA
    */

    $(".panoyakopyala").on('click',function(){
        var title = $(this).attr("title");
        $(this).children(".copyto").css("opacity","1");
        setTimeout(function() { 
            $(".copyto").css("opacity","0");
        }, 1000);
        var temp = $("<input>")
        $("body").append(temp);
        temp.val(title).select();
        document.execCommand("copy");
        temp.remove();
    });

    setInterval(loadDoc, 5000);

});


function loadDoc() {
        $("#noti_number").load("ajax.php?option=bildirim");
        $("#noti_numbera").load("ajax.php?option=bildirim");
    }

$(function() { // Dropdown toggle
    $('.dropmenuac').click(function() { 
        $(this).next('.dropmenulist').slideToggle();
    });

    $(document).click(function(e) 
    { 
        var target = e.target; 
        if (!$(target).is('.dropmenuac') && !$(target).parents().is('.dropmenuac')) 
        //{ $('.dropdown').hide(); }
        { $('.dropmenulist').slideUp(); }
    });
});

function bildirimac(){
    arakapa();
    $(".bildirimlerpanel").css("width","25%");
    $(".bildirimlerpanel").css("opacity","100");
    $(".nav-link span").addClass("spandisplay");
    $(".logo").addClass("logodisplayb");
    $(".logo").removeClass("logo");
    $(".logo-text").addClass("logodisplay");
    $(".bildirimkapa").css("display","block");
    $(".bildirimac").css("display","none");
    $(".nav").addClass("navwidth");
    $(".bildirimlerpanel").css("transition","0.3s");
    $('html, body').css({overflow: 'hidden',height: '100%'});
    $.ajax({
        url: "ajax.php?option=bildirimlerdesk",
        timeout: 5000,
        success: function(e)
        {
            $(".bildirimlerpanel").html(e);
        }
    });
    $.ajax({
        url: "ajax.php?option=oku",
        timeout: 5000,
        success: function(e)
        {
            
        }
    });
}

function bildirimkapa(){
    $(".bildirimlerpanel").css("width","0");
    $(".bildirimlerpanel").css("opacity","0");
    $(".nav-link span").removeClass("spandisplay");
    $(".logodisplayb").addClass("logo");
    $(".logo").removeClass("logodisplayb");
    $(".logo-text").removeClass("logodisplay");
    $(".nav").removeClass("navwidth");
    $(".bildirimac").css("display","block");
    $(".bildirimkapa").css("display","none");
    $('html, body').css({overflow: 'auto',height: 'auto'});
}

function araac(){
    bildirimkapa();
    $(".aradeskdiv").css("opacity","100");
    $(".aradeskdiv").css("width","25%");
    $(".nav-link span").addClass("spandisplay");
    $(".arakapa").css("display","block");
    $(".logo").addClass("logodisplayb");
    $(".logo").removeClass("logo");
    $(".logo-text").addClass("logodisplay");
    $(".araac").css("display","none");
    $(".nav").addClass("navwidth");
    $('html, body').css({overflow: 'hidden',height: '100%'});
    $(".aradeskdiv").css("transition","0.3s");
}

function arakapa(){
    $(".aradeskdiv").css("width","0");
    $(".aradeskdiv").css("opacity","0");
    $(".nav-link span").removeClass("spandisplay");
    $(".araac").css("display","block");
    $(".logodisplayb").addClass("logo");
    $(".logo").removeClass("logodisplayb");
    $(".logo-text").removeClass("logodisplay");
    $(".arakapa").css("display","none");
    $(".nav").removeClass("navwidth");
    $(".aradesk").val("");
    $('html, body').css({overflow: 'auto',height: 'auto'});
    $("#sonuclar").css("display","none");
}