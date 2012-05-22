function hideComments() {
    var comments = window.document.getElementsByClassName('comments');
    var len = comments.length;
    for (i = 0; i < len; i++) {
        comments[i].style.display = 'none';
    }
}

function showHide(elid) {
    var el = window.document.getElementById(elid);
    if (el.style.display == 'none')
    {
        el.style.display = 'block';                
    } else {
        el.style.display = 'none';
    }
}

window.onload=hideComments();