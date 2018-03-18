function resize_quiz(){
    
        if($(window).width()>780){
            if(!already_checked){
                $(".form").css("height", "12rem");
            }else{
                $(".form").css("height", "22rem");                
            };
            console.log("resize");
        }else{
            $(".form").css("height", "auto");
            
        };
}

function change_infos(destinataire, infos){
    /*Change texte
    $(".contact__infos #texte").html(infos[destinataire-1].texte);
    
    //Change image
    var chemin = $(".contact__infos__image").attr("src").split("/");
    chemin = chemin.slice(0, -1).join('/');
    $(".contact__infos__image").attr("src", chemin+"/"+infos[destinataire-1].image);
    
    //Change nom
    $(".contact__infos #name").html(infos[destinataire-1].name);
    
    //Change tel
    $(".contact__infos #tel").html("Tel: "+infos[destinataire-1].tel);
    
    //Change poste
    $(".contact__infos #poste").html("Poste "+infos[destinataire-1].poste);*/
    
    $(".contact__infos").hide();
    $(".contact__infos#"+destinataire).show();
        
}

function extend_gallery(){
    if($("#galerie--extend").next("button").html()=="Voir plus"){

        $("#galerie--extend").animate({height:"100%"},2000);
        $("#galerie--extend").css("overflow","auto");
        $("#galerie--extend").next("button").html("Voir moins");
    }else{
        if($("#galerie--extend").next("button").html()=="Voir moins"){

            $("#galerie--extend").css("overflow","hidden");
            $("#galerie--extend").animate({height:"20rem"},2000);
            $("#galerie--extend").next("button").html("Voir plus");
        }
    }
}

$(document).ready(function () {

    
    var infos = [
        {
            name: "Sylvain Lamoureux",
            tel: "(418) 659-6600",
            poste: "6662",
            texte: "Pour obtenir de plus amples informations sur la formation, contactez la coordination.",
            image: "_amorneau_stages.jpg"
            
        },
        {
            name: "Audrey Morneau-Gagnon",
            tel: "(418) 659-6600",
            poste: "6668",
            texte: "Pour obtenir de plus amples informations sur les stages, contactez le responsable des stages.",
            image: "_amorneau_stages.jpg"
            
        },
        {
            name: "Benoit Frigon",
            tel: "(418) 659-6600",
            poste: "6662",
            texte: `Pour obtenir de plus amples informations sur le programme "Etudiant d'un jour", contactez le responsable du programme.`,
            image: "_amorneau_stages.jpg"
            
        }
    ];
    
    var state_menu = false;
    var questions = [""];
    var oui = [""];
    var non = [""];
    
    
    $.getJSON('wp-content/themes/theme-complet/quiz/json/quiz2.json', function(data) {
        console.log(data);
        console.log(data.quiz.questions.question[0].texteQuestion);
        
        questions[0] = data.quiz.questions.question[0].texteQuestion;
        questions[1] = data.quiz.questions.question[1].texteQuestion;
        questions[2] = data.quiz.questions.question[2].texteQuestion;
        questions[3] = data.quiz.questions.question[3].texteQuestion;
        questions[4] = data.quiz.questions.question[4].texteQuestion;
        console.log(questions);
        
        oui[0] = data.quiz.questions.question[0].reponses.reponse[0].texteReponse;
        oui[1] = data.quiz.questions.question[1].reponses.reponse[0].texteReponse;
        oui[2] = data.quiz.questions.question[2].reponses.reponse[0].texteReponse;
        oui[3] = data.quiz.questions.question[3].reponses.reponse[0].texteReponse;
        oui[4] = data.quiz.questions.question[4].reponses.reponse[0].texteReponse;
        console.log(oui);
        
        non[0] = data.quiz.questions.question[0].reponses.reponse[1].texteReponse;
        non[1] = data.quiz.questions.question[1].reponses.reponse[1].texteReponse;
        non[2] = data.quiz.questions.question[2].reponses.reponse[1].texteReponse;
        non[3] = data.quiz.questions.question[3].reponses.reponse[1].texteReponse;
        non[4] = data.quiz.questions.question[4].reponses.reponse[1].texteReponse;
        console.log(non);
    });
    
    mesReponses = [null,null,null,null,null];
    $(".form__button").hide();
    //Initialize quiz
    $(".form__nav__item:first-child input").prop("checked", true);
    
    $(".form__nav__item input").on("click  touchstart",function(){
        if(this.checked){
            
            num = this.value;
            num = num.split("", -1);
            num = num[1];
            $("span.replaceQuestion").text(num);
            $("p.replaceQuestion").text(questions[num-1]);
            $("input[id^='reponse']").each(function(){
                $(this).attr('name', "Q"+num);
            });
            $("p#replaceReponse").text("");
            //Initialize reponse quiz
            $("input[id='reponse1']").prop("checked", false);
            $("input[id='reponse2']").prop("checked", false);
            already_checked = false;
            resize_quiz();
            $(".form__button").hide();
            if(mesReponses[num]!=null){
                
                resize_quiz();
                $("input[id='reponse"+mesReponses[num]+"']").prop("checked", true);
                already_checked = true;
                $(".form__button").show();
                if(mesReponses[num-1]==1){
                    reponse = oui[num-1];
                }else{
                    reponse = non[num-1];
                }
                reponse = reponse.split(",");
                reponse[0] = "<span class='texte--bold'>"+reponse[0]+"</span>";
                reponse = reponse.join(",");
                $("p#replaceReponse").html(reponse);
            }
            num = parseInt(num);
            $("button#nav_prev").attr('data-to', "Q"+(num-1));
            console.log(num-1+" , "+(num+1));
            $("button#nav_next").attr('data-to', "Q"+(num+1));
            resize_quiz();
        };
        
    });
    
    
    //Initialize reponse quiz
    $("input[id='reponse1']").prop("checked", false);
    $("input[id='reponse2']").prop("checked", false);
    already_checked = false;
    
    $("input[id^='reponse']").on("click  touchstart",function(){
        resize_quiz();
        if(!already_checked){
        
            if(this.checked){
                reponse = this.value;
                num = this.name;
                num = num.split("", -1);
                num = num[1];
                if(reponse == "Oui"){
                    reponse=oui[num-1];
                    mesReponses[num] = 1;
                }else{
                    if(reponse == "Non"){
                        reponse=non[num-1];
                        mesReponses[num] = 2;
                    }
                }
                reponse = reponse.split(",");
                reponse[0] = "<span class='texte--bold'>"+reponse[0]+"</span>";
                reponse = reponse.join(",");
                $("p#replaceReponse").html(reponse);
            };
            already_checked = true;
        }else{
            /*num = this.name;
            num = num.split("", -1);
            num = num[1];
            if(mesReponses[num] == 1){
                reponse=oui[num-1];
            }else{
                if(mesReponses[num] == 2){
                    reponse=non[num-1];
                    
                }
            }
            reponse = reponse.split(",");
            reponse[0] = "<span class='texte--bold'>"+reponse[0]+"</span>";
            reponse = reponse.join(",");
            $("p#replaceReponse").html(reponse);*/
            return false;
        };
        resize_quiz();
        $(".form__button").show();
    });
    
    $("button[id^='nav_']").on("click  touchstart",function(){
        nav = this.id;
        nav = nav.split("nav_").join('');
        
        num = $(this).attr("data-to");
        num = num.split("", -1);
        num = num[1];
        
        num = parseInt(num);
        if(num<=0){
            num=1;
        }else{
            if(num>=6){
                num=5;
            };
        };
        $("span.replaceQuestion").text(num);
        $("p.replaceQuestion").text(questions[num-1]);
        $("input[id^='reponse']").each(function(){
            $(this).attr('name', "Q"+num);
        });
        
        $(".form__nav__item:nth-child("+num+") input").prop("checked", true);
        $("p#replaceReponse").text("");
        //Initialize reponse quiz
        $("input[id='reponse1']").prop("checked", false);
        $("input[id='reponse2']").prop("checked", false);
        already_checked = false;
        resize_quiz();
        
        $(".form__button").hide();
        
            if(mesReponses[num]!=null){
                
                $("input[id='reponse"+mesReponses[num]+"']").prop("checked", true);
                already_checked = true;
                $(".form__button").show();
                if(mesReponses[num]==1){
                    reponse = oui[num-1];
                }else{
                    reponse = non[num-1];
                }
                reponse = reponse.split(",");
                reponse[0] = "<span class='texte--bold'>"+reponse[0]+"</span>";
                reponse = reponse.join(",");
                $("p#replaceReponse").html(reponse);
                resize_quiz();
            }
        
        $("button#nav_prev").attr('data-to', "Q"+(num-1));
        console.log(num-1+" , "+(num+1));
        $("button#nav_next").attr('data-to', "Q"+(num+1));
    });
    
    $(".form__button--rounded").on("click  touchstart",function(){
        console.log("refresh");
        mesReponses = [null,null,null,null,null];

        //Initialize quiz
        $(".form__nav__item:first-child input").prop("checked", true);
        
        //Initialize reponse quiz
        $("input[id='reponse1']").prop("checked", false);
        $("input[id='reponse2']").prop("checked", false);
        already_checked = false;
        
        resize_quiz();
        $(".form__button").hide();
        
        
        $("input[id^='reponse']").each(function(){
            $(this).attr('name', "Q1");
        });
        $("p#replaceReponse").text("");
        $("span.replaceQuestion").text("1");
        $("p.replaceQuestion").text(questions[0]);
        
        
        $("button#nav_prev").attr('data-to', "Q1");
        $("button#nav_next").attr('data-to', "Q1");
    });
    
    $(window).on("resize", function(){
        resize_quiz();
    });
    
    
    /// Smooth Scroll ///
    // Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .on("click  touchstart",function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top-100
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
    
    var input_name = $("#destinataire option:selected").attr("value");
        if(input_name=="coordination"){
            change_infos("1", infos);
        }else{
            if(input_name=="stages"){
                change_infos("2", infos);
            }else{
                if(input_name=="etudiant_dun_jour"){
                change_infos("3", infos);
            }else{
                change_infos("1", infos);
            }
        }
        }
    
    $("select#destinataire").change(function(){
        var input_name = $("#destinataire option:selected").attr("value");
        if(input_name=="coordination"){
            change_infos("1", infos);
        }else{
            if(input_name=="stages"){
                change_infos("2", infos);
            }else{
                if(input_name=="etudiant_dun_jour"){
                change_infos("3", infos);
            }
        }
        }
    });
    
    $("#extend_gallery__button").on("click tap", function(){
        extend_gallery();
    });
    
    /*$(".galerie__project__link").on("tap", function(e){
        e.preventDefault();
    });*/

});