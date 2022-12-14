const form = document.querySelector('#form');
const inputFile = document.querySelector('#input-file');
const btnLoadingImg = document.querySelector('#btn-load-img');

const fileList = document.querySelector('.files-container');

window.addEventListener('load', () => sendRequestForOutput());

inputFile.addEventListener('change', (e) => {
    const filename = document.querySelector('.file-name');
    filename.innerText = e.target.files[0].name;
});

form.addEventListener('submit', (e) => {
    e.preventDefault();

    const formData = new FormData(form);
    sendRequestForLoading(formData);
});

document.addEventListener('click', (e) => {
    if (e.target.classList.contains('item__btn-delete')) {
        const file = e.target.parentElement;
        const fileId = file.getAttribute('idAttr');

        sendRequestForDelete(fileId);
    }
});

function sendRequestForLoading(body) {
    const xhr = new XMLHttpRequest();

    xhr.open('POST', './server/files.php');
    xhr.send(body);

    xhr.addEventListener('load', () => {
        if (xhr.status === 200) {
            alert('Файл загружен успешно');
            sendRequestForOutput();
        }
    });

    xhr.addEventListener('error', () => {
        alert('Произошла ошибка!');
    });
}

function sendRequestForOutput() {
    const xhr = new XMLHttpRequest();

    xhr.open('GET', './server/files.php?get=1');
    xhr.send();

    xhr.addEventListener('load', () => {
        if (xhr.status === 200) {
            fileList.innerHTML = xhr.response;
        }
    });
}

function sendRequestForDelete(body) {
    const xhr = new XMLHttpRequest();

    xhr.open('POST', './server/files.php');
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('id=' + body);

    xhr.addEventListener('load', () => {
        if (xhr.status === 200) sendRequestForOutput();
    });
}