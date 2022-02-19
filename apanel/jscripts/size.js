function _resizer(){  
    var textarea = 'skin', repeat = 500, cof = 5; 
  
    textarea = document.getElementById(textarea);  
    textarea.onfocus = do_resize;  
    textarea.onblur = stop_resize;  
  
    function countLines(strtocount) {  
        var hard_lines = 0, str = strtocount.split("\n"), hard_lines = str.length, letter_width = textarea.clientHeight/textarea.rows*cof/100, chars_in_line = textarea.clientWidth/letter_width, lines = 0, temp = 0;  
        for(i=0; i<=(hard_lines-1); i++){ 
            temp = str[i].length / chars_in_line;  
            if(temp>0) lines += temp;  
        }     
  
        return lines+hard_lines;  
    }  
    function do_resize() {  
        if(!textarea){ return; }  
        var new_rows = countLines(textarea.value);  
        if( textarea.rows!=new_rows+1 ) textarea.rows = new_rows;  
        timeout_resize = setTimeout(function(){ do_resize(); }, repeat);  
    }  
  
    function stop_resize(){ clearTimeout(timeout_resize); }  
}  
  
if (window.addEventListener)  
    window.addEventListener("load", _resizer, false);  
else if (window.attachEvent)  
    window.attachEvent("onload", _resizer);  


function _resizer2(){  
    var textarea = 'fstyle', repeat = 500, cof = 10; 
  
    textarea = document.getElementById(textarea);  
    textarea.onfocus = do_resize;  
    textarea.onblur = stop_resize;  
  
    function countLines(strtocount) {  
        var hard_lines = 0, str = strtocount.split("\n"), hard_lines = str.length, letter_width = textarea.clientHeight/textarea.rows*cof/100, chars_in_line = textarea.clientWidth/letter_width, lines = 0, temp = 0;  
        for(i=0; i<=(hard_lines-1); i++){ 
            temp = str[i].length / chars_in_line;  
            if(temp>0) lines += temp;  
        }     
  
        return lines+hard_lines;  
    }  
    function do_resize() {  
        if(!textarea){ return; }  
        var new_rows = countLines(textarea.value);  
        if( textarea.rows!=new_rows+1 ) textarea.rows = new_rows;  
        timeout_resize = setTimeout(function(){ do_resize(); }, repeat);  
    }  
  
    function stop_resize(){ clearTimeout(timeout_resize); }  
}  
  
if (window.addEventListener)  
    window.addEventListener("load", _resizer2, false);  
else if (window.attachEvent)  
    window.attachEvent("onload", _resizer2);


function _resizer3(){  
    var textarea = 'fmenu', repeat = 500, cof = 35; 
  
    textarea = document.getElementById(textarea);  
    textarea.onfocus = do_resize;  
    textarea.onblur = stop_resize;  
  
    function countLines(strtocount) {  
        var hard_lines = 0, str = strtocount.split("\n"), hard_lines = str.length, letter_width = textarea.clientHeight/textarea.rows*cof/100, chars_in_line = textarea.clientWidth/letter_width, lines = 0, temp = 0;  
        for(i=0; i<=(hard_lines-1); i++){ 
            temp = str[i].length / chars_in_line;  
            if(temp>0) lines += temp;  
        }     
  
        return lines+hard_lines;  
    }  
    function do_resize() {  
        if(!textarea){ return; }  
        var new_rows = countLines(textarea.value);  
        if( textarea.rows!=new_rows+1 ) textarea.rows = new_rows;  
        timeout_resize = setTimeout(function(){ do_resize(); }, repeat);  
    }  
  
    function stop_resize(){ clearTimeout(timeout_resize); }  
}  
  
if (window.addEventListener)  
    window.addEventListener("load", _resizer3, false);  
else if (window.attachEvent)  
    window.attachEvent("onload", _resizer3);  