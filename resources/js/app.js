import './bootstrap';

let buttonDown = document.querySelectorAll('.downButton');
buttonDown.forEach((elem) => {
    elem.addEventListener('click', () => {
        let id = elem.getAttribute('data-id');

        axios.get(`download/${id}`)
            .then(response => {
                console.log(response.data.message);
            }).catch(error => {
                console.error('Error', response.data.message);
            });
    })
});


let checkBlock = document.querySelectorAll('.checkBlock');
checkBlock.forEach((elem) => {
    elem.addEventListener('change', () => {
        let id = elem.getAttribute('data-id');
        console.log(id);
        axios.post(`/admin/users/${id}/blocked`)
            .then(response => {
                elem.blur();
                alert(response.data.message);
            }).catch(error => {
                elem.blur();
                alert(response.data.message);
            });
    })
});


let checkStatus = document.querySelectorAll('.checkStatus');
checkStatus.forEach((elem) => {
    elem.addEventListener('change', () => {
        let id = elem.getAttribute('data-id');
        console.log(id);
        axios.post(`/admin/complaint/${id}/status`)
            .then(response => {
                elem.blur();
                alert(response.data.message);
            }).catch(error => {
                elem.blur();
                alert(response.data.message);
            });
    })
});

let butCaptcha = document.getElementById('butCapcha');

butCaptcha.addEventListener('click',
    () => {
        axios.get(`/captchaIMG`)
            .then(response => {
                document.getElementById('captchaImg').src = response.data.captcha;
            });
    });
