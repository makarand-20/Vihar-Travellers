let add_tour_form = document.getElementById('add_tour_form');
add_tour_form.addEventListener('submit', function (e) {
    e.preventDefault();
    add_tour();
});

function add_tour() {
    let data = new FormData();
    data.append('add_tour', '');
    data.append('feature_name', add_tour_form.elements['feature_name'].value);
    data.append('package_type', add_tour_form.elements['package_type'].value);
    data.append('speciality_tour', add_tour_form.elements['speciality_tour'].value);
    data.append('days', add_tour_form.elements['days'].value);
    data.append('price', add_tour_form.elements['price'].value);
    data.append('location', add_tour_form.elements['location'].value);
    data.append('quantity', add_tour_form.elements['quantity'].value);
    data.append('desc', add_tour_form.elements['desc'].value);


    let features = [];

    add_tour_form.elements['features'].forEach(element => {
        if (element.checked) {
            features.push(element.value);
        }
    });

    data.append('features', JSON.stringify(features));

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/tour.php", true);

    xhr.onload = function () {
        console.log(this.responseText);
        var myModal = document.getElementById('add-tour');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            add_tour_form.reset();
            get_all_tours();
        }
        else {
            alert('feature Server Down!');
        }
    }
    xhr.send(data);
}

function get_all_tours() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/tour.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('tour-data').innerHTML = this.responseText;
    }
    xhr.send('get_all_tours');
}

let edit_tour_form = document.getElementById('edit_tour_form');
function edit_details(id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/tour.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        let data = JSON.parse(this.responseText);
        edit_tour_form.elements['feature_name'].value = data.tourdata.feature_name;
        edit_tour_form.elements['package_type'].value = data.tourdata.package_type;
        edit_tour_form.elements['speciality_tour'].value = data.tourdata.speciality_tour;
        edit_tour_form.elements['days'].value = data.tourdata.days;
        edit_tour_form.elements['price'].value = data.tourdata.price;
        edit_tour_form.elements['location'].value = data.tourdata.location;
        edit_tour_form.elements['quantity'].value = data.tourdata.quantity;
        edit_tour_form.elements['desc'].value = data.tourdata.description;
        edit_tour_form.elements['tour_id'].value = data.tourdata.id;

        edit_tour_form.elements['features'].forEach(element => {
            if (data.features.includes(Number(element.value))) {
                element.checked = true;
            }
        });
    }
    xhr.send('get_tours=' + id);
}

edit_tour_form.addEventListener('submit', function (e) {
    e.preventDefault();
    submit_edit_tour();
});

function submit_edit_tour() {
    let data = new FormData();
    data.append('edit_tour', '');
    data.append('tour_id', edit_tour_form.elements['tour_id'].value);
    data.append('feature_name', edit_tour_form.elements['feature_name'].value);
    data.append('package_type', edit_tour_form.elements['package_type'].value);
    data.append('speciality_tour', edit_tour_form.elements['speciality_tour'].value);
    data.append('days', edit_tour_form.elements['days'].value);
    data.append('price', edit_tour_form.elements['price'].value);
    data.append('location', edit_tour_form.elements['location'].value);
    data.append('quantity', edit_tour_form.elements['quantity'].value);
    data.append('desc', edit_tour_form.elements['desc'].value);


    let features = [];

    edit_tour_form.elements['features'].forEach(element => {
        if (element.checked) {
            features.push(element.value);
        }
    });

    data.append('features', JSON.stringify(features));

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/tour.php", true);

    xhr.onload = function () {
        console.log(this.responseText);
        var myModal = document.getElementById('edit-tour');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            edit_tour_form.reset();
            get_all_tours();
        }
        else {
            // alert('Edit room Server Down!');
        }
    }
    xhr.send(data);
}

function toggle_status(id, val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/tour.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText == 1) {
            get_all_tours();
        }
        else {
            alert('status Not changed!')
        }
    }
    xhr.send('toggle_status=' + id + '&value=' + val);
}

let add_image_form = document.getElementById('add_image_form');
add_image_form.addEventListener('submit', function (e) {
    e.preventDefault();
    add_image();
});

function add_image() {
    let data = new FormData();
    data.append('image', add_image_form.elements['image'].files[0]);
    data.append('tour_id', add_image_form.elements['tour_id'].value);
    data.append('add_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/tour.php", true);

    xhr.onload = function () {

        if (this.responseText == 'inv_img') {
            alert('Only jpg, WEBP and png images are allowed');
        } else if (this.responseText == 'inv_size') {
            alert('Image should be less than 2Mb');
        } else if (this.responseText == 'upd_failed') {
            alert('Upload Failed, Server Down');
        } else {
            tour_images(add_image_form.elements['tour_id'].value, document.querySelector("#tour-images .modal-title").innerText);
            add_image_form.reset();
        }
    }
    xhr.send(data);
}

function tour_images(id, tname) {
    document.querySelector("#tour-images .modal-title").innerText = tname;
    add_image_form.elements['tour_id'].value = id;
    add_image_form.elements['image'].value = '';

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/tour.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('tour-image-data').innerHTML = this.responseText;
    }
    xhr.send('get_tour_images=' + id);
}

function rem_image(img_id, tour_id) {
    let data = new FormData();
    data.append('image_id', img_id);
    data.append('tour_id', tour_id);
    data.append('rem_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/tour.php", true);

    xhr.onload = function () {

        if (this.responseText == 1) {
            tour_images(tour_id, document.querySelector("#tour-images .modal-title").innerText);
        }
        else {
            alert('Image Removal Failed');
        }
    }
    xhr.send(data);
}

function thumb_image(img_id, tour_id) {
    let data = new FormData();
    data.append('image_id', img_id);
    data.append('tour_id', tour_id);
    data.append('thumb_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/tour.php", true);

    xhr.onload = function () {

        if (this.responseText == 1) {
            tour_images(tour_id, document.querySelector("#tour-images .modal-title").innerText);
        }
        else {
            alert('Thumb Adding Failed');
        }
    }
    xhr.send(data);
}

function remove_tour(tour_id) {
    if (confirm("Are you sure, You wants to delete this room?")) {
        let data = new FormData();
        data.append('tour_id', tour_id);
        data.append('remove_tour', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/tour.php", true);

        xhr.onload = function () {

            if (this.responseText == 1) {
                get_all_tours();
            }
            else {
                alert('Failed to remove room');
            }
        }
        xhr.send(data);
    }
}

window.onload = function () {
    get_all_tours();
}