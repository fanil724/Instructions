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