       
       /*      <!------ topnav script --------------------------------------------------> */
         
                 
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

         
     /*    <!------ end topnav script --------------------------------------------------> */
         
      /*   <!---------- script for select form ------------------> */
         
        
var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);


     /*    <!----------- end of script select form ----------------->*/

      /*       <!----- fade in script -------------------------------------------------->     */
        
        
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})

     /*   <!-----end fade in script -------------------------------------------------->*/

         /** mega menu *************************************/


$(document).ready(function(){
var isopen=0;


  if(window.innerWidth<800)
  {
    var heights=[];
    $('.mega').each(function(){
      heights['#'+$(this).attr('id')] = $(this).innerHeight();
      $(this).css('max-height','0');
    })
    $('.nav-item').hover(function(){
            var ths=$(this);

      setTimeout(function(){    $(ths.attr('data-target')).css({'max-height'  :  heights[ths.attr('data-target')]   });           },500);

    }, function(){

    $($(this).attr('data-target')).css({'max-height':'0px'});
  });

    $('.nav-item').each(function(){
      $(this).append($($(this).attr('data-target')));
    })
  }
  else
  {
      $('.mega').hide();
    $('.nav-item').hover(function(){
      var ths=$(this);
      setTimeout(function(){   $(ths.attr('data-target')).fadeIn('fast');  $(ths.attr('data-target')).css({'top':'100%'});     },500);

    }, function(){
      var ths=$(this);
      setTimeout(function(){
        if(isopen==0)
        {
          $(ths.attr('data-target')).fadeOut('slow');
          $(ths.attr('data-target')).css({'top':'200%'});
        }

        },300);

    });

    $('.mega').hover(function(){
      isopen=1;
    },function(){
      $('.mega').fadeOut('slow');
        isopen=0;
    });

  }
});
