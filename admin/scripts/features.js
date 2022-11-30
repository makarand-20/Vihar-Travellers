let feature_s_form = document.getElementById('feature_s_form');
let facility_s_form = document.getElementById('facility_s_form');

feature_s_form.addEventListener('submit', function (e) {
    e.preventDefault();
    add_feature();
})

function add_feature() {
    let data = new FormData();
    data.append('name', feature_s_form.elements['feature_name'].value);
    data.append('add_feature', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/feature.php", true);
    
    xhr.onload = function () {
        console.log(this.responseText);

        var myModal = document.getElementById('feature-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            feature_s_form.elements['feature_name'].value = '';
            get_features();
        } else {
            alert('error', 'feature Server Down!');
        }
    }
    xhr.send(data);
}

function get_features() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/feature.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('features-data').innerHTML = this.responseText;
    }
    xhr.send('get_features');
}

function rem_feature(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/feature.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText == 1) {
            get_features();
        } else if (this.responseText == 'tour_added') {
            alert('This feature is added in Tour');
        } else {
            alert('Server Down!');
        }
    }
    xhr.send('rem_feature=' + val);
}

facility_s_form.addEventListener('submit', function (e) {
    e.preventDefault();
    add_facility();
})

function add_facility() {
    let data = new FormData();
    data.append('name', facility_s_form.elements['facility_name'].value);
    data.append('icon', facility_s_form.elements['facility_icon'].files[0]);
    data.append('desc', facility_s_form.elements['facility_desc'].value);
    data.append('add_facility', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/feature.php", true);

    xhr.onload = function () {
        console.log(this.responseText);

        var myModal = document.getElementById('facility-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 'inv_img') {
            alert('Only svg images are allowed');
        } else if (this.responseText == 'inv_size') {
            alert('Image should be less than 2Mb');
        } else if (this.responseText == 'upd_failed') {
            alert('Upload Failed, Server Down');
        } else {
            facility_s_form.reset();
            get_facilities();
        }
    }
    xhr.send(data);
}

function get_facilities() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/feature.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('facilities-data').innerHTML = this.responseText;
    }
    xhr.send('get_facilities');
}

function rem_facility(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/feature.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText == 1) {
            get_facilities();
        } else if (this.responseText == 'tour_added') {
            alert('error', 'This facility is added in room!');
        } else {
            alert('Server Down!');
        }
    }
    xhr.send('rem_facility=' + val);
}

window.onload = function () {
    get_features();
    get_facilities();
}