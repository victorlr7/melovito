(function(a){a.fn.quovolver=function(g,f){if(!g){g=500}if(!f){f=6000}var e=(g*4);if(e>(f)){f=e}var d=a(this),c=a(this).filter(":first"),h=a(this).filter(":last"),b='<div id="jf-quote_wrap"></div>';a(this).wrapAll(b);a(this).hide();a(c).show();a(this).parent().css({height:a(c).height()});setInterval(function(){if(a(h).is(":visible")){var i=a(c);var j=a(i).height()}else{var i=a(d).filter(":visible").next();var j=a(i).height()}a(d).filter(":visible").fadeOut(g);setTimeout(function(){a(d).parent().animate({height:j},g)},g);if(a(h).is(":visible")){setTimeout(function(){a(c).fadeIn(g*2)},g*2)}else{setTimeout(function(){a(i).fadeIn(g)},g*2)}},f)}})(jQuery);