function clearBut(){
    var x=window.confirm("Are you sure you want to clear all of your answers?")
    if(x){
    var q = document.getElementsByClassName('but');
    for(var i =0 ; i < q.length; i++){
        q[i].checked=false;
    }}
    else{}
}

