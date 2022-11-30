let extra_carousel_s_form = document.getElementById('extra_carousel_s_form');
let extra_carousel_picture_inp = document.getElementById('extra_carousel_picture_inp');

extra_carousel_s_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_img();
})

function add_img() {
    let data = new FormData();
    data.append('picture', extra_carousel_picture_inp.files[0]);
    data.append('add_img', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/extra_carousel_crud.php", true);

    xhr.onload = function() {
        console.log(this.responseText);

        var myModal = document.getElementById('extra_carousel-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 'inv_img') {
            alert('Only jpg and png images are allowed');
        } else if (this.responseText == 'inv_size') {
            alert('Image should be less than 2Mb');
        } else if (this.responseText == 'upd_failed') {
            alert('Upload Failed, Server Down');
        } else {
            extra_carousel_picture_inp.value = '';
            get_extra_carousel();
        }
    }
    xhr.send(data);
}

function get_extra_carousel(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/extra_carousel_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        document.getElementById('extra-carousel-data').innerHTML = this.responseText;
    }
    xhr.send('get_extra_carousel');
}

function rem_img(val){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/extra_carousel_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if(this.responseText == 1){
            get_extra_carousel();
        }
        else{
            alert('Server Down!');
        }
    }
    xhr.send('rem_img='+val);
}

window.onload = function() {
    get_extra_carousel();
}