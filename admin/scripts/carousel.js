let Carousel_s_form = document.getElementById('Carousel_s_form');
let carousel_picture_inp = document.getElementById('carousel_picture_inp');

Carousel_s_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_img();
})

function add_img() {
    let data = new FormData();
    data.append('picture', carousel_picture_inp.files[0]);
    data.append('add_img', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/carousel_crud.php", true);

    xhr.onload = function() {
        console.log(this.responseText);

        var myModal = document.getElementById('carousel-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 'inv_img') {
            alert('Only jpg and png images are allowed');
        } else if (this.responseText == 'inv_size') {
            alert('Image should be less than 2Mb');
        } else if (this.responseText == 'upd_failed') {
            alert('Upload Failed, Server Down');
        } else {
            carousel_picture_inp.value = '';
            get_carousel();
        }
    }
    xhr.send(data);
}

function get_carousel(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/carousel_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        document.getElementById('carousel-data').innerHTML = this.responseText;
    }
    xhr.send('get_carousel');
}

function rem_img(val){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/carousel_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if(this.responseText == 1){
            get_carousel();
        }
        else{
            alert('Server Down!');
        }
    }
    xhr.send('rem_img='+val);
}

window.onload = function() {
    get_carousel();
}