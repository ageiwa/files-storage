const form = document.querySelector('#form');
const inputFile = document.querySelector('#input-file');
const btnLoadingImg = document.querySelector('#btn-load-img');

inputFile.addEventListener('change', (e) => {
    const filename = document.querySelector('.file-name');
    filename.innerText = e.target.files[0].name;
});

form.addEventListener('submit', (e) => {
    e.preventDefault();

    const formData = new FormData(form);
    sendRequest(formData);
});

function sendRequest(body) {
    const xhr = new XMLHttpRequest();

    xhr.open('POST', './server/loading-img.php');
    // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(body);

    xhr.addEventListener('load', () => {
        if (xhr.status === 200) {
            console.log(xhr.response);
        }
    });
}