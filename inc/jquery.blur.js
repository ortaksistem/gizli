(function($) {
    $.fn.extend({
        blurimage: function() {


new_width= new Array();
new_height = new Array();
horz=new Array(3,4,4,3,4,6,5,2,7,5);
vert= new Array(2,3,1,6,5,4,3,6,5,4);
opacity=new Array(0.1,0.1,0.2,0.2,0.1,0.3,0.2,0.2,0.2,0.1);



$(this).each(function() {


new_width[0]=$(this).children().width()+3;
new_height[0]=$(this).children().height()+4;

new_width[1]=$(this).children().width()-2;
new_height[1]=$(this).children().height()+4;

new_width[2]=$(this).children().width()+1;
new_height[2]=$(this).children().height()-1;
new_width[3]=$(this).children().width()+2;
new_height[3]=$(this).children().height()+1;
new_width[4]=$(this).children().width()-2;
new_height[4]=$(this).children().height()+3;

new_width[5]=$(this).children().width()+3;
new_height[5]=$(this).children().height()-2;

new_width[6]=$(this).children().width()+2;
new_height[6]=$(this).children().height()+4;

new_width[7]=$(this).children().width()+2;
new_height[7]=$(this).children().height()-1;
new_width[8]=$(this).children().width()+3;
new_height[8]=$(this).children().height()+1;
new_width[9]=$(this).children().width()-2;
new_height[9]=$(this).children().height()+3;			

for(i=0;i<10;i++){
	
if ($.browser.webkit||$.browser.opera) {
//fix it!!! ie8 too!!!
	$(this).width($(this).children().width());
	
blur_html ='<div class="blurer"><span style="position:absolute; margin-left:+'+0+'px; margin-top:-'+new_height[i]+'px;filter:alpha(opacity=20);-khtml-opacity: 0.2; opacity:'+opacity[i]+';" >';
blur_html+='<img src='+$(this).children().attr('src')+' width="'+new_width[i]+'" height="'+new_height[i]+'" vspace="'+vert[i]+'" hspace="'+horz[i]+'"/></span></div>'; 
 }	
else if ($.browser.msie||$.browser.mozilla) {
	$(this).width($(this).children().width());

if(jQuery.browser.version=='8.0') {
blur_html ='<div class="blurer"><span style="position:absolute; margin-left:-'+0+'px; margin-top:-'+new_height[i]+'px;filter:alpha(opacity=20);-khtml-opacity: 0.2; opacity:'+opacity[i]+';" >';
blur_html+='<img src='+$(this).children().attr('src')+' width="'+new_width[i]+'" height="'+new_height[i]+'" vspace="'+vert[i]+'" hspace="'+horz[i]+'"/></span></div>'; 
}
else {
blur_html ='<div class="blurer"><span style="position:absolute; margin-left:-'+new_width[i]/2+'px; margin-top:-'+new_height[i]+'px;filter:alpha(opacity=20);-khtml-opacity: 0.2; opacity:'+opacity[i]+';" >';
blur_html+='<img src='+$(this).children().attr('src')+' width="'+new_width[i]+'" height="'+new_height[i]+'" vspace="'+vert[i]+'" hspace="'+horz[i]+'"/></span></div>'; 	
}
}
$(this).append(blur_html);
//remove blur

/*
$(this).children().hover(function(){$(this).remove('.blurer')});
*/

  
}




 });


 

 

        }
		
		
    });
})(jQuery);

 

